<?php

namespace Classiebit\Eventmie\Support;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as BaseValidator;
use Symfony\Component\Mime\Address;

/**
 * Backport of Laravel's email CRLF guard (CVE-2026-48019 / GHSA-5vg9-5847-vvmq)
 * for apps that must stay on Laravel 11. The framework fix ships in 12.60+.
 */
class SafeMail
{
    public static function boot(): void
    {
        Validator::resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
            return new class($translator, $data, $rules, $messages, $customAttributes) extends BaseValidator {
                public function validateEmail($attribute, $value, $parameters)
                {
                    if (!SafeMail::isSafe($value)) {
                        return false;
                    }

                    return parent::validateEmail($attribute, $value, $parameters);
                }
            };
        });

        Event::listen(MessageSending::class, function (MessageSending $event) {
            return SafeMail::messageIsSafe($event);
        });
    }

    public static function isSafe($value): bool
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        $value = (string) $value;

        return $value !== '' && !preg_match('/[\r\n]/', $value);
    }

    public static function sanitize($value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $value = trim($value);

        return self::isSafe($value) ? $value : null;
    }

    protected static function messageIsSafe(MessageSending $event): bool
    {
        $message = $event->message;

        if (method_exists($message, 'getSubject') && !self::isSafe((string) $message->getSubject())) {
            return false;
        }

        foreach (['getFrom', 'getTo', 'getCc', 'getBcc', 'getReplyTo', 'getSender'] as $method) {
            if (!method_exists($message, $method)) {
                continue;
            }

            $addresses = $message->{$method}();
            if ($addresses === null) {
                continue;
            }

            if (!is_array($addresses)) {
                $addresses = [$addresses];
            }

            foreach ($addresses as $address) {
                if ($address instanceof Address) {
                    if (!self::isSafe($address->getAddress()) || !self::isSafe((string) $address->getName())) {
                        return false;
                    }
                    continue;
                }

                if (is_string($address) && !self::isSafe($address)) {
                    return false;
                }
            }
        }

        return true;
    }
}

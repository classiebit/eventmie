<?php

namespace Classiebit\Eventmie\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Classiebit\Eventmie\Notifications\CustomDb;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class MailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public  $mail_data;
    public  $extra_lines;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mail_data, $extra_lines = [])
    {
        $this->mail_data    =  (object) $mail_data;
        $this->extra_lines  =  (object) $extra_lines;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // check mail creds
        if(checkMailCreds())
            return ['mail', CustomDb::class];
            
        // if mail creds not set then send only database notifications
        return [CustomDb::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject($this->mail_data->mail_subject)
                ->markdown('eventmie::mail.common', [
                    'mail_data'=>$this->mail_data,
                    'extra_lines'=>$this->extra_lines,
                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'notification'  => $this->mail_data,
            'n_type'        => $this->mail_data->n_type,
        ];
        
    }
}

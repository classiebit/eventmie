<?php

namespace Classiebit\Eventmie\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class MyHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
        'current',
        'current_password',
        'mail_password',
        'mail_mail_password',
        'aws_secret_access_key',
        'aws_access_key_id',
    ];

    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {

            if (request()->wantsJson()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return response()->view('eventmie::errors.404');
            }

        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
                    ? response()->json(['message' => __('unauthenticated'), 'status' => false, 'url' => route('eventmie.login')], 401)
                    : redirect()->guest(route('eventmie.login'));
    }
}

<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use App\Supports\RespondResource;

class Handler extends ExceptionHandler
{
    use RespondResource;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $e
     * @return void
     *
     * @throws Throwable
     */
    // public function report(Throwable $e)
    // {
    //     $method = app('request')->getMethod();
    //     if ($e instanceof HttpException) {
    //         Log::warning(get_class($e) . ': (Code:' . $e->getStatusCode() . ') ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine() . '([' . $method . '] Request: ' . URL::full() . ')');
    //         return;
    //     } else if ($e instanceof ConnectException) {
    //         Log::alert('Call uri: ' . $e->getRequest()->getUri() . ' get time out with exception: ' . $e->getTraceAsString());
    //         return;
    //     }

    //     parent::report($e);
    // }

    public function render($request, Throwable $e)
    {
        // if ($e instanceof MethodNotAllowedHttpException) {
        //     return responder()->method_not_allowed();
        // } elseif ($e instanceof ValidationException) {
        //     $error = collect($e->errors())->first();
        //     return responder()->bad_request($error[0] ?: "");
        // } elseif ($e instanceof NotFoundHttpException) {
        //     return responder()->not_found();
        // } elseif ($e instanceof AuthenticationException || $e instanceof OAuthServerException) {
        //     return responder()->unauthorized();
        // } elseif ($e instanceof AuthorizationException) {
        //     return responder()->forbidden();
        // }

        if ($e instanceof ValidationException) {
            $error = collect($e->errors())->first();
            return $this->fail($error[0]);
        }

        return $this->fail($e->getMessage());
    }
}
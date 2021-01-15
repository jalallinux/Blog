<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
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
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Custom unauthenticated exception message
     *
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|RedirectResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? \response()->json(['error' => __('auth.unauthenticated')], 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ThrottleRequestsException) {
            return response()->json([
                'error' => 'درخواست های شما بیش از حد مجاز می باشد، لطفا چند ثانیه دیگر تلاش کنید.'
            ], 400);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => __('validation.binding', [
                    'attribute' => __('validation.attributes.' . strtolower(last(explode('\\', $e->getModel()))))
                ])
            ], 404);
        }
        if ($e instanceof TokenInvalidException) {
            return response()->json([
                'error' => 'Token is invalid'
            ], 400);
        } else if ($e instanceof TokenExpiredException) {
            return response()->json([
                'error' => 'Token is Expired'
            ], 400);
        } else if ($e instanceof JWTException) {
            return response()->json([
                'error' => 'There is problem with your token'
            ], 400);
        }
        return parent::render($request, $e);
    }
}

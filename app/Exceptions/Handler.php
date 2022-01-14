<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        //Very Important!!!
        //to handle error not found for API
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return responseJson($e->getStatusCode(),'Not Found');
        });
        // to handle get/push/post/delete error
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return responseJson($e->getStatusCode(),'Method is not allowed for this URL');
        });
        // to handle wrong URL exception
        $this->renderable(function (HttpException $e, $request) {
            return responseJson($e->getStatusCode(),$e->getMessage());
        });
        // to handle wrong query exception
        $this->renderable(function (QueryException $e, $request) {
            return responseJson(409,$e->getMessage(),$e->getCode());
        });
        // to handle authorization exception
        $this->renderable(function (AuthorizationException $e, $request) {
            return responseJson(409,"You are not authorized");
        });
        // to handle authentication exception

        $this->renderable(function (AuthenticationException $e, $request) {
            return responseJson(409,"You are not authenticated");
        });

    }
}

<?php


namespace Developerhouse\Quick\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class CustomHandler extends ExceptionHandler {

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport
        = [
            RedirectException::class,
        ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash
        = [
            'password',
            'password_confirmation',
        ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register() {
        //
    }

    public function report(Throwable $exception) {
        parent::report($exception);
    }

    public function render($request, Throwable $exception) {

        if (($exception instanceof HttpException) && $request->expectsJson()) {
            return response()->json(['error' => trans('quick::text.unauthorized')], 403);
        }

        // extract the response out of this exception and return it.
        if ($exception instanceof RedirectException) {
            return $exception->getResponse();
        }

        if (($exception instanceof AuthorizationException) && $request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized, verifique los parámetros enviados.'], 401);
        }

        if (($exception instanceof ModelNotFoundException) && $request->expectsJson()) {
            return response()->json(['error' => 'Resource is unauthorized.'], 401);
        }

        if (($exception instanceof NotFoundHttpException) && $request->expectsJson()) {
            return response()->json(['error' => 'Resource not found.'], 404);
        }


        return parent::render($request, $exception);

    }

    /**
     * @param Request                 $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse|RedirectResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception) {

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Token inválido.'], 401);
        }

        return redirect()->route('quick.login.from');

    }


}
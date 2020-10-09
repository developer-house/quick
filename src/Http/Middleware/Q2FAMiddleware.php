<?php


namespace Developerhouse\Quick\Http\Middleware;


use Closure;
use Developerhouse\Quick\Support\Google2FAAuthenticator;
use Illuminate\Http\Request;

class Q2FAMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $authenticator = app(Google2FAAuthenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();

    }
}
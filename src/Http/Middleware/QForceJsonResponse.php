<?php


namespace Developerhouse\Quick\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QForceJsonResponse {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
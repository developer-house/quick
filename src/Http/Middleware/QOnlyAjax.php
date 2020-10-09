<?php


namespace Developerhouse\Quick\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QOnlyAjax {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (!$request->ajax()) {
            abort(404);
        }

        return $next($request);
    }
}
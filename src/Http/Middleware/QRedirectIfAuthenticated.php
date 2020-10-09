<?php


namespace Developerhouse\Quick\Http\Middleware;


use Auth;
use Closure;
use Illuminate\Http\Request;

class QRedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param Request     $request
     * @param Closure     $next
     * @param string|null ...$guards
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards) {

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('quick.welcome');
            }
        }

        return $next($request);
    }

}
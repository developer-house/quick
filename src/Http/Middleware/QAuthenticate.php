<?php

namespace Developerhouse\Quick\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class QAuthenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function redirectTo($request) {

        if (!$request->expectsJson()) {
            return route('quick.login.from');
        }

    }
}

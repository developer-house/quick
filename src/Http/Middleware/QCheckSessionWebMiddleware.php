<?php

namespace Developerhouse\Quick\Http\Middleware;


use Auth;
use Closure;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\UserSession;
use Developerhouse\Quick\Models\Tables\UserSetting;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class QCheckSessionWebMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $session = UserSession::whereId($request->session()->get('user_session'))->first();

        //Información del usuario que inicio sesión
        $user = Auth::user();

        if ($session->state_id === 10) {

            Auth::logout();

            session()->forget('user_session');

            return redirect()->route('quick.login.from')
                ->withErrors(['email' => trans('quick::text.another.login')])
                ->withInput(['email' => $user->email]);

        }


        // Configuraciones del usuario que inicio sesión
        $setting = UserSetting::whereUserId($user->id)->first();

        // Sesiones activas del usuario que inicio sesión
        $sessions = UserSession::whereUserId($user->id)
            ->whereMediumId(11)
            ->whereStateId(9)
            ->orderBy('id', 'desc')
            ->get();

        // Validamos que las sesiones activas no sean mayores a las sesiones permitida a la configuración del usuario
        if (count($sessions) > $setting->number_of_active_sessions_in_web) {

            foreach ($sessions as $index => $session) {

                if ($index !== 0) {
                    $session->state_id = 10;
                    $session->update();
                }

            }

        }


        return $next($request);
    }
}

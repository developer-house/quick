<?php

namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Developerhouse\Quick\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PragmaRX\Google2FA\Google2FA;

class QPasswordSecurityController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * @param PasswordSecurityRequest $request
     *
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function updatePassword(PasswordSecurityRequest $request) {

        // Valida que la contraseña actual concuerde con la contraseña de la cuenta
        PasswordSecurityFacade::checkCurrentPassword($request->get('current_password'));

        // Actualiza la contraseña de la cuenta
        PasswordSecurityFacade::updatePassword($request);

        return redirect(route('user.security', Auth::id()));

    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function enable2fa(Request $request) {

        // Información del usuario seleccionado
        $user = User::findOrFail(Auth::id());

        // Valida que la contraseña actual concuerde con la contraseña de la cuenta
        PasswordSecurityFacade::checkCurrentPassword($request->get('current_password'));

        $google2fa = app('pragmarx.google2fa');

        $secret = $request->get('verify-code');

        $valid = $google2fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);

        if ($valid) {

            $user->passwordSecurity->google2fa_enable = 1;
            $user->passwordSecurity->save();

            return redirect(route('user.security', Auth::id()))->with('success', 'La autenticación en dos pasos está activada');

        }

        return back()->with('error', 'Código de verificación no válido. Vuelva a intentarlo.');

    }

    public function enable2faGet() {
        return redirect(route('login'));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function disable2fa(Request $request) {

        // Información del usuario seleccionado
        $user = User::findOrFail(Auth::id());

        // Valida que la contraseña actual concuerde con la contraseña de la cuenta
        PasswordSecurityFacade::checkCurrentPassword($request->get('current_password'));

        $user->passwordSecurity->google2fa_enable = 0;
        $user->passwordSecurity->save();

        return redirect(route('user.security', Auth::id()))->with('success', 'La autenticación en dos pasos está desactivada.');

    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function verify2fa() {

        dd('ok');


        $tep = Request::getRequestUri();

        if (strpos($tep, 'account/security/verify/2fa') !== false) {
            return redirect(route('login'));
        }

        return redirect(URL()->previous());

    }

}

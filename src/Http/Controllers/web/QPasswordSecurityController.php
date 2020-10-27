<?php

namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Http\Facade\QPasswordSecurityFacade;
use Developerhouse\Quick\Http\Request\QPasswordSecurityRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PragmaRX\Google2FA\Google2FA;

class QPasswordSecurityController extends Controller {

    protected $facade;
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->facade  = new QPasswordSecurityFacade();
        $this->request = new QPasswordSecurityRequest();
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function update_password(Request $request) {

        //Validación del formulario
        $this->request->update_password($request);

        // Valida que la contraseña actual concuerde con la contraseña de la cuenta
        $this->facade->check_current_password($request);

        // Actualiza la contraseña de la cuenta
        $this->facade->update_password($request);

        return redirect()->route('quick.welcome');

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

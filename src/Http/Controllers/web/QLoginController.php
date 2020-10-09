<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Carbon\Carbon;
use DB;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\UserSession;
use Developerhouse\Quick\Traits\QAuth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Facade as Google2FA;
use Illuminate\Support\Str;

class QLoginController extends Controller {

    use QAuth;

    public function showLoginForm() {
        return view('quick::layouts.auth.login');
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function login(Request $request) {

        // Validamos los parámetros enviado por el formulario
        $this->validate_login($request);

        // Validamos el estado del usuario
        $this->validate_state_user($request);

        // Creamos el array para validar el login
        $credentials = request(['email', 'password']);

        $this->check_attempt($request, $credentials, 11);

        return redirect()->route('quick.welcome');

    }

    public function logout() {

        $user_session           = UserSession::whereId(session()->get('user_session'))->first();
        $user_session->state_id = 10;
        $user_session->update();

        session()->forget('user_session');

        Auth::logout();

        Google2FA::logout();

        return redirect()->route('quick.login.from');

    }






}
<?php


namespace Developerhouse\Quick\Traits;


use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Beans\UserSessionBean;
use Developerhouse\Quick\Models\Tables\LoginAttempt;
use Developerhouse\Quick\Models\Tables\LoginHistory;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\UserSession;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

trait QAuth {

    use HasRoles;

    protected $attempt;


    /**
     * QAuth constructor.
     */
    public function __construct() {
        $this->attempt = new LoginAttempt();
    }


    /**
     * @param Request $request
     *
     * @return bool|RedirectResponse
     * @throws RedirectException
     */
    protected function validate_login(Request $request) {

        $rules = [
            $this->username() => 'required|string',
            'password'        => 'required|string',
        ];

        $messages = [
            'email.required' => trans('quick::validation.email.required'),
            'email.string'   => trans('quick::validation.email.string'),
            'email.email'    => trans('quick::validation.email.string'),

            'username.required' => trans('quick::validation.username.required'),
            'username.string'   => trans('quick::validation.username.string'),

            'password.required' => trans('quick::validation.password.required'),
            'password.string'   => trans('quick::validation.password.string'),
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            if ($request->expectsJson()) {

                $response = response()->json(['error' => $validator->errors()->all()], 401);

                throw (new RedirectException)->setResponse($response);

            } else {

                return back()
                    ->withErrors($validator)
                    ->withInput([$this->username() => $request->get($this->username())]);

            }


        }

        return true;


    }

    /**
     * @param Request $request
     * @param QUser   $user
     *
     * @throws RedirectException
     */
    public function validate_state_user(Request $request, QUser $user = null): void {

        $msg = trans('quick::text.user.inactive');

        // Validamos que el usuario exista y que no este activo de lo contrario enviamos un mensaje al cliente.
        if (($user !== null) && $user->state_id !== 1) {

            $msg = trans('quick::text.user.inactive');

            if ($request->expectsJson()) {
                $response = response()->json(['error' => $msg], 401);
            } else {
                $response = back()->withErrors([$this->username() => $msg]);
            }

            throw (new RedirectException)->setResponse($response);

        } elseif ($user === null) {

            $msg = trans('quick::text.error.login');

            if ($request->expectsJson()) {
                $response = response()->json(['error' => $msg], 401);
            } else {
                $response = back()->withErrors([$this->username() => $msg]);
            }

            throw (new RedirectException)->setResponse($response);

        }


    }

    /**
     * @param Request $request
     * @param QUser   $user
     * @param array   $credentials
     *
     * @param int     $medium
     *
     * @throws RedirectException
     */
    public function check_attempt(Request $request, QUser $user, array $credentials, int $medium): void {


        // Validamos que el login se ejecuto con éxito utilizado el array con las credenciales
        if (Auth::attempt($credentials) === false) {


            $msg = $this->increment_login_history($request, $user, $medium);

            if ($request->expectsJson()) {

                $response = response()->json([
                    'error' => trans('quick::text.error.login'),
                ], 401);

            } else {

                $response = back()
                    ->withErrors([$this->username() => $msg])
                    ->withInput([$this->username() => $request->get($this->username())]);

            }

            throw (new RedirectException)->setResponse($response);

        } else {

            $request->session()->regenerate();

            $user = QUser::whereId($request->user()->id)
                ->first();

            $this->authenticated($request, $user, $medium);

            $this->clear_login_attempts($user);

        }

    }

    /**
     * @param Request $request
     * @param QUser   $user
     * @param int     $medium
     *
     * @return string
     */
    public function increment_login_history(Request $request, QUser $user, int $medium): string {

        // Información del cliente que realiza la operación
        $info = detect();

        // Validamos si existe el usuario
        if ($user !== null) {

            // Registra el intento login en el historial
            LoginHistory::add($user, $info, 13, $medium);

            // Registra el intentos de acceso
            $this->attempt->add($user, 13);

            // Cantidad de intento de sessión fallidos
            $attempts = $this->attempt->number_of_failed_attempts($user);

            switch ($attempts) {

                case 1:

                    return trans('quick::text.remaining.attempts.two');

                case 2:

                    return trans('quick::text.remaining.attempts.one');

                case 3:

                    $user->state_id = 2;
                    $user->update();

                    return trans('quick::text.user.inactive');

            }
        }

        return trans('auth.failed');

    }

    public function clear_login_attempts(QUser $user) {
        $this->attempt->clear_login_attempts($user);
    }

    /**
     * @param Request $request
     * @param QUser   $user
     * @param int     $medium
     *
     * @return void
     */
    protected function authenticated(Request $request, QUser $user, int $medium): void {

        $info = detect();

        $user_agent = $request->header('User-Agent');

        // Preparamos el bean
        $bean = new UserSessionBean();
        $bean->setUserId($user->id);
        $bean->setIpAddress($info['ip']);
        $bean->setUserAgent($user_agent);
        $bean->setMediumId($medium);
        $bean->setStateId(9);

        // Invocamos el método que inserta el registro en la base de datos
        $answer = UserSession::add($bean);

        $request->session()->put('user_session', $answer->id);

    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username() {
        if (config('quick.login.type') === 'email') {
            return 'email';
        } else {
            return 'username';
        }
    }

}
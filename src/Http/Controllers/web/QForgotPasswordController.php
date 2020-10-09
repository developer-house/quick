<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Carbon\Carbon;
use DB;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Http\Facade\QForgotPasswordFacade;
use Developerhouse\Quick\Http\Mail\ResetPasswordMail;
use Developerhouse\Quick\Models\Tables\QUser;
use Hash;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Mail;

class QForgotPasswordController extends Controller {

    public $facade;

    /**
     * QForgotPasswordController constructor.
     */
    public function __construct() {
        $this->facade = new QForgotPasswordFacade();
    }

    public function request() {
        return view('quick::layouts.auth.password');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function email(Request $request) {

        $this->facade->validate($request, 'email');

        $user = QUser::whereEmail($request->get('email'))->first();

        if ($user !== null) {

            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email'      => $request->get('email'),
                'token'      => Str::random(60),
                'created_at' => Carbon::now(),
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')->where('email', $request->get('email'))->first();

            if ($this->sendResetEmail($request, $request->get('email'), $tokenData->token)) {
                return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
            } else {
                return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
            }

        }


    }

    public function reset(Request $request, $token = null) {
        return view('quick::layouts.auth.password.reset')->with(
            ['token' => $token, 'email' => $request->get('email')]
        );
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function update(Request $request) {

        $this->facade->validate($request, 'update');

        $password = $request->get('password');

        // Validate the token
        $data = DB::table('password_resets')
            ->where('token', $request->get('token'))
            ->first();

        if ($data == null) {
            expects_json_or_back($request, '', 'Enlace caducado');
        }

        $user = QUser::whereEmail($data->email)->first();

        if ($user == null) {
            expects_json_or_back($request, '', 'Email not found');
        }

        $user->password = Hash::make($password);
        $user->update();

        successful_message('Contraseña cambiada exitosamente');

        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return redirect()->route('quick.login.from');


    }


    protected function sendResetEmail(Request $request, $email, $token) {

        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('names', 'surnames', 'email')->first();

        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('app.url') . '/' . config('quick.route.password.reset') . '/' . $token . '?email=' . urlencode($user->email);

        try {

            Mail::to([$user->email])->send(new ResetPasswordMail($user, $link));

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker() {
        return Password::broker();
    }


}
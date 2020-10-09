<?php


namespace Developerhouse\Quick\Traits;


use DB;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Models\Tables\ModelHasRoles;
use Developerhouse\Quick\Models\Tables\PasswordSecurity;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\UserSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait QUserTrait {

    /**
     * @param Request $request
     *
     * @return bool
     * @throws RedirectException
     */
    protected function validate_store(Request $request) {

        $rules = [
            'type_dni' => 'required|numeric',
            'dni'      => 'required|numeric',
            'names'    => 'required|string',
            'surnames' => 'required|string',
            'username' => 'required|string',
            'email'    => 'required|string|email',
            'gender'   => 'required|numeric',
            'rol'      => 'required|numeric',
        ];

        if ($request->files->get('photo') !== null) {
            $rules = ['photo' => 'required|mimes:jpeg,jpg,png|max:2048'];
        }

        $messages = [
            'type_dni.required' => trans('quick::validation.type_dni.required'),
            'type_dni.numeric'  => trans('quick::validation.type_dni.numeric'),

            'dni.required' => trans('quick::validation.dni.required'),
            'dni.numeric'  => trans('quick::validation.dni.numeric'),

            'names.required' => trans('quick::validation.names.required'),
            'names.string'   => trans('quick::validation.names.numeric'),

            'surnames.required' => trans('quick::validation.surnames.required'),
            'surnames.string'   => trans('quick::validation.surnames.numeric'),

            'username.required' => trans('quick::validation.username.required'),
            'username.string'   => trans('quick::validation.username.numeric'),

            'email.required' => trans('quick::validation.email.required'),
            'email.string'   => trans('quick::validation.email.string'),
            'email.email'    => trans('quick::validation.email.string'),

            'genero.required' => trans('quick::validation.genero.required'),
            'genero.numeric'  => trans('quick::validation.genero.numeric'),

            'rol.required' => trans('quick::validation.rol.required'),
            'rol.numeric'  => trans('quick::validation.rol.numeric'),

            'photo.required' => trans('quick::validation.photo.required'),
            'photo.mimes'    => trans('quick::validation.photo.mimes'),
            'photo.max'      => trans('quick::validation.photo.max'),
        ];


        if ($request->expectsJson()) {

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {

                $response = response()->json(['error' => $validator->errors()->all()], 401);

                throw (new RedirectException)->setResponse($response);
            }

        } else {

            $request->validate($rules, $messages);

        }

        return true;

    }

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    protected function add(Request $request) {


        try {

            DB::beginTransaction();

            $user = new QUser();

            $user->dni         = $request->get('dni');
            $user->type_dni_id = $request->get('type_dni');
            $user->names       = $request->get('names');
            $user->surnames    = $request->get('surnames');
            $user->username    = $request->get('username');
            $user->email       = $request->get('email');
            $user->gender_id   = $request->get('gender');
            $user->state_id    = 1;
            $user->password    = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
            $user->save();

            $rol             = new ModelHasRoles();
            $rol->role_id    = $request->get('rol');
            $rol->model_type = 'App\User';
            $rol->model_id   = $user->id;
            $rol->save();

            $setting          = new UserSetting();
            $setting->user_id = $user->id;
            $setting->save();

            // Agregue la clave secreta a los datos de registro
            $secretKey                   = new PasswordSecurity();
            $secretKey->user_id          = $user->id;
            $secretKey->google2fa_enable = 0;
            $secretKey->google2fa_secret = app('pragmarx.google2fa')->generateSecretKey();
            $secretKey->save();

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            expects_json_or_back($request, $e->getMessage());


        }

    }

}
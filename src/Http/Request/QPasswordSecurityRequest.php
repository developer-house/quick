<?php


namespace Developerhouse\Quick\Http\Request;


use Developerhouse\Quick\Exceptions\RedirectException;
use Illuminate\Http\Request;

class QPasswordSecurityRequest {

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    public function update_password(Request $request) {

        $rules = [
            'current_password' => 'required|string',
            'password'         => 'required|string|min:8|confirmed',
        ];

        $messages = [
            'current_password.required' => 'La contraseña actual es obligatoria',
            'current_password.string'   => 'La contraseña actual es invalida',

            'password.required'  => 'La nueva contraseña es obligatoria',
            'password.string'    => 'La nueva contraseña es invalida',
            'password.min'       => 'La contraseña tiene que tener mínimo 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];


        check_request($request, $rules, $messages);

    }

}
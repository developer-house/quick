<?php


namespace Developerhouse\Quick\Http\Facade;


use Developerhouse\Quick\Exceptions\RedirectException;
use Illuminate\Http\Request;

class QForgotPasswordFacade {

    /**
     * @param Request $request
     * @param String  $case
     *
     * @return void
     * @throws RedirectException
     */
    public function validate(Request $request, String $case): void {

        $rules = [
            'email' => 'required|string|email',
        ];

        $messages = [
            'email.required' => trans('quick::validation.email.required'),
            'email.string'   => trans('quick::validation.email.string'),
            'email.email'    => trans('quick::validation.email.string'),
        ];


        switch ($case) {

            case 'email':
                break;

            case 'update':

                $rules = array_merge($rules, ['token' => 'required', 'email' => 'required|email', 'password' => 'required|confirmed|min:8',]);

                break;
        }

        check_request($request, $rules, $messages);

    }
}
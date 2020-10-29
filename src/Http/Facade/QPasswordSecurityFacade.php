<?php


namespace Developerhouse\Quick\Http\Facade;


use Auth;
use DB;
use Developerhouse\Quick\Exceptions\RedirectException;
use Exception;
use Hash;
use Illuminate\Http\Request;

class QPasswordSecurityFacade {

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    public function check_current_password(Request $request) {

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            expects_json_or_back($request, 'error', 'La contraseña no coincide con la contraseña de su cuenta. Inténtalo de nuevo.');
        }

    }

    /**
     * @param Request $request
     */
    public function update_password(Request $request) {

        try {

            DB::beginTransaction();

            $user           = Auth::user();
            $user->password = Hash::make($request->get('password'));
            $user->update();

            successful_message('Cambio de contraseña exitoso');

            DB::commit();

        } catch (Exception $e) {

            error_message('Error inesperado');

        }

    }
}
<?php


namespace Developerhouse\Quick\Http\Facade;


use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Models\Tables\Value;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class QRolesFacade {

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    public function validate(Request $request) {

        $rules = [
            'name' => 'required|string',
        ];

        $messages = [
            'name.required' => trans('quick::validation.names.required'),
            'name.string'   => trans('quick::validation.names.numeric'),
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

    }

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    public function store(Request $request) {

        try {

            DB::beginTransaction();

            Role::create(['name' => strtolower($request->get('name'))]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            expects_json_or_back($request, $e->getMessage());

        }

    }

}
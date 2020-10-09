<?php


namespace Developerhouse\Quick\Http\Facade;


use Developerhouse\Quick\Exceptions\RedirectException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class QPermissionFacade {

    /**
     * @param Request $request
     *
     * @throws RedirectException
     */
    public function validate(Request $request) {

        $rules = [
            'name'        => 'required|string',
            'description' => 'required|string',
        ];

        $messages = [
            'name.required' => trans('quick::validation.names.required'),
            'name.string'   => trans('quick::validation.names.numeric'),

            'description.required' => trans('quick::validation.description.required'),
            'description.string'   => trans('quick::validation.description.numeric'),
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

            Permission::create([
                'name'        => strtolower($request->get('name')),
                'description' => $request->get('description'),
            ]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            expects_json_or_back($request, $e->getMessage());

        }

    }
}
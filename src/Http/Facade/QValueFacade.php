<?php


namespace Developerhouse\Quick\Http\Facade;


use DB;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Models\Tables\Value;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QValueFacade {

    /**
     * @param Request $request
     * @param string  $case
     *
     * @throws RedirectException
     */
    public function validate(Request $request, string $case) {

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

        switch ($case) {

            case 'store':
                break;

            case 'update':

                array_merge($rules, ['state' => 'required|numeric']);

                array_merge($rules, [
                    'state.required' => trans('quick::validation.state.required'),
                    'state.string'   => trans('quick::validation.state.numeric'),
                ]);

                break;


        }

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
    public function store(Request $request): void {
        try {

            DB::beginTransaction();

            $value              = new Value();
            $value->name        = $request->get('name');
            $value->description = $request->get('description');
            $value->state       = 1;
            $value->save();

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            expects_json_or_back($request, $e->getMessage());


        }

    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @throws RedirectException
     */
    public function update(Request $request, int $id): void {

        try {

            DB::beginTransaction();

            $value              = Value::whereId($id)->firstOrFail();
            $value->name        = $request->get('name');
            $value->description = $request->get('description');
            $value->state       = $request->get('state');
            $value->update();

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            expects_json_or_back($request, $e->getMessage());


        }
    }


}
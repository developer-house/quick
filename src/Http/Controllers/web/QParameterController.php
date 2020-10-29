<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Authorizes\QParameterAuthorize;
use Developerhouse\Quick\Http\Authorizes\QValueAuthorize;
use Developerhouse\Quick\Http\Facade\QParameterFacade;
use Developerhouse\Quick\Http\Facade\QValueFacade;
use Developerhouse\Quick\Models\Tables\QUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QParameterController {

    protected $authorize;
    protected $facade;

    /**
     * QParameterController constructor.
     */
    public function __construct() {
        $this->authorize = new QParameterAuthorize();
        $this->facade    = new QParameterFacade();
    }


    /**
     * @param Request $request
     * @param int     $value_id
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function store(Request $request, int $value_id) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->store($user);

        $this->facade->validate($request, 'store');

        $this->facade->store($request);

        successful_message('Registro exitoso');

        return redirect()->route('value.show', $value_id);

    }

    /**
     * @param Request $request
     * @param int     $value_id
     * @param int     $parameter_id
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function update(Request $request, int $value_id, int $parameter_id) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->update($user);

        $this->facade->validate($request, 'update');

        $this->facade->update($request, $parameter_id);

        successful_message('Actualización exitosa');

        return redirect()->route('value.show', $value_id);

    }

}
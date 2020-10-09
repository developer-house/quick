<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Authorizes\QValueAuthorize;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Http\Facade\QValueFacade;
use Developerhouse\Quick\Models\Tables\Parameter;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\Value;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QValueController extends Controller {

    protected $authorize;
    protected $facade;

    /**
     * ValueController constructor.
     *
     */
    public function __construct() {
        $this->authorize = new QValueAuthorize();
        $this->facade    = new QValueFacade();
    }


    public function index(Request $request) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->index($user);

        return view('quick::layouts.values.index')->with([
            'values' => Value::where('name', 'like', '%' . $request->get('search') . '%')->simplePaginate(10),
        ]);
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function store(Request $request) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->store($user);

        $this->facade->validate($request, 'store');

        $this->facade->store($request);

        successful_message('Registro exitoso');

        return redirect()->route('value.index');

    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function update(Request $request, int $id) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->update($user);

        $this->facade->validate($request, 'update');

        $this->facade->update($request, $id);

        successful_message('Actualización exitosa');

        return redirect()->route('value.index');

    }

    public function show(Request $request, int $id) {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        $this->authorize->show($user);

        $parameters = Parameter::where('name', 'like', '%' . $request->get('search') . '%')
            ->where('value_id', '=', $id)
            ->simplePaginate(10);

        $value = Value::whereId($id)->firstOrFail();

        return view('quick::layouts.values.show')->with([
            'parameters' => $parameters,
            'value'      => $value,
        ]);

    }


}
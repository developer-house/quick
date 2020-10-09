<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Authorizes\QPermissionAuthorize;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Http\Facade\QPermissionFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class QPermissionController extends Controller {

    protected $authorize;
    protected $facade;

    /**
     * QPermissionController constructor.
     */
    public function __construct() {

        $this->authorize = new QPermissionAuthorize();
        $this->facade    = new QPermissionFacade();
    }

    public function index(Request $request) {

        $this->authorize->index();

        return view('quick::layouts.permissions.index')->with([
            'permissions' => Permission::where('name', 'like', '%' . $request->get('search') . '%')
                ->orderBy('id', 'desc')
                ->simplePaginate(10),

        ]);

    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function store(Request $request) {

        $this->authorize->create();

        $this->facade->validate($request);

        $this->facade->store($request);

        successful_message('Registro exitoso');

        return redirect()->route('permission.index');


    }
}
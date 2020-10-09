<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Http\Authorizes\QRolesAuthorize;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Http\Facade\QRolesFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class QRolesController extends Controller {

    protected $authorize;
    protected $facade;

    /**
     * QRolesController constructor.
     */
    public function __construct() {

        $this->authorize = new QRolesAuthorize();
        $this->facade    = new QRolesFacade();

    }

    public function index(Request $request) {

        $this->authorize->index();

        return view('quick::layouts.roles.index')->with([
            'roles' => Role::where('name', 'like', '%' . $request->get('search') . '%')->simplePaginate(10),
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

        return redirect()->route('role.index');


    }

    public function show(int $id) {

        $this->authorize->show();

        $role    = Role::findById($id);
        $permits = Permission::all()->reverse();

        return view('quick::layouts.roles.show')->with([
            'role'    => $role,
            'permits' => $permits,
        ]);


    }

    public function assign(Request $request) {

        $this->authorize->assign_permission_to_role();

        $role = Role::findById($request->get('role'));

        $permission = Permission::findById($request->get('permission'));

        $response = ['state' => 1, 'msg' => 'Buen trabajo'];

        if (!in_array($request->get('type'), ['1', '2'], true)) {
            return response()->json(['state' => 3, 'msg' => 'Error']);
        }

        if ($permission != null) {

            // 1 = Asignar
            if ($request->get('type') === '1') {

                $response = ['state' => 1, 'msg' => 'Permiso asignado con exito'];

                try {
                    $role->givePermissionTo($permission);
                } catch (Exception $e) {
                    $response = ['state' => 3, 'msg' => $e->getMessage()];
                }

            }

            // 2 = Revocar
            if ($request->get('type') === '2') {

                $response = ['state' => 1, 'msg' => 'Permiso revocado con exito'];

                try {
                    $role->revokePermissionTo($permission);
                } catch (Exception $e) {
                    $response = ['state' => 3, 'msg' => 'Error'];
                }

            }

        } else {
            $response = ['state' => 2, 'msg' => 'El permiso no existe'];
        }


        return response()->json($response);


    }


}
<?php


namespace Developerhouse\Quick\Http\Authorizes;


use Developerhouse\Quick\Models\Tables\QUser;
use Illuminate\Support\Facades\Auth;

class QRolesAuthorize {


    /**
     * QRolesAuthorize constructor.
     */
    public function __construct() { }

    public function index() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('role.index')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }

    public function create() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('role.create')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }


    public function show() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('role.show')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }

    public function assign_permission_to_role() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('assign.permission.to.role')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }


}
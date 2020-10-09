<?php


namespace Developerhouse\Quick\Http\Authorizes;


use Developerhouse\Quick\Models\Tables\QUser;
use Illuminate\Support\Facades\Auth;

class QPermissionAuthorize {


    /**
     * QPermissionAuthorize constructor.
     */
    public function __construct() { }

    public function index() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('permission.index')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }

    public function create() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('permission.create')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }

    public function assign_permission_to_user() {

        $user = QUser::whereId(Auth::id())->firstOrFail();

        if (!$user->can('assign.permission.to.user')) {
            abort(403, trans('quick::text.unauthorized'));
        }

    }
}
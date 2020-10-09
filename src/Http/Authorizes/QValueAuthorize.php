<?php


namespace Developerhouse\Quick\Http\Authorizes;


use Developerhouse\Quick\Models\Tables\QUser;

class QValueAuthorize {


    /**
     * ValueAuthorize constructor.
     */
    public function __construct() { }


    public function index(QUser $auth) {
        if (!$auth->can('value.index')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }

    public function store(QUser $auth) {
        if (!$auth->can('value.create')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }

    public function update(QUser $auth) {
        if (!$auth->can('value.update')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }

    public function show(QUser $auth) {
        if (!$auth->can('value.show')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }

}
<?php


namespace Developerhouse\Quick\Http\Authorizes;


use Developerhouse\Quick\Models\Tables\QUser;

class QParameterAuthorize {


    /**
     * ValueAuthorize constructor.
     */
    public function __construct() { }


    public function store(QUser $auth) {
        if (!$auth->can('parameter.create')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }

    public function update(QUser $auth) {
        if (!$auth->can('parameter.update')) {
            abort(403, trans('quick::text.unauthorized'));
        }
    }


}
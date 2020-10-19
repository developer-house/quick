<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Developerhouse\Quick\Http\Controllers\Controller;
use Developerhouse\Quick\Models\Tables\QUser;


class QHomeController extends Controller {

    public function __invoke() {
        return view('quick::layouts.welcome');
    }


}
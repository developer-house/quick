<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Developerhouse\Quick\Http\Controllers\Controller;


class QHomeController extends Controller {

    public function __invoke() {
        return view('quick::layouts.welcome');
    }


}
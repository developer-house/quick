<?php


namespace Developerhouse\Quick\Http\Controllers\web;


use Auth;
use Developerhouse\Quick\Exceptions\RedirectException;
use Developerhouse\Quick\Traits\QUserTrait;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class QUserController {

    use QUserTrait;

    public function profile(int $id) {

        return view('quick::layouts.user.profile')->with([
            'user' => Auth::user(),
        ]);
    }

    public function index(Request $request) {
        return view('quick::layouts.user.index')->with([
            'users' => User::all(),
        ]);
    }


    public function create() {

        //$roles = Role::where('id', '!=', 1)->get();
        $roles = Role::all();

        return view('quick::layouts.user.create')->with([
            'roles' => $roles,
        ]);
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws RedirectException
     */
    public function store(Request $request) {

        $validator = $this->validate_store($request);

        $store = $this->add($request);

        successful_message('Registro exitoso');

        return redirect()->route('users.index');


    }


}
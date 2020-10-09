<?php


use Developerhouse\Quick\Http\Controllers\web\QForgotPasswordController;
use Developerhouse\Quick\Http\Controllers\web\QLoginController;
use Developerhouse\Quick\Http\Controllers\web\QHomeController;
use Developerhouse\Quick\Http\Controllers\web\QParameterController;
use Developerhouse\Quick\Http\Controllers\web\QPasswordSecurityController;
use Developerhouse\Quick\Http\Controllers\web\QPermissionController;
use Developerhouse\Quick\Http\Controllers\web\QRolesController;
use Developerhouse\Quick\Http\Controllers\web\QUserController;
use Developerhouse\Quick\Http\Controllers\web\QValueController;
use Developerhouse\Quick\Http\Middleware\Q2FAMiddleware;
use Developerhouse\Quick\Http\Middleware\QAuthenticate;
use Developerhouse\Quick\Http\Middleware\QCheckSessionWebMiddleware;
use Developerhouse\Quick\Http\Middleware\QForceJsonResponse;
use Developerhouse\Quick\Http\Middleware\QOnlyAjax;
use Developerhouse\Quick\Http\Middleware\QPreventBackHistory;
use Developerhouse\Quick\Http\Middleware\QRedirectIfAuthenticated;


Route::middleware(QRedirectIfAuthenticated::class)->group(function () {
    Route::get(config('quick.route.login'), [QLoginController::class, 'showLoginForm'])->name('quick.login.from');
    Route::post(config('quick.route.login'), [QLoginController::class, 'login'])->name('quick.login.post');

    Route::get(config('quick.route.password.request'), [QForgotPasswordController::class, 'request'])->name('quick.password.request');
    Route::post(config('quick.route.password.email'), [QForgotPasswordController::class, 'email'])->name('quick.password.email');
    Route::get(config('quick.route.password.reset') . '/{token}', [QForgotPasswordController::class, 'reset'])->name('quick.password.reset');
    Route::post(config('quick.route.password.update'), [QForgotPasswordController::class, 'update'])->name('quick.password.update');

});


Route::middleware([QAuthenticate::class, Q2FAMiddleware::class, QPreventBackHistory::class, QCheckSessionWebMiddleware::class])->group(function () {

    Route::get(config('quick.route.auth_login_welcome'), QHomeController::class)->name('quick.welcome');
    Route::post(config('quick.route.auth_login_2fa_verify'), [QPasswordSecurityController::class, 'verify2fa'])->name('quick.security.verify2fa');
    Route::get(config('quick.route.profile'), [QUserController::class, 'profile'])->name('quick.profile');
    Route::get(config('quick.route.logout'), [QLoginController::class, 'logout'])->name('quick.logout');


    Route::resource(config('quick.route.values'), QValueController::class)->only(['index', 'show', 'store', 'update'])
        ->names(['index' => 'value.index', 'show' => 'value.show', 'store' => 'value.store', 'update' => 'value.update']);

    Route::resource(config('quick.route.values') . '/{id}/' . config('quick.route.parameters'), QParameterController::class)
        ->only(['store', 'update']);

    Route::resource(config('quick.route.users'), QUserController::class)->only(['index', 'show', 'store', 'create', 'update']);

    Route::resource(config('quick.route.roles'), QRolesController::class)->only(['index', 'show', 'store'])
        ->names(['index' => 'role.index', 'show' => 'role.show', 'store' => 'role.store']);

    Route::post('assign/permission/to/role', [QRolesController::class, 'assign'])
        ->name('assign.permission.to.role')
        ->middleware([QOnlyAjax::class, QForceJsonResponse::class]);

    Route::resource(config('quick.route.permission'), QPermissionController::class)->only(['index', 'store'])
        ->names(['index' => 'permission.index', 'store' => 'permission.store']);


});



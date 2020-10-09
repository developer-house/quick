<?php


namespace Developerhouse\Quick\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        $this->routes(function () {

            Route::middleware('web')
                ->group(__DIR__.'/../../routes/web.php');
        });
    }

}
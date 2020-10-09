<?php


namespace Developerhouse\Quick\Providers;

use Developerhouse\Quick\Commands\SeederCommands;
use Developerhouse\Quick\Exceptions\CustomHandler;
use Developerhouse\Quick\Helper\ClassHelpers;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;


class QuickServiceProvider extends ServiceProvider {

    public function boot() {

        $this->app->bind(
            ExceptionHandler::class,
            CustomHandler::class
        );

        $this->loadViewsFrom($this->basePath('resources/views/'), 'quick');
        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadTranslationsFrom($this->basePath('resources/lang/'), 'quick');


        $this->publishes([$this->basePath('resources/views/') => resource_path('views/vendor/quick')], 'quick-views');
        $this->publishes([$this->basePath('resources/assets/') => resource_path('views/vendor/quick/assets'),], 'quick-assets');
        $this->publishes([$this->basePath('config/quick.php') => base_path('config/quick.php'),], 'quick-config');


        //$this->publishes([$this->basePath('database/migrations/') => database_path('migrations')], 'quick-migrations');
        //this->publishes([$this->basePath('database/seeders') => database_path('seeders'),], 'quick-seeders');


        $this->commands([
            SeederCommands::class,
        ]);

    }

    public function register() {

        $this->app->bind('quick', function () {
            return new ClassHelpers;
        });

        $this->mergeConfigFrom($this->basePath('config/quick.php'), 'quick');

    }

    protected function basePath($path = '') {
        return __DIR__ . '/../../' . $path;
    }


}
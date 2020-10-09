<?php


namespace Developerhouse\Development\Facade;


use Illuminate\Support\Facades\Facade;

class QuickFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'quick';
    }

}
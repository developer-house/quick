<?php

return [


    /*
    * Listado de rutas
    */
    'route' => [
        'values'                => 'values',
        'parameters'            => 'parameters',
        'login'                 => 'login',
        'password'              => [
            'request' => 'password/request',
            'email'   => 'password/email',
            'update'  => 'password/update',
            'reset'   => 'password/reset',
        ],
        'auth_login_welcome'    => 'welcome',
        'auth_login_2fa_verify' => 'verify/2fa',
        'logout'                => 'logout',
        'roles'                 => 'role',
        'permission'            => 'permission',
    ],

    'template' => [
        'boxed'  => 'container',
        'layout' => 'detached',
        'logo'   => 'http://itsa.edu.co/images/logo.png',
    ],


    'login' => [
        'logo' => 'http://itsa.edu.co/images/logo.png',
    ],

    'text' => [
        'name' => 'Quick',
    ],


];
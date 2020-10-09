<?php


namespace Developerhouse\Quick\Commands;


use DB;
use Developerhouse\Quick\Models\Tables\City;
use Developerhouse\Quick\Models\Tables\Country;
use Developerhouse\Quick\Models\Tables\Department;
use Developerhouse\Quick\Models\Tables\ModelHasPermission;
use Developerhouse\Quick\Models\Tables\ModelHasRoles;
use Developerhouse\Quick\Models\Tables\Parameter;
use Developerhouse\Quick\Models\Tables\PasswordSecurity;
use Developerhouse\Quick\Models\Tables\QUser;
use Developerhouse\Quick\Models\Tables\RoleHasPermission;
use Developerhouse\Quick\Models\Tables\UserSetting;
use Developerhouse\Quick\Models\Tables\Value;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SeederCommands extends Command {

    protected $signature = 'quick:seeder';

    protected $description = 'Create the user for the login';

    public function handle() {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {

            DB::beginTransaction();

            $this->roles();

            $this->values();
            $this->parameters();

            $this->countries();
            $this->cities();
            $this->departments();

            $this->user();

            DB::commit();

        } catch (Exception $e) {

            dd($e);

            DB::rollBack();

            return $e;

        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return true;

    }

    protected function user(): void {

        DB::table('users')->truncate();

        $user              = new QUser();
        $user->id          = 1;
        $user->names       = 'Developer';
        $user->surnames    = 'House S.A.S';
        $user->username    = 'developerhouse';
        $user->email       = 'quick@developerhouse.co';
        $user->type_dni_id = null;
        $user->dni         = null;
        $user->state_id    = 1;
        $user->gender_id   = 3;
        $user->password    = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->save();

        $rol             = new ModelHasRoles();
        $rol->role_id    = 1;
        $rol->model_type = 'App\Models\User';
        $rol->model_id   = $user->id;
        $rol->save();

        $setting          = new UserSetting();
        $setting->user_id = $user->id;
        $setting->save();

        // Agregue la clave secreta a los datos de registro
        $secretKey                   = new PasswordSecurity();
        $secretKey->user_id          = $user->id;
        $secretKey->google2fa_enable = 0;
        $secretKey->google2fa_secret = app('pragmarx.google2fa')->generateSecretKey();
        $secretKey->save();


    }

    protected function countries(): void {

        DB::table('countries')->truncate();

        $countries = [
            /* ['id', 'name', 'abbreviation', 'state_id'] */
            [1, 'Default', 'def', 9],
            [2, 'Colombia', 'col', 9],
            [3, 'Venezuela', 'ven', 9],
        ];

        foreach ($countries as $item) {
            $country               = new Country();
            $country->id           = $item[0];
            $country->name         = $item[1];
            $country->abbreviation = $item[2];
            $country->state_id     = $item[3];
            $country->save();
        }

    }

    protected function departments(): void {

        DB::table('departments')->truncate();

        $items = [];

        $colombia = [
            /* ['id', 'country_id', 'code', 'name', 'state_id'] */
            [1, 1, 'Default', 9],
            [2, 2, 'Antioquia', 9],
            [3, 2, 'Atlántico', 9],
        ];

        $items = array_merge($items, $colombia);

        foreach ($items as $item) {
            $department             = new Department();
            $department->id         = $item[0];
            $department->country_id = $item[1];
            $department->name       = $item[2];
            $department->state_id   = $item[3];
            $department->save();
        }
    }

    protected function cities(): void {

        DB::table('cities')->truncate();

        $cities = [
            [1, 1, 'Default', 9],
            [2, 2, 'Medellin', 9],
            [3, 3, 'Barranquilla', 9],
        ];

        foreach ($cities as $item) {
            $city                = new City();
            $city->id            = $item[0];
            $city->department_id = $item[1];
            $city->name          = $item[2];
            $city->state_id      = $item[3];
            $city->save();
        }


    }

    protected function roles(): void {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /* Roles */
        $root = Role::create(['name' => 'root']);


        /* Permisos */
        $arrayList = [

            'user' => [
                'user.list',
                'user.create',
                'user.show',
                'user.update',
                'user.delete',
            ],

            'values' => [
                'value.index',
                'value.create',
                'value.show',
                'value.update',
            ],

            'parameter' => [
                'parameter.create',
                'parameter.update',
            ],

            'roles' => [
                'role.index',
                'role.create',
                'role.show',
            ],

            'permission' => [
                'permission.index',
                'permission.create',
            ],

            'assign.permission.to.role' => [
                'assign.permission.to.role',
            ],

            'assign.permission.to.user' => [
                'assign.permission.to.user',
            ],

            'assign.role.to.user' => [
                'assign.role.to.user',
            ],


        ];

        foreach ($arrayList as $list) {

            foreach ($list as $item) {

                $permission              = new Permission();
                $permission->name        = $item;
                $permission->guard_name  = 'web';
                $permission->description = 'Sin def.';
                $permission->save();

                $role_has_permission                = new RoleHasPermission();
                $role_has_permission->permission_id = $permission->id;
                $role_has_permission->role_id       = $root->id;
                $role_has_permission->save();

                $model_has_permission                = new ModelHasPermission();
                $model_has_permission->permission_id = $permission->id;
                $model_has_permission->model_type    = 'Developerhouse\Quick\Models\Tables\QUser';
                $model_has_permission->model_id      = 1;
                $model_has_permission->save();


            }


        }

    }

    protected function values(): void {

        DB::table('values')->truncate();

        $items = [
            [1, 'Estados de los usuarios', ''],
            [2, 'Tipos de dni', ''],
            [3, 'Géneros', ''],
            [4, 'Estados activo o inactivo', ''],
            [5, 'Medios para operar en la plataforma', ''],
            [6, 'Estados de los intentos de inicio de sesión', ''],
        ];

        foreach ($items as $item) {
            $value              = new Value();
            $value->id          = $item[0];
            $value->name        = $item[1];
            $value->description = $item[2];
            $value->save();
        }

    }

    protected function parameters(): void {

        DB::table('parameters')->truncate();

        $items = [];

        /***
         * Estados de los usuarios
         */
        $item_1 = [
            [1, 1, 'Activo', 1, 'Sin def.'],
            [2, 1, 'Inactivo', 1, 'Sin def.'],
            [3, 1, 'Pendiente', 1, 'Sin def.'],
        ];

        /***
         * Tipos de dni
         */
        $item_2 = [
            [4, 2, 'C.C.', 1, 'Sin def.'],
            [5, 2, 'C.E.', 1, 'Sin def.'],
            [6, 2, 'T.I.', 1, 'Sin def.'],
        ];

        /***
         * Géneros
         */
        $item_3 = [
            [7, 3, 'Mujer', 1, 'Sin def.'],
            [8, 3, 'Hombre', 1, 'Sin def.'],
        ];

        /*
         * Estados activo o inactivo
         */
        $item_4 = [
            [9, 4, 'Activo', 1, 'Sin def.'],
            [10, 4, 'Inactivo', 1, 'Sin def.'],
        ];

        /*
         * Medios para operar en la plataforma
         */
        $item_5 = [
            [11, 5, 'Aplicación web', 1, 'Sin def.'],
            [12, 5, 'Aplicación móvil', 1, 'Sin def.'],
        ];

        /*
         * Estados de los intentos de inicio de sesión
         */
        $item_6 = [
            [13, 5, 'Contraseña incorrecta', 1, 'Sin def.'],
            [14, 5, 'Exito', 1, 'Sin def.'],
        ];


        $items = array_merge($items, $item_1);
        $items = array_merge($items, $item_2);
        $items = array_merge($items, $item_3);
        $items = array_merge($items, $item_4);
        $items = array_merge($items, $item_5);
        $items = array_merge($items, $item_6);


        foreach ($items as $item) {
            $parameter              = new Parameter();
            $parameter->id          = $item[0];
            $parameter->value_id    = $item[1];
            $parameter->name        = $item[2];
            $parameter->description = $item[4];
            $parameter->state       = '1';
            $parameter->save();
        }


    }


}
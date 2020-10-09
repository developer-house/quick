#Quick - Developer House S.A.S

**Quick** es una plantilla de administración totalmente responsive. Basado en el marco Bootstrap 4.5.2 y también en el complemento JS/jQuery. Se adapta a muchas resoluciones de pantalla, desde pequeños dispositivos móviles hasta grandes escritorios.
                
## Instalación
Comience agregando **developerhouse/quick** al archivo **composer.json** y luego realice **composer update** o también si prefiere ejecutar el siguiente comando 

``` 
composer require developerhouse/quick
```

Adicional se requiere los siguientes paquetes via **NPM**, en caso que su proyecto ya tenga instalado algún paquete en la lista, omítalo

``` 
npm install <package_name> --save-dev
```
* __bootstrap__
* __jquery__
* __popper.js__
* __sass__
* __sass-loader__
* __vue-template-compiler__

Una vez terminada la instalación publique los archivos del paquete, como las migraciones, el archivo de configuración, las vistas y los archivos scss y js.
``` 
php artisan vendor:publish --provider="Developerhouse\Quick\Providers\QuickServiceProvider" --force
```

Agregue las siguientes lineas de código a su archivo **webpack.mix.js** 
``` 
/*
 |--------------------------------------------------------------------------
 | Mix Asset Quick
 |--------------------------------------------------------------------------
 |
 */
 mix.js('resources/views/vendor/quick/assets/js/app.js', 'public/quick/js');
 mix.sass('resources/views/vendor/quick/assets/scss/app.scss', 'public/quick/css');
```
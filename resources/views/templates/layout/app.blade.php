<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="{{ asset('quick/css/app.css') }}?v1.0.0" rel="stylesheet">

        <link href="https://fonts.developerhouse.co/AvenirNext/assets/css/style.css" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('quick/js/app.js') }}?v1.0.0" defer></script>

        @stack('head')

    </head>

    <body class="{{ config('quick.template.layout') }}">


        @include('quick::templates.layout.header')

        <main id="content" class="content" role="main">

            <div class="content {{ config('quick.template.boxed') }} wrapper">

                {{-- @include('quick::templates.layout.aside') --}}



                <aside id="aside">

                    <div class="aside-container">

                        <header>
                            <hr class="line d-none d-md-block">
                            <div class="info">
                                <p class="text">Hola, {{ get_greeting() }}</p>
                                <h2 class="name">{{ Auth::user()->names }}</h2>
                            </div>
                            <hr class="line d-md-none">
                        </header>

                        <ul class="menu">

                            @can('panel.general')
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="home"></i>
                                        <span class="text-truncate">General</span>
                                    </a>
                                    <ul>
                                        <li>
                                            <span class="text-truncate">Dashboards</span>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can('panel.administrator')
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="home"></i>
                                        <span class="text-truncate">Administrador</span>
                                    </a>
                                    <ul>
                                        @can('user.index')
                                            <li>
                                                <a href="{{ route('users.index') }}">
                                                    <span>Usuarios</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('panel.root')

                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="layers"></i>
                                        <span class="text-truncate">Root</span>
                                    </a>
                                    <ul>

                                        @can('value.index')
                                            <li>
                                                <a href="{{ route('value.index') }}">
                                                    <span class="text-truncate">Parámetros</span>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('role.index')
                                            <li>
                                                <a href="{{ route('role.index') }}">
                                                    <span class="text-truncate">Roles</span>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('permission.index')
                                            <li>
                                                <a href="{{ route('permission.index') }}">
                                                    <span class="text-truncate">Permisos</span>
                                                </a>
                                            </li>

                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </aside>


                <section id="section">

                    <header>
                        <div class="info">
                            <p class="text">Hola, {{ get_greeting() }}</p>
                            <h2 class="name">{{ Auth::user()->names }}</h2>
                        </div>
                        <hr class="line d-md-none">
                    </header>


                    @yield('content')


                </section>

            </div>

            <div class="overlord"></div>

        </main>

        @stack('modal')

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error('{{ $error }}');
                    @endforeach
                @endif

                @if (Session::get('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif

                @if (Session::get('error'))
                    toastr.error('{{ Session::get('error') }}');
                @endif

            });
        </script>



        @stack('script')

    </body>

</html>

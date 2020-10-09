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

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('quick/js/app.js') }}?v1.0.0" defer></script>


        @stack('head')

    </head>

    <body>

        <main>

            <div class="auth">

                <div class="wrapper">

                    @yield('content')

                </div>

            </div>

        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        window.toastr.error('{{ $error }}');
                    @endforeach
                @endif

                @if (Session::get('success'))
                    window.toastr.success('{{ Session::get('success') }}');
                @endif

                @if (Session::get('error'))
                    window.toastr.error('{{ Session::get('error') }}');
                @endif

            });
        </script>

    </body>



</html>

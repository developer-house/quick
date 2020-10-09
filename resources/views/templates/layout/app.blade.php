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

                @include('quick::templates.layout.aside')


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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ str_replace("_", " ", config('app.name', 'TecnoBot')) }}</title>

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ str_replace("_", " ", config('app.name', 'TecnoBot')) }}
                    </a>

                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <div class="flex-center position-ref full-height">
            <div class="error-page">
                <h2 class="headline text-red">404</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i>La página solicitada no existe<br><br></h3>

                    <p>
                        Puede regresar a la ultima pagina visitada, <a href="javascript:history.go(-1)">Volver</a><br />
                        @if (session('pagina_inicio') == "")
                            o ir a la pagina de inicio, <a href="{{ url('/') }}/{{ config('app.paginainiurl', '/home') }}">{{ config("app.paginaininom", "Home") }}</a>
                        @else
                            o ir a la pagina de inicio, <a href="{{ url('/') }}/{{ session('pagina_inicio') }}">{{ session('pagina_inicio') }}</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
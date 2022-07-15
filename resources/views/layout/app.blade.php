<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/Favicon-EmpleosAqua2.png" type="image/x-icon"/>

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-184220893-1"></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8544975266159001"
            crossorigin="anonymous"></script>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey' : '6Lc5wGwcAAAAAMgqHGq8JHvZ-bZCLEnAFS1Ppxkf'
            });
        };
    </script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-184220893-1');
    </script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('scripts')

    @stack('styles')

    <style>
        @media (min-width: 960px) {
            .container-app {
                width: 1300px;
                max-width: 1300px !important;
            }
        }
    </style>
</head>

<body class="app">
<div class="page-container">
    <div id="app" style="max-width: 100%;">
        <nav id="nav-bolsa" class="fixed-top navbar navbar-expand-md navbar-light">
            <div class="container container-app">
                <a class="navbar-brand" href="{{url('/')}}">
                    {{config('app.name', 'Bolsa de empleo')}}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">

                    @if(session()->has('role'))

                        @include('partials.navigation.' . session()->get('role'))
                    @else
                        @include('partials.navigation.guest')
                    @endif
                </div>
            </div>
        </nav>

        <main class="py-3">
            @yield('content')
        </main>
    </div>
    <footer class="container-fluid">
        <div class="container container-app">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img src="/../images/footer-b2b.png" class="d-inline-block pr-3 border-right">
                    <div class="d-none d-md-inline-block align-middle pl-3">
                        <p class="text-white small m-0">© 2013 B2Bmg ® Todos los derechos
                            reservados</p>
                        <p class="text-white small m-0">Benavente 550 oficina 305, Edificio Campanario, Puerto Montt, Chile. Tel: (56) 65 2470107</p>
                        <p class="text-white small m-0">Magnere 1540 oficina 801, Providencia, Santiago de Chile. Tel: (56-2) 27574200</p>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </footer>
    @stack('footer')
</div>
</body>

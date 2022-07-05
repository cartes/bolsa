<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <meta name="description"
          content="Ofertas de trabajo. Publique sus ofertas laborales con nosotros. Busque el puesto de trabajo que necesita. Tenemos experiencia como Bolsa de Empleos Aqua"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-184220893-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-184220893-1');
    </script>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    @stack('scripts')

    @stack('styles')
</head>

<body class="home">
<div class="page-container">
    <div id="app">
        <nav id="nav-bolsa" class="navbar navbar-expand-md navbar-light">
            <div class="container">
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

        <main id="home-main">
            @yield('content')
        </main>
    </div>

    <footer class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img src="/../images/footer.png" class="d-inline-block pr-3 border-right">
                    <div class="d-block d-md-inline-block align-middle pl-3">
                        <p class="text-white small m-0">© 2013 Grupo Editorial Editec SPA ® Todos los derechos
                            reservados</p>
                        <p class="text-white small m-0">San Crescente 81, piso 5. Las Condes, Santiago de Chile.
                            Tel:(56-2) 27574200</p>
                        <p class="text-white small m-0">Freire 130, oficina 201, PuertoMontt, Chile. Tel: (56-65)
                            2348911</p>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
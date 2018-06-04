<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K5D9W2C');</script>
    <!-- End Google Tag Manager -->
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}

    {{-- <title>mytrackr</title> --}}

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}?v={{env('CACHEBUST_KEY')}}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}?v={{env('CACHEBUST_KEY')}}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('/img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ secure_asset('/img/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ secure_asset('/img/safari-pinned-tab.svg') }}" color="#8d6a9f">
    <link rel="shortcut icon" href="{{ secure_asset('/img/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#8d6a9f">
    <meta name="msapplication-TileImage" content="{{ secure_asset('/img/mstile-144x144.png') }}">
    <meta name="msapplication-config" content="{{ secure_asset('/img/browserconfig.xml') }}">
    <meta name="theme-color" content="#8D6A9F">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5D9W2C"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('layouts.header')

    {{-- HACKY --}}
    <div class="spacer" style="padding-bottom: 85px"></div>
    {{ Breadcrumbs::render() }}
    <div id="app">
        @yield('content')
    </div>
    
    @include('layouts.footer')
    @stack('scripts-after')
</body>
</html>

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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v={{env('CACHEBUST_KEY')}}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{env('CACHEBUST_KEY')}}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5D9W2C"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <div id="app">
        <header class="header--slim">
            <span class="u-logo-text">my<span>track</span>r</span>
        </header>
        {{ Breadcrumbs::render() }}
        @yield('content')
    </div>
    @stack('scripts-after')
</body>
</html>

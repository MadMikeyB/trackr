<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>mytrackr</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v={{env('CACHEBUST_KEY')}}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{env('CACHEBUST_KEY')}}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>
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

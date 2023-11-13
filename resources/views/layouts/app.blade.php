@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{asset('maail.png')}}">

    <style>
        .navbar .nav-item .nav-link:hover {
            background-image: linear-gradient(to right, pink, blue);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent; 
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class= bg color: rgb(31,140,12)>
<div id="app">
   

    <main class="py-4 container">
        @include('layouts.flash-message')
        @yield('content')
    </main>
</div>

@yield('footer')
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
</script>
</body>
</html>

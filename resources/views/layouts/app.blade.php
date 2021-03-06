<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        // var admin = false;
        // if({{ Auth::user() }}){
        //     admin = Auth::user()->hasRole('admin') ;
        // } else {
        //     admin = false;
        // }

        // console.log(admin);

        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            // 'isAdmin' => Auth::user()->hasRole('admin') ? true:false
        ])!!}
    </script>

    <style>
        body{
            padding-bottom: 100px;
        }

        .level{ display: flex; align: center; }

        .flex{ flex: 1; }

        .mr-1{ margin-right: 1em;}

        .ml-a { margin-left: auto; }

        [v-cloak]{ display: none }

    </style>
</head>
<body >
    <div id="app">
        @include('layouts.nav');
        @yield('content')
      
        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

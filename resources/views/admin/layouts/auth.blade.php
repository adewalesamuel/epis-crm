<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{ $title ?? '' }} | Epistrophe App</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

       <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
       <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
       <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    </head>


    <body>

        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div class="accountbg"></div>
        <div class="wrapper-page">
            @yield('content')
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>


        <script src="{{ asset('assets/pages/auth.js') }}"></script>

    </body>
</html>
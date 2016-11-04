<?php
$user = \Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = <?= json_encode(['csrfToken' => csrf_token()]) ?>;
    </script>

    <title>{{$meta['title'] or app_info('name.full')}}</title>
    <meta name="description" content="{{$meta['description'] or app_info('name.full')}}">
    <meta name="author" content="{{$meta['author'] or app_info('name.full')}}">

    <!-- Styles -->
    <link rel="icon" href="{{ asset('icon.png') }}">
    <link href="{{asset('css/material.icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.theme.css')}}" rel="stylesheet">
    @yield('extra_heads')
</head>
<body class="grey lighten-4">

<header>
    <nav class="blue">
        <div class="container">
            <div class="nav-wrapper">
                <a class="logo left" href="{{url()->route('app.home')}}">
                    <img src="{{asset('icon.svg')}}" class="logo">
                    <i class="material-icons left">trending_up</i>
                </a>
                <a data-activates="nav-mobile" class="button-collapse right">
                    <i class="material-icons">menu</i>
                </a>
                @yield('header')
            </div>
        </div>
        <form id="logout-form" action="{{ url()->route('auth.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer class="page-footer transparent">
    @yield('footer')
</footer>

<!-- Scripts -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".button-collapse").sideNav();
        $('.dropdown-button').dropdown({
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            belowOrigin: true // Displays dropdown below the button
        });
    })
</script>
@yield('extra_scripts')
</body>
</html>

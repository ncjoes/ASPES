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

    <title>{{$meta['title'] or config('app.name')}}</title>
    <meta name="description" content="{{$meta['description'] or config('app.name')}}">
    <meta name="author" content="{{$meta['author'] or config('app.name')}}">

    <!-- Styles -->
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <link href="{{asset('css/material.icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.theme.css')}}" rel="stylesheet">
    @yield('extra_heads')
</head>
<body class="grey lighten-4">

<header>
    @yield('header')
</header>
<main>
    @yield('content')
</main>
<footer class="page-footer white black-text border-shadow-top-out outline-top">
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

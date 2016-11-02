@extends('layouts.app')

@section('header')
    <nav class="blue">
        <div class="container">
            <div class="nav-wrapper">
                <a data-activates="nav-mobile" class="button-collapse right">
                    <i class="material-icons">menu</i>
                </a>

                <a class="logo left" href="{{url()->route('app.home')}}">
                    <i class="material-icons">trending_down home trending_up</i>
                </a>
                <ul class="hide-on-med-and-down right">
                    <li><a href="{{url()->route('auth.login')}}">LOG IN</a></li>
                    <li><a href="{{url()->route('auth.signup')}}">SIGN UP</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="{{url()->route('app.home')}}"><i class="material-icons small">trending_down home trending_up</i></a></li>
                    <li class="divider"></li>
                    <li><a href="{{url()->route('auth.login')}}"><i class="material-icons">lock_open</i>LOG IN</a></li>
                    <li><a href="{{url()->route('auth.signup')}}"><i class="material-icons">person_add</i>SIGN UP</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('footer')
    @include('parts.footer_mini')
@endsection

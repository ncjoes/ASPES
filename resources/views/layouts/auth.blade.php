@extends('layouts.app')

@section('header')
    <ul class="hide-on-med-and-down right">
        <li><a href="{{url()->route('app.home')}}"><i class="material-icons">home</i></a></li>
        <li><a href="{{url()->route('auth.login')}}">LOG IN</a></li>
        <li><a href="{{url()->route('auth.signup')}}">SIGN UP</a></li>
    </ul>

    <ul id="nav-mobile" class="side-nav">
        <li><a href="{{url()->route('app.home')}}"><i class="material-icons">home</i>HOME</a></li>
        <li class="divider"></li>
        <li><a href="{{url()->route('auth.login')}}"><i class="material-icons">lock_open</i>LOG IN</a></li>
        <li><a href="{{url()->route('auth.signup')}}"><i class="material-icons">person_add</i>SIGN UP</a></li>
        <li class="divider"></li>
    </ul>
@endsection

@section('footer')
    @include('parts.footer_mini')
@endsection

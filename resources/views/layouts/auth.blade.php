@extends('layouts.app')

@section('header')
    <ul class="hide-on-med-and-down right">
        @include('parts.nav-desktop_home')
        @include('parts.nav-desktop_auth')
    </ul>

    <ul id="nav-mobile" class="side-nav">
        @include('parts.nav-mobile_home')
        @include('parts.nav-mobile_auth')
        <li class="divider"></li>
    </ul>
@endsection

@section('footer')
    @include('parts.footer-mini')
@endsection

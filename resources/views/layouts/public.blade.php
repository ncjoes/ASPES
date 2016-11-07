<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/21/2016
 * Time:    8:33 PM
 **/
$user = \Auth::user();
?>
@extends('layouts.app')

@section('header')
    <ul class="hide-on-med-and-down right">
        @if(request()->route()->getName()!=='app.home')
            @include('parts.nav-desktop_home')
        @endif
        <li>
            <a href="{{url()->route('app.live.list')}}" style="background-color: white; color: #2196F3; min-width: 8em;">
                <i class="material-icons left">timelapse</i> LIVE
            </a>
        </li>
        <li><a href="{{url()->route('app.results.list')}}">RESULTS</a></li>
        @if($user)
            @if($user->isAdmin())
                <li><a href="{{url()->route('admin.dashboard')}}"><i class="material-icons">dashboard</i></a></li>
            @endif
            @include('parts.nav-desktop_user')
        @else
            @include('parts.nav-desktop_auth')
        @endif
    </ul>

    <ul id="nav-mobile" class="side-nav">
        @include('parts.nav-mobile_home')
        <li><a href="{{url()->route('app.live.list')}}" class="font-bold"><i class="material-icons right">timelapse</i>LIVE</a></li>
        <li><a href="{{url()->route('app.results.list')}}"><i class="material-icons right">trending_up</i>RESULTS</a></li>
        @if($user)
            @if($user->isAdmin())
                <li><a href="{{url()->route('admin.dashboard')}}"><i class="material-icons right">dashboard</i>ADMIN. DASHBOARD</a></li>
            @endif
            <li class="divider"></li>
            @include('parts.nav-mobile_user')
        @else
            <li class="divider"></li>
            @include('parts.nav-mobile_auth')
        @endif
        <li class="divider"></li>
    </ul>
@endsection

@section('footer')
    @include('parts.footer-mega')
@endsection

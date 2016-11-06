<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    6:48 PM
 **/
$user = \Auth::user();
?>
@extends('layouts.app')

@section('header')
    <ul class="hide-on-med-and-down right">
        @if(request()->route()->getName()!=='app.home')
            @include('parts.nav-desktop_home')
        @endif
        <li><a href="{{url()->route('admin.dashboard')}}"><i class="material-icons">dashboard</i></a></li>
        <li><a href="{{url()->route('admin.exercises.list')}}">EXERCISES</a></li>
        <li><a href="{{url()->route('admin.users.list')}}">USERS</a></li>
        <li><a href="{{url()->route('admin.notes.list')}}">NOTIFICATIONS</a></li>
        <li><a href="{{url()->route('admin.settings')}}">SETTINGS</a></li>
        @include('parts.nav-desktop_user')
    </ul>

    <ul id="nav-mobile" class="side-nav">
        @include('parts.nav-mobile_home')
        <li><a href="{{url()->route('admin.dashboard')}}">DASHBOARD</a></li>
        <li><a href="{{url()->route('admin.exercises.list')}}">EXERCISES</a></li>
        <li><a href="{{url()->route('admin.users.list')}}">USERS</a></li>
        <li><a href="{{url()->route('admin.notes.list')}}">NOTIFICATIONS</a></li>
        <li><a href="{{url()->route('admin.settings')}}">SETTINGS</a></li>
        <li class="divider"></li>
        @include('parts.nav-mobile_user')
        <li class="divider"></li>
    </ul>
@endsection

@section('footer')
    @include('parts.footer-mini')
@endsection

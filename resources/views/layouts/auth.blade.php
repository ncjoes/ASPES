<?php
/**
 * Project: academy.zeesaa.com
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/21/2016
 * Time:    8:36 PM
 * */
?>
@extends('layouts.app')

@section('header')
    <nav class="white z-depth-0 z-depth-half">
        <div class="container">
            <div class="nav-wrapper">
                <a href="#" data-activates="nav-mobile" class="button-collapse right">
                    <i class="material-icons black-text">menu</i>
                </a>

                <a href="{{url()->route('app.home')}}"><img class="logo" src="{{url('/images/logo.png')}}"></a>
                <ul class="hide-on-med-and-down right">
                    <li><a href="{{url()->route('auth.signup')}}">Sign Up</a></li>
                    <li><a href="{{url()->route('auth.login')}}">Log In</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="{{url()->route('auth.login')}}"><i class="material-icons">lock_open</i>Log In</a></li>
                    <li><a href="{{url()->route('auth.signup')}}"><i class="material-icons">person_add</i>Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('footer')
    @include('parts.footer_mini')
@endsection

<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    6:48 PM
 **/
?>
@extends('layouts.app')

@section('header')
    <ul class="hide-on-med-and-down right">
        <li><a href="{{url()->route('admin.dashboard')}}"><i class="material-icons">dashboard</i></a></li>
        <li><a href="{{url()->route('admin.exercises.list')}}">EXERCISES</a></li>
        <li><a href="{{url()->route('admin.users.list')}}">USERS</a></li>
        <li><a href="{{url()->route('admin.notes.list')}}">NOTIFICATIONS</a></li>
        <li><a href="{{url()->route('admin.settings')}}">SETTINGS</a></li>
        <li>
            <a class="dropdown-button" data-activates="dropdown-1">
                <i class="material-icons small">person</i>
            </a>
        </li>
    </ul>

    <ul class="dropdown-content" id="dropdown-1">
        <li>
            <a href="{{url()->route('profile.view')}}" class="font-sm">
                <span class="material-icons font-inherit">edit</span> My Profile
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a onclick="event.preventDefault(); $('#logout-form').submit();" class="font-sm">
                <span class="material-icons font-inherit">lock</span> Sign Me Out
            </a>
        </li>
    </ul>

    <ul id="nav-mobile" class="side-nav">
        <li><a href="{{url()->route('app.home')}}"><i class="material-icons small">home</i>HOME</a></li>
        <li class="divider"></li>
        <li><a href="{{url()->route('admin.dashboard')}}">DASHBOARD</a></li>
        <li><a href="{{url()->route('admin.exercises.list')}}">EXERCISES</a></li>
        <li><a href="{{url()->route('admin.users.list')}}">USERS</a></li>
        <li><a href="{{url()->route('admin.notes.list')}}">NOTIFICATIONS</a></li>
        <li><a href="{{url()->route('admin.settings')}}">SETTINGS</a></li>
        <li class="divider"></li>
        <li>
            <a href="{{url()->route('profile.view')}}">
                <i class="material-icons small">account_circle</i>
                @if(!empty(\Auth::user()->name()))
                    {{\Auth::user()->name()}}
                @else
                    MY PROFILE
                @endif
                <span class="badge font-sm">PROFILE</span>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a onclick="event.preventDefault(); $('#logout-form').submit();">
                <i class="material-icons">lock</i> LOG OUT
            </a>
        </li>
        <li class="divider"></li>
    </ul>
@endsection

@section('footer')
    @include('parts.footer_mini')
@endsection

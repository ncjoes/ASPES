<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    12:16 PM
 **/
$user = \Auth::user();
?>
@extends('layouts.public')
@section('content')
    <div class="section">
        <div class="valign-wrapper mh-50vh">
            <div class="container valign">
                <div class="row">
                    <div class="col l6 offset-l0 m10 offset-m1 s10 offset-s1">
                        <div class="row">
                            <h4>Welcome to {{app_info('name.abbr')}}</h4>
                            <p class="font-lg">
                                {{app_info('description.short')}}
                            </p>
                        </div>
                    </div>
                    <div class="col l5 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half">
                        @if($user)
                            <div>
                                <h5><i class="material-icons left">person</i> {{!empty($user->name()) ? $user->name() : 'User'}}</h5>
                                <p class="font-lg">
                                    ToDo
                                    <br/>
                                    {fetch and display exercises that this user has been selected to partake in}
                                    <br/>
                                    {fetch and display exercises that this user is currently being evaluated in}
                                    <br/>
                                    {fetch and display all current exercises}
                                </p>
                            </div>
                        @else
                        <div class="center-align">
                            <h5>Lets get your opinions heard!</h5>
                            <p class="font-lg">
                                Together we can make our education system better for all.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <p>
                                    <a href="{{url()->route('auth.signup')}}" class="btn btn-large z-depth-half full-width">
                                        SIGN UP NOW
                                    </a>
                                </p>
                            </div>
                            <div class="col m6 s12">
                                <p>
                                    <a href="{{url()->route('auth.login')}}" class="btn btn-large z-depth-half full-width">
                                        LOGIN IN
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row hide-on-small-only">
                            <div class="divider col s5"></div>
                            <div class="col s2 center-align font-bold">OR</div>
                            <div class="divider col s5"></div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

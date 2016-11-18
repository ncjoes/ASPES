<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    12:16 PM
 **/
$user = \Auth::user();
$leCount = count($invited);
$lsCount = count($listed);
?>
@extends('layouts.public')
@section('content')
    <div class="section">
        <div class="valign-wrapper sh-70vh mh-60vh">
            <div class="container valign">
                <div class="row">
                    <div class="col l6 offset-l0 hide-on-med-and-down">
                        <h4>Welcome to {{app_info('name.abbr')}}</h4>
                        <p class="font-lg">
                            {{app_info('description.short')}}
                        </p>
                    </div>
                    <div class="col l5 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half">
                        @if($user)
                            <div>
                                <h6>Greetings!</h6>
                                <h5 class="right-align">{{!empty($user->name()) ? $user->name() : 'User'}}</h5>
                                @if($lsCount)
                                    <div class="divider"></div>
                                    <div class="section">
                                        <p class="font-bold">
                                            You are currently being evaluated in the following
                                            @if($lsCount>1) exercises. @else exercise. @endif
                                            Click on the @if($lsCount>1) links @else link @endif to find out how great you are doing!.
                                        </p>
                                        <ul>
                                            @foreach($listed as $exercise)
                                                <li>
                                                    <a href="{{url()->route('app.results.view', ['id'=>$exercise->id])}}"
                                                       class="btn btn-flat bordered full-width full-height orange-text text-darken-1 white-text">
                                                        <span class="left">{{$exercise->title}}</span>
                                                        <i class="material-icons right hide-on-small-and-down">launch</i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($leCount)
                                    @if(!$lsCount)
                                        <div class="divider"></div>
                                    @endif
                                    <p class="font-bold">
                                        You have @if($lsCount) also @endif been invited to take part in the following
                                        @if($leCount>1) exercises @else exercise @endif as one of the evaluators.
                                        Kindly click on the @if($leCount>1) links @else link @endif to contribute your honest opinion.
                                    </p>
                                    <ul>
                                        @foreach($invited as $exercise)
                                            <li>
                                                <a href="{{url()->route('app.live.evaluator', ['id'=>$exercise->id])}}"
                                                   class="btn btn-flat bordered full-width full-height text-darken-3 green-text">
                                                    <span class="left">{{$exercise->title}}</span>
                                                    <i class="material-icons right hide-on-small-and-down">launch</i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="section">
                                    <div class="center-align white-text blue">
                                        <div class="divider"></div>
                                        <p class="font-bold">
                                            Explore all exercises here...
                                        </p>
                                        <p class="padding-btm-1em">
                                            <a href="{{url()->route('app.live.list')}}" class="btn white blue-text z-depth-half"><i
                                                        class="material-icons left">timelapse</i>LIVE</a>
                                            <a href="{{url()->route('app.results.list')}}" class="btn green white-text z-depth-half"><i
                                                        class="material-icons left">timelapse</i>RESULTS</a>
                                        </p>
                                    </div>
                                </div>
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
                                        <a href="{{url()->route('auth.signup')}}" class="btn btn-large blue white-text z-depth-half full-width">
                                            SIGN UP NOW
                                        </a>
                                    </p>
                                </div>
                                <div class="col m6 s12">
                                    <p>
                                        <a href="{{url()->route('auth.login')}}" class="btn btn-large blue white-text z-depth-half full-width">
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
                            <div class="center-align white-text green darken-2">
                                <div class="divider"></div>
                                <p class="font-bold">
                                    Explore exercises here...
                                </p>
                                <p class="padding-btm-1em">
                                    <a href="{{url()->route('app.live.list')}}" class="btn white blue-text z-depth-half"><i
                                                class="material-icons left">timelapse</i>LIVE</a>
                                    <a href="{{url()->route('app.results.list')}}" class="btn blue white-text z-depth-half"><i
                                                class="material-icons left">list</i>RESULTS</a>
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

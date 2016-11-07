<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    3:45 PM
 **/
$user = \Auth::user();
?>
@extends('layouts.public')
@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s12">
                    <h1 class="page-title left"><i class="material-icons left">timelapse</i>{{$title or 'Live Exercises'}}</h1>
                    @if(!$user)
                        <p class="right">
                            <a href="{{url()->route('auth.login')}}" class="btn orange darken-3 white-text z-depth-half full-width">
                                <i class="material-icons right">vpn_key</i>
                                LOGIN IN TO START VOTING
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="tiny-padding z-depth-0 section sh-50vh mh-40vh" id="data-area">
            @forelse($list as $exercise)
                @if($loop->first)
                    <div class="row">
                        @endif
                        <div class="col s12 m6 l4">
                            <div class="card-panel small z-depth-half">
                                <h6 class="card-title truncate green-text" title="{{$exercise->title}}">{{$exercise->title}}</h6>
                                <div class="card-content">
                                    {{$exercise->description}}
                                </div>
                                <p class="card-action">
                                    @if($user)
                                        <a href="{{url()->route('app.live.evaluator', ['id'=>$exercise->id])}}"
                                           class="btn btn-flat green white-text">
                                            <i class="material-icons left">record_voice_over</i> Vote
                                        </a>
                                    @endif
                                    <a href="{{url()->route('app.results.view', ['id'=>$exercise->id])}}" class="btn btn-flat orange lighten-4">
                                        <i class="material-icons left">description</i> View
                                    </a>
                                </p>
                            </div>
                        </div>
                        @if($loop->last)
                    </div>
                @endif
            @empty
                <div class="valign-wrapper sh-50vh white">
                    <div class="valign full-width">
                        <div class="row">
                            <div class="col s12 center-align">
                                <p><i class="material-icons blue-text" style="font-size: 800%">alarm_off</i></p>
                                <h6>NO LIVE POLLS AT THE MOMENT</h6>
                                <p>
                                    <a href="{{url()->route('app.results.list')}}" class="btn btn-large blue">VIEW RESULTS</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    3:55 PM
 **/
?>
@extends('layouts.public')
@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s12">
                    <h1 class="page-title"><i class="material-icons left">list</i>Results</h1>
                </div>
            </div>
        </div>
        <div class="white tiny-padding z-depth-0 section sh-50vh mh-40vh" id="data-area">
            @forelse($list as $exercise)
                @if($loop->first) <div class="row"> @endif
                    <div class="col s12 m6 l4">
                        <div class="card-panel small bordered z-depth-0">
                            <h6 class="card-title truncate" title="{{$exercise->title}}">{{$exercise->title}}</h6>
                            <div class="card-content">
                                {{$exercise->description}}
                            </div>
                            <p class="card-action">
                                <a href="{{url()->route('app.results.view', ['id'=>$exercise->id])}}" class="btn btn-flat grey lighten-3">
                                    <i class="material-icons left">description</i> View
                                </a>
                            </p>
                        </div>
                    </div>
                @if($loop->last) </div> @endif
            @empty
                <div class="valign-wrapper sh-50vh">
                    <div class="valign full-width">
                        <div class="row">
                            <div class="col s12 center-align">
                                <p><i class="material-icons blue-text" style="font-size: 800%">timeline</i></p>
                                <h6>NO EVALUATION EXERCISES HAVE BEEN CONCLUDED AT THE MOMENT</h6>
                                <p>
                                    <a href="{{url()->route('app.live')}}" class="btn btn-large blue">Live Polls</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

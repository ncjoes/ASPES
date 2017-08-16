<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    3:56 PM
 **/

use Illuminate\Database\Eloquent\Collection;

/**
 * @var \App\Models\Exercise $exercise
 */
$exercise = $object['main'];
/**
 * @var Collection $subjects ;
 */
$subjects = $object['relations']['subjects'];
/**
 * @var Collection $courseFactors ;
 */
$courseFactors = $object['relations']['courseFactors'];
/**
 * @var Collection $instructorFactors ;
 */
$instructorFactors = $object['relations']['instructorFactors'];
/**
 * @var Collection $courseComments ;
 */
$courseComments = $object['relations']['courseComments'];
/**
 * @var Collection $instructorComments ;
 */
$instructorComments = $object['relations']['instructorComments'];

$nCFactors = $courseFactors->count();
$nIFactors = $instructorFactors->count();
$nCComments = $courseComments->count();
$nIComments = $instructorComments->count();
?>

@extends('layouts.public')

@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s12">
                    <a href="{{url()->route('app.results.list')}}" class="btn btn-flat left blue-text">
                        <i class="material-icons left tiny">keyboard_arrow_left</i>RESULTS
                    </a>
                    @if(!$exercise->isPublished())
                        <span class="right red-text tiny-padding">
                            <i class="material-icons left tiny">warning</i> Intermediate Result!
                        </span>
                    @else
                        <a class="btn btn-flat right green-text">
                            <i class="material-icons left tiny">done_all</i>PUBLISHED
                        </a>
                    @endif
                </div>
                <div class="col l9 m8 s12 align-s-centre align-m-left">
                    <h1 class="page-title">{{$exercise->title}}</h1>
                </div>
                <div class="col l3 m4 s12 align-s-centre align-m-left">
                    <p>
                        @if(count($subjects) > 1)
                            <button class="btn-flat font-bold">
                                <i class="material-icons left small">people</i> {{count($subjects)}} Subjects
                            </button>
                        @endif
                        <button class="btn-flat font-bold truncate">
                            <i class="material-icons left small">people</i> {{$exercise->evaluators->count()}}
                            Evaluators
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <div class="white tiny-padding z-depth-0 section sh-50vh mh-40vh" id="data-area">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        @foreach($subjects as $subject)
                            <li class="tab col l3 m6 s12">
                                <a href="#subject-{{$subject->id}}"
                                   style="padding: 0 1em;">{{$subject->profile->name()}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach($subjects as $subject)
                    <?php
                    $evalMatrix = $subject->getEvaluationMatrix();
                    ?>
                    <div id="subject-{{$subject->id}}" class="col s12">
                        <div class="row padding-top-1em no-margin">
                            <div class="col m3 s8 offset-s2">
                                <div class="user-photo">
                                    <img src="{{$subject->profile->getPhotoUrl()}}" class="responsive-img">
                                </div>
                                <h6 class="font-bold center-align">{{$subject->profile->name()}}</h6>
                            </div>
                            <div class="col m9 s12">
                                <p class="font-lg">
                                    {{$subject->profile->biography}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <table class="bordered highlight responsive-table">
                                    <thead>
                                    <tr>
                                        <th colspan="{{$nCComments + 1}}"><h5>Course Factors</h5></th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Factor</th>
                                        <th colspan="{{$nCComments}}">Comments</th>
                                    </tr>
                                    <tr>
                                        @foreach($courseComments as $comment)
                                            <th>{{$comment->value}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($courseFactors as $factor)
                                        <tr>
                                            <td>{{$factor->text}}</td>
                                            @foreach($courseComments as $comment)
                                                <td>{{($evalMatrix[$factor->id][$comment->id] * 100)}}%</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <table class="bordered highlight responsive-table">
                                    <thead>
                                    <tr>
                                        <th colspan="{{$nIComments + 1}}"><h5>Instructor Factors</h5></th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Factor</th>
                                        <th colspan="{{$nIComments}}">Comments</th>
                                    </tr>
                                    <tr>
                                        @foreach($instructorComments as $comment)
                                            <th>{{$comment->value}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($instructorFactors as $factor)
                                        <tr>
                                            <td>{{$factor->text}}</td>
                                            @foreach($instructorComments as $comment)
                                                <td>{{($evalMatrix[$factor->id][$comment->id] * 100)}}%</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/3/2016
 * Time:    12:59 PM
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
                    <h1 class="page-title left"><i class="material-icons left">bookmark_border</i>{{$exercise->title}}
                    </h1>
                    <p class="right">
                        <a class="btn orange darken-3 white-text z-depth-half full-width">
                            <i class="material-icons left">schedule</i>
                            <span id="count-down"></span>
                        </a>
                    </p>
                    <div class="divider clearfix"></div>
                </div>
            </div>
            <div class="row" id="tabs">
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
                    <div id="subject-{{$subject->id}}" class="col s12">
                        <form class="evaluation-form" action="{{url()->route('app.live.evaluate.submit')}}"
                              onsubmit="return false;">
                            {{csrf_field()}}
                            <input type="hidden" name="subject-id" value="{{$subject->id}}">
                            <div class="divider"></div>
                            <div class="row padding-top-1em no-margin">
                                <div class="col l3 s12">
                                    <div class="row no-margin">
                                        <div class="col s8 offset-s2 m3 l12">
                                            <div class="user-photo">
                                                <img src="{{$subject->profile->getPhotoUrl()}}" class="responsive-img">
                                            </div>
                                        </div>
                                        <div class="col s12 m9 l12">
                                            <h6 class="font-bold">{{$subject->profile->name()}}</h6>
                                            <div class="divider"></div>
                                            <div class="grey lighten-5">{{$subject->profile->biography}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l9 s12">
                                    <div id="questionnaire-{{$subject->id}}" class="section">
                                        <h5>Course Factors</h5>
                                        @foreach($courseFactors as $factor)
                                            <div class="row">
                                                <div class="col s12">
                                                    <h6 class="font-bold truncate">{{$factor->text}}</h6>
                                                </div>
                                                <div class="col s12 comments">
                                                    <div class="row" data-SID="{{$subject->id}}"
                                                         data-FID="{{$factor->id}}">
                                                        @foreach($courseComments as $comment)
                                                            <div class="col s1">
                                                                <input name="e[{{$factor->id}}]" type="radio"
                                                                       value="{{$comment->id}}"
                                                                       id="e-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}"
                                                                       required/>
                                                                <label for="e-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}"
                                                                       class="font-sm">
                                                                    {{$comment->value}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr/>
                                        <h5>Instructor Factors</h5>
                                        @foreach($instructorFactors as $factor)
                                            <div class="row">
                                                <div class="col s12">
                                                    <h6 class="font-bold truncate">{{$factor->text}}</h6>
                                                </div>
                                                <div class="col s12 comments">
                                                    <div class="row" data-SID="{{$subject->id}}"
                                                         data-FID="{{$factor->id}}">
                                                        @foreach($instructorComments as $comment)
                                                            <div class="col s1">
                                                                <input name="e[{{$factor->id}}]" type="radio"
                                                                       value="{{$comment->id}}"
                                                                       id="e-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}"
                                                                       required/>
                                                                <label for="e-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}"
                                                                       class="font-sm">
                                                                    {{$comment->value}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="divider"></div>
                                <div class="col s12">
                                    <div class="center-align"><strong id="notify"></strong></div>
                                    <p class="center-align">
                                        @if(!$loop->first)
                                            <button class="btn btn-flat outline-all grey lighten-2 white-text nav-btn"
                                                    type="button"
                                                    data-tab="subject-{{$subject->id}}" data-action="previous">
                                                <i class="material-icons">skip_previous</i>
                                            </button>
                                        @endif
                                        <button class="btn blue white-text" type="submit">
                                            <i class="material-icons left">done</i>
                                            SUBMIT @if(!$loop->last) &amp; GO TO NEXT @endif
                                        </button>
                                        @if(!$loop->last)
                                            <button class="btn btn-flat outline-all grey lighten-2 white-text nav-btn"
                                                    type="button"
                                                    data-tab="subject-{{$subject->id}}" data-action="next">
                                                <i class="material-icons">skip_next</i>
                                            </button>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script src="{{ asset('js/app.utils.js') }}"></script>
    <script src="{{asset('js/countdown-timer/jquery.countdownTimer.min.js')}}"></script>
    <script type="text/javascript">
      $(function () {
        //countdown timer
        $("#count-down").countdowntimer({
          dateAndTime: '<?= $exercise->stop_at ?>'
        });

        //form processing
        var evaluationForms = $('.evaluation-form');
        var currentTab;
        evaluationForms.submit(function (e) {
          e.preventDefault();
          var $this = $(e.target);

          $.post($this.prop('action'), $this.serialize(), null, 'json')
            .done(function (response) {
              notify($('#notify', $this), response);
              if (response.status === true) {
                setTimeout(function () {
                  currentTab = $('div#subject-' + $('[name="subject-id"]', $this).val());
                  nextTab(currentTab);
                }, 1500)
              }
            })
            .fail(function (xhr) {
              handleHttpErrors(xhr, $this)
            });
        });

        //----------------------------------------------------------------------//
        $('button.nav-btn', evaluationForms).click(function (e) {
          var button = $(this);
          currentTab = $('div#' + button.attr('data-tab'));
          if (button.attr('data-action') === 'next') {
            nextTab(currentTab);
          }
          else {
            previousTab(currentTab);
          }
        });

        function nextTab(currentTab) {
          if (currentTab.next().length) {
            $('ul.tabs').tabs('select_tab', currentTab.next().attr('id'));
            $.scrollTo('tabs');
          }
        }

        function previousTab(currentTab) {
          if (currentTab.prev().length) {
            $('ul.tabs').tabs('select_tab', currentTab.prev().attr('id'));
            $.scrollTo('tabs');
          }
        }
      });
    </script>
@endsection

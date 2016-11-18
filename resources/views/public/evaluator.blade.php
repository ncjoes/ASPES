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
 * @var \App\Models\User $user
 */
$user = \Auth::user();
/**
 * @var \App\Models\Exercise $exercise
 */
$exercise = $object['main'];
/**
 * @var Collection $subjects ;
 */
$subjects = $object['relations']['subjects'];
/**
 * @var Collection $factors ;
 */
$factors = $object['relations']['factors'];
/**
 * @var Collection $comments ;
 */
$comments = $object['relations']['comments'];

$nFactors = $factors->count();
$nComments = $comments->count();
?>
@extends('layouts.public')
@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s12">
                    <h1 class="page-title left"><i class="material-icons left">bookmark_border</i>{{$exercise->title}}</h1>
                    <p class="right">
                        <a class="btn orange darken-3 white-text z-depth-half full-width">
                            <i class="material-icons left">schedule</i>
                            <span id="count-down"></span>
                        </a>
                    </p>
                    <div class="divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        @foreach($subjects as $subject)
                            <li class="tab col l3 m6 s12">
                                <a href="#subject-{{$subject->id}}" style="padding: 0 1em;">{{$subject->profile->name()}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach($subjects as $subject)
                    <div id="subject-{{$subject->id}}" class="col s12">
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
                                    <form onsubmit="return false;">
                                        @foreach($factors as $factor)
                                            <div class="row">
                                                <div class="col l3 s12">
                                                    <h6 class="font-bold truncate">{{$factor->text}}</h6>
                                                </div>
                                                <div class="col l9 s12 comments">
                                                    <div class="row" data-SID="{{$subject->id}}" data-FID="{{$factor->id}}">
                                                        @foreach($comments as $comment)
                                                            <div class="col s6 m-auto-20">
                                                                <input name="c-[{{$factor->id}}]" type="radio" value="{{$comment->id}}"
                                                                       id="c-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}"/>
                                                                <label for="c-{{$subject->id}}-{{$factor->id}}-{{$comment->id}}" class="font-sm">
                                                                    {{$comment->value}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12">
                    <p class="center-align">
                        <button class="btn blue white-text"><i class="material-icons left">done</i>NEXT</button>
                        <button class="btn green white-text"><i class="material-icons left">done_all</i>SUBMIT</button>
                        <button class="btn grey white-text"><i class="material-icons left">done</i>SKIP</button>
                    </p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row section align-s-centre align-m-left" id="factors-state-container">
                <div class="col s12">
                    <h6 class="font-xl font-bold">Relative Importance of Evaluation Factors</h6>
                </div>
                <div class="col s12 m4 l3">
                    <p>
                        The following chart shows the relative importance (weights) of the evaluation factors.
                        The factor weights are calculated from comparisons made by other evaluators.
                    </p>
                    <p class="font-lg font-bold">Don't quite agree with the current weights?</p>
                    <p class="align-m-right">
                        <button class="btn z-depth-half blue waves-effect waves-light" id="comparator-trigger"
                                href="#comparator">Compare Factors<i class="material-icons right">shuffle</i>
                        </button>
                    </p>
                </div>
                <div class="col s12 m8 l9">
                    <div id="factors-state"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="comparator" class="modal modal-fixed-footer">
        <form onsubmit="return false;">
            <div class="modal-content">
                <div class="blue darken-1 white-text tiny-padding">
                    <h5 class="center-align">Compare Evaluation Factors</h5>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="section">
                            <div class="row">
                                <div class="col s5"><span class="font-bold">Factor 1</span></div>
                                <div class="col s2 center-align"><i class="material-icons">trending_flat</i></div>
                                <div class="col s5 right-align"><span class="font-bold">Factor 2</span></div>
                            </div>
                            <?php
                            $x = 1;
                            /**
                             * @var \App\Models\Factor $f1
                             */
                            ?>
                            @foreach ($factors as $f1)
                                <?php $yFactors = (clone $factors)->splice($x); ?>
                                @foreach ($yFactors as $f2)
                                    <div class="row">
                                        <div class="col m4 s12 align-m-right">
                                            <label for="c-{{$f1->id}}-{{$f2->id}}" class="font-bold black-text">{{$f1->text}}</label>
                                        </div>
                                        <div class="col m4 s12 center-align">
                                            <select name="comparisons[{{$f1->id}}][{{$f2->id}}]" id="c-{{$f1->id}}-{{$f2->id}}"
                                                    class="browser-default no-margin no-padding" required="required">
                                                <option></option>
                                                @foreach($comments as $comment)
                                                    <option value="{{$comment->id}}">{{$comment->value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col m4 s12 align-s-right align-m-left">
                                            <label for="c-{{$f1->id}}-{{$f2->id}}" class="font-bold black-text">{{$f2->text}}</label>
                                        </div>
                                    </div>
                                    <div class="divider hide-on-med-and-up"></div>
                                @endforeach
                                <?php $x++;?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer right-align">
                <button class="btn z-depth-half blue waves-effect waves-light" id="comparator-trigger"
                >SUBMIT<i class="material-icons right">send</i>
                </button>
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
            </div>
        </form>
    </div>
@endsection
@section('extra_scripts')
    <?php
    $payload = [];
    $factorWeights = $exercise->getFactorWeights();
    foreach ($factors as $factor) {
        $factorID = $factor->id;
        array_push($payload, [
                'label' => $factor->text,
                'value' => $factorWeights[ $factorID ]
        ]);
    }
    ?>
    <script src="{{ asset('js/app.utils.js') }}"></script>
    <script src="{{ asset('js/charts.utils.js') }}"></script>
    <script src="{{ asset('js/fusioncharts/fusioncharts.js') }}"></script>
    <script src="{{ asset('js/fusioncharts/fusioncharts.charts.js') }}"></script>
    <script src="{{asset('js/countdown-timer/jquery.countdownTimer.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            var payLoad = <?= json_encode($payload); ?>;
            var barChart = {
                "paletteColors": "#2196F3",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "showCanvasBorder": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placeValuesInside": "1",
                "valueFontColor": "#ffffff",
                "showAxisLines": "1",
                "axisLineAlpha": "25",
                "divLineAlpha": "10",
                "alignCaptionWithCanvas": "0",
                "showAlternateVGridColor": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "12",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5"
            };

            FusionCharts.ready(function () {
                var container = $('#factors-state');
                var chart = new FusionCharts({
                    type: 'bar2d',
                    renderAt: container.attr('id'),
                    width: container.width(),
                    height: (getLineHeight() * payLoad.length),
                    dataFormat: 'json',
                    dataSource: {
                        "chart": $.extend(barChart, {
                                    caption: 'Current Factor Weights',
                                    yAxisName: 'Weights',
                                    xAxisName: 'Factors'
                                }
                        ),
                        "data": payLoad
                    }
                });
                render(chart);

                $(window).on('resize orientationchange', function () {
                    updateCharts('factors-state-container')
                });
            });

            //Attach listeners
            $("#count-down").countdowntimer({
                dateAndTime: '<?= $exercise->stop_at ?>'
            });

            $('#comparator-trigger').on('click', function () {
                $('#comparator').openModal({
                            dismissible: true, // Modal can be dismissed by clicking outside of the modal
                            opacity: .5, // Opacity of modal background
                            in_duration: 300, // Transition in duration
                            out_duration: 200, // Transition out duration
                            starting_top: '4%', // Starting top style attribute
                            ending_top: '3%', // Ending top style attribute
                            ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
                                //alert("Ready");
                                console.log(modal, trigger);
                            }
                        }
                );
            });
        });
    </script>
@endsection

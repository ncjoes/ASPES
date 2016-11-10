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
                            <i class="material-icons left small">people</i> {{$exercise->evaluators->count()}} Evaluators
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
                                <a href="#subject-{{$subject->id}}" style="padding: 0 1em;">{{$subject->profile->name()}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach($subjects as $subject)
                    <div id="subject-{{$subject->id}}" class="col s12">
                        <div class="row padding-top-1em no-margin">
                            <div class="col m3 s8 offset-s2">
                                <div class="user-photo">
                                    <img src="{{$subject->profile->getPhotoUrl()}}" class="responsive-img">
                                </div>
                                <h6 class="font-bold center-align">{{$subject->profile->name()}}</h6>
                            </div>
                            <div class="col m9 s12">
                                <div id="result-main-{{$subject->id}}">
                                    <div class="align-s-centre">
                                        <div class="preloader-wrapper big active">
                                            <div class="spinner-layer spinner-blue-only">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="gap-patch">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="factors-real-{{$subject->id}}">
                            <div class="col s12">
                                <ul data-collapsible="accordion" class="bordered collapsible z-depth-half">
                                    <li class="blue lighten-5" id="fc-container-{{$subject->id}}">
                                        <div class="collapsible-header fc-toggle" id="fc-toggle-{{$subject->id}}">
                                            <i class="material-icons">pie_chart</i>Results per Factor
                                            <i class="material-icons right">arrow_drop_down</i>
                                        </div>
                                        <div class="collapsible-body tiny-padding">
                                            @if(!$exercise->isPublished())
                                                <div class="row">
                                                    <div class="col s12 white font-lg center-align red-text tiny-padding">
                                                        <span><i class="material-icons tiny">warning</i>Intermediate Result!</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row" id="factors-tmp-{{$subject->id}}">
                                                <br/>
                                                @foreach($factors as $factor)
                                                    <div class="col s12 l6">
                                                        <div id="result-factor-{{$subject->id}}-{{$factor->id}}">
                                                        </div>
                                                        <br/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('extra_scripts')
    <?php
    $results = $exercise->getResults();
    $payload = [];
    foreach ($subjects as $subject) {
        $subjectId = $subject->id;
        $mainChart = [];
        foreach ($comments as $comment) {
            $commentId = $comment->id;
            array_push($mainChart, ['label' => ($comment->value.' (Grade: '.$comment->grade.')'), 'value' => ($results[ $subjectId ][ $commentId ])]);
        }

        $factorCharts = [];
        $matrix = $subject->evaluation_matrix;
        foreach ($factors as $factor) {
            $factorID = $factor->id;
            $data = [];
            foreach ($comments as $comment) {
                $commentId = $comment->id;
                array_push($data, [
                        'label' => $comment->value.' (Grade: '.$comment->grade.')',
                        'value' => $matrix[ $factorID ][ $commentId ]
                ]);
            }

            $factorRatingChart['title'] = $factor->text.' (Weight: '.$factor->weight.')';
            $factorRatingChart['data'] = $data;
            $factorCharts[ $factorID ] = $factorRatingChart;
        }

        $payload[ $subjectId ] = ['main' => $mainChart, 'factors' => $factorCharts];
    }
    ?>
    <script src="{{ asset('js/app.utils.js') }}"></script>
    <script src="{{ asset('js/charts.utils.js') }}"></script>
    <script src="{{ asset('js/fusioncharts/fusioncharts.js') }}"></script>
    <script src="{{ asset('js/fusioncharts/fusioncharts.charts.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var payLoad = <?= json_encode($payload); ?>;
            var collapsibleStates = {};
            var tabStates = {};
            var barChart = {
                "paletteColors": "#2196F3",
                "bgColor": "#ffffff",
                "showBorder": "1",
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
            var doughnutChartOptions = {
                "showBorder": "1",
                "use3DLighting": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "1",
                "showPercentValues": "1",
                "showLegend": "0",
                "centerLabelBold": "0",
                "showTooltip": "0",
                "decimals": "1",
                "bgColor": "#ffffff",
                "useDataPlotColorForLabels": "1"
            };
            var currentFactor;
            var factorsData;
            FusionCharts.ready(function () {
                for (var subjectId in payLoad) {
                    var container = $('#result-main-' + subjectId);
                    factorsData = payLoad[subjectId]['factors'];

                    var chartData = payLoad[subjectId]['main'];
                    var chart = new FusionCharts({
                        type: 'bar2d',
                        renderAt: container.attr('id'),
                        width: container.width(),
                        height: (getLineHeight() * chartData.length),
                        dataFormat: 'json',
                        dataSource: {
                            "chart": $.extend(barChart, {
                                        caption: 'Summary (for all factors)',
                                        yAxisName: 'Probability',
                                        xAxisName: 'Comments'
                                    }
                            ),
                            "data": chartData
                        }
                    });
                    render(chart);

                    for (var factorId in factorsData) {
                        currentFactor = factorsData[factorId];
                        container = $('#result-factor-' + subjectId + '-' + factorId);

                        chartData = currentFactor['data'];
                        chart = new FusionCharts({
                            type: 'pie2d',
                            renderAt: container.attr('id'),
                            width: container.width(),
                            height: (getLineHeight() * chartData.length),
                            dataFormat: 'json',
                            dataSource: {
                                "chart": $.extend(doughnutChartOptions, {
                                            caption: currentFactor['title']
                                        }
                                ),
                                "data": currentFactor['data']
                            }
                        });
                        render(chart);
                    }
                    collapsibleStates['fc-toggle-' + subjectId] = false;
                    tabStates['subject-' + subjectId] = false;
                }

                $(window).on('resize orientationchange', function () {
                    updateCharts('data-area')
                });

                $('li.tab').on('click', 'a', function (e) {
                    var target = $(e.target).attr('href').replace('#', '');
                    if (tabStates[target] === false) {
                        for (var id in tabStates) {
                            tabStates[id] = false;
                        }
                        tabStates[target] = true;
                        setTimeout(function () {
                            updateCharts(target);
                        }, 5);
                    }
                });

                $('.fc-toggle').on('click', function (e) {
                    var target = $(e.target).attr('id');
                    if (collapsibleStates[target] === false) {
                        collapsibleStates[target] = true;
                        setTimeout(function () {
                            updateCharts(target.replace('toggle', 'container'));
                            $.scrollTo(target);
                        }, 10);
                    }
                    else {
                        $.scrollTo('top');
                        collapsibleStates[target] = false;
                    }
                });
            });
        });
    </script>
@endsection

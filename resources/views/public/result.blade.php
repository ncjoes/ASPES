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
                    <h6 class="page-title"><i class="material-icons left tiny">list</i>Results</h6>
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
                            <li class="tab col l3 m6 12">
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
                                        <div class="collapsible-header fc-toggle" id="fc-toggle-{{$subject->id}}"><i
                                                    class="material-icons">pie_chart</i>Results per Factor
                                        </div>
                                        <div class="collapsible-body tiny-padding">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
<?php
$results = $exercise->getResult();
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
@section('extra_scripts')
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
                    $('#factors-tmp-' + subjectId).removeAttr('id').appendTo($('#factors-real-' + subjectId + ' .collapsible-body'))
                    collapsibleStates['fc-toggle-' + subjectId] = false;
                    tabStates['subject-' + subjectId] = false;
                }

                $(window).on('resize orientationchange', function () {
                    updateCharts('data-area')
                });

                $('li.tab a').on('click', function (e) {
                    var target = $(e.target).attr('href').replace('#','');
                    console.log('Clicked...' + target);
                    if (tabStates[target] === false) {
                        tabStates[target] = true;
                        console.log('Setting timeout for...' + target);
                        setTimeout(function () {
                            console.log('Executing timeout for...' + target);
                            updateCharts(target);
                        }, 10);
                    }
                    else {
                        collapsibleStates[target] = false;
                    }
                });

                $('.fc-toggle').on('click', function (e) {
                    var target = $(e.target).attr('id');
                    console.log('Clicked...' + target);
                    if (collapsibleStates[target] === false) {
                        collapsibleStates[target] = true;
                        console.log('Setting timeout for...' + target);
                        setTimeout(function () {
                            console.log('Executing timeout for...' + target);
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

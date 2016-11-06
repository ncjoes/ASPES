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
                        <button class="btn-flat font-bold">
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
                                <a href="#subject-{{$subject->id}}">{{$subject->profile->name()}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach($subjects as $subject)
                    <div id="subject-{{$subject->id}}" class="col s12">
                        <div class="row section">
                            <div class="col m3 s8 offset-s2">
                                <div class="user-photo">
                                    <img src="{{$subject->profile->getPhotoUrl()}}" class="responsive-img">
                                </div>
                                <h6 class="font-bold center-align">{{$subject->profile->name()}}</h6>
                            </div>
                            <div class="col m9 s12">
                                <div id="result-main-{{$subject->id}}" style="min-height: {{$nFactors * 2.8}}em;">
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
                                    <li class="blue lighten-5">
                                        <div class="collapsible-header fc-toggle" id="fc-toggle-{{$subject->id}}"><i class="material-icons">pie_chart</i>Results per Factor</div>
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
                                    <div id="result-factor-{{$factor->id}}" style="min-height: {{$nComments * 2.8}}em;">
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
    <script src="{{ asset('js/fusioncharts/fusioncharts.js') }}"></script>
    <script src="{{ asset('js/fusioncharts/fusioncharts.charts.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var payLoad = <?= json_encode($payload); ?>;

            var collapsibleOpen = false;

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
                    chart.render();

                    for (var factorId in factorsData) {
                        currentFactor = factorsData[factorId];
                        container = $('#result-factor-' + factorId);

                        chartData = currentFactor['data'];
                        chart = new FusionCharts({
                            type: 'doughnut2d',
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
                        chart.render();
                    }
                    $('#factors-tmp-'+subjectId).removeAttr('id').appendTo($('#factors-real-'+subjectId+' .collapsible-body'))
                }

                $(window).on('resize orientationchange', function () {
                    resizeCharts()
                });

                $('.fc-toggle').on('click', function (e) {
                    if (collapsibleOpen === false) {
                        collapsibleOpen = true;
                        setTimeout(function () {
                            resizeCharts();
                            $.scrollTo($(e.target).attr('id'));
                        }, 5);
                    }
                    else {
                        $.scrollTo('top');
                        collapsibleOpen = false;
                    }
                });
            });

            function resizeCharts() {
                var chart;
                var LH = getLineHeight();

                var i = 0;
                for (var chartId in FusionCharts.items) {
                    chart = FusionCharts.items[chartId];
                    resizeChart(chart, LH);
                    i++;
                }
            }

            var W, H;

            function resizeChart(Chart) {
                H = getOptimumHeight(Chart);
                W = $('#' + Chart.args.renderAt).width();
                if(W && H){
                    Chart.resizeTo(W, H);
                }
            }

            function getLineHeight() {
                var lineHeight = $(window).height() / 15;
                lineHeight = (lineHeight > 50 || lineHeight < 45) ? 50 : lineHeight;

                return lineHeight;
            }

            function getOptimumHeight(Chart) {
                return (Chart.options.dataSource.data.length * getLineHeight());
            }
        });
    </script>
@endsection

/**
 * Project: aspes.msc
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    11/6/2016
 * Time:    10:26 PM
 **/


function updateCharts(parentContainer) {
  var chart;

  for (var chartId in FusionCharts.items) {
    chart = FusionCharts.items[chartId];
    if ($.contains(document.getElementById(parentContainer), document.getElementById(container(chart).attr('id')))) {
      if (chart.hasRendered()) {
        resizeChart(chart);
      }
      else {
        console.log(chartId);
        render(chart);
      }
    }
  }
}

function resizeChart(Chart) {
  var CTN = container(Chart);
  if (CTN.is(':visible')) {
    var W, H;
    H = getOptimumHeight(Chart);
    W = getOptimumWidth(Chart);
    if(Math.abs(W-Chart.width)>10 || Math.abs(H-Chart.height)>10)
      console.log('Resizing...' + Chart.id);
    Chart.resizeTo(W, H);
  }
}

function render(Chart) {
  var CTN = container(Chart);
  if (CTN.is(':visible')) {
    Chart.height = getOptimumHeight(Chart);
    Chart.width = getOptimumWidth(Chart);
    console.log('Rendering...' + Chart.id);
    Chart.render();
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

function getOptimumWidth(Chart) {
  return container(Chart).width();
}

function container(Chart) {
  return $('#' + Chart.options.containerElementId);
}

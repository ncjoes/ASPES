/**
 * Project: aspes.msc
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    11/3/2016
 * Time:    9:38 AM
 **/

function ExercisePreviewer(object) {
  var $this = this;
  $this.isBuilt = false;
  $this.container = window.AppView.previewBox;

  $this.build = function () {
    var main = object.main;
    $this.markup = $(
      '<div id="x-' + object.id + '">'
      + '<div>'
      + '<h5 class="preview-title">' + main.title + ' <i class="material-icons tiny left">subject</i></h5>'
      + '<p>' + main.description + '</p>'
      + '</div>'
      + '<div>'
      + '<p class="left">From: <span class="font-bold">' + main.start_at + '</span></p>'
      + '<p class="right">To: <span class="font-bold">' + main.stop_at + '</span></p>'
      + '</div>'
      + '<div class="clearfix" id="factors">'
      + '</div>'
      + '<div class="clearfix" id="extras">'
      + '</div>'
      + '<div class="clearfix">'
      + '<p class="center-align">'
      + '<button class="btn z-depth-half blue"><i class="material-icons right">edit</i> EDIT EXERCISE</button>'
      + '<button class="btn z-depth-half grey white-text"><i class="material-icons">delete</i></button>'
      + '</p>'
      + '</div>' +
      '</div>');

    var factors = object.relations.factors;
    var factorsSection = $(
      '<div class="section lighten-4 light-blue tiny-padding">'
      + '<h6 class="font-bold">Evaluation Factors</h6>'
      + '<table class="bordered shrink responsive-table">'
      + '<thead>'
      + '<tr>'
      + '<th width="4%">SN</th>'
      + '<th>Factor</th>'
      + '<th>Weight</th>'
      + '</tr>'
      + '</thead>'
      + '<tbody>'
      + '<tr id="tmp"><td colspan="3" class="center-align">-Not Set-</td></tr>'
      + '</tbody>'
      + '</table>'
      + '<p class="clearfix"></p>' +
      '</div>');
    if (factors.length) {
      buildFactorsTable(factors, factorsSection.find('tbody'));
      factorsSection.find('#tmp').remove();
    }
    $this.markup.find('#factors').append(factorsSection);

    var evaluators = object.relations.evaluators;
    var subjects = object.relations.subjects;
    var extrasSection = $(
      '<div class="white-text tiny-padding">'
      + '<p class="left center-align">'
      + '<strong class="font-lg"><i class="material-icons tiny left">people</i>Evaluators</strong>'
      + '<br/><span class="font-bold font-xl"> ' + evaluators.length + '</span>'
      + '</p>'
      + '<p class="right center-align">'
      + '<strong class="font-lg"><i class="material-icons tiny right">person</i>Subjects</strong>'
      + '<br/><span class="font-bold font-xl"> ' + subjects.length + '</span>'
      + '</p>' +
      '</div>'
    );
    $this.markup.find('#extras').append(extrasSection);

    $this.container.append($this.markup);
    $this.jSelector = $('#x-' + object.id, $this.container);
    $this.isBuilt = true;
  };

  $this = $.extend(true, AbstractPreviewer, $this);
  return $this;
}

function buildExercisesTable(listArr, listBox, sortDesc) {
  if (sortDesc === true) {
    listArr = listArr.sort(function (a, b) {
      return b.id - a.id
    })
  }
  var sn = 1;
  for (var x = 0; x < listArr.length; x++) {
    var exercise = listArr[x];
    $(
      '<tr data-index="' + x + '">'
      + '<td class="data-col-sn">' + sn + '</td>'
      + '<td class="data-col-title"><span class="truncate">' + exercise.title + '</span></td>'
      + '<td class="data-col-start"><span class="truncate">' + exercise.start_at + '</span></td>'
      + '<td class="data-col-stop"><span class="truncate">' + exercise.stop_at + '</span></td>' +
      '</tr>'
    ).appendTo(listBox);
    sn++
  }
  listBox.find('#tmp').remove();
}

function buildFactorsTable(listArr, listBox, sortDesc) {
  if(typeof sortDesc !== 'undefined'){
    var z = sortDesc === true ? 1 : -1;
    listArr = listArr.sort(function (a, b) {
      return parseFloat(b.weight) - (z * parseFloat(a.weight))
    });
  }
  var sn = 1;
  for (var x = 0; x < listArr.length; x++) {
    var factor = listArr[x];
    $(
      '<tr data-index="' + x + '">'
      + '<td class="data-col-sn">' + sn + '</td>'
      + '<td class="data-col-text"><span class="truncate">' + factor.text + '</span></td>'
      + '<td nowrap="nowrap" class="data-col-weight font-bold">' + parseFloat(factor.weight) + '</td>' +
      '</tr>'
    ).appendTo(listBox);
    sn++
  }
}

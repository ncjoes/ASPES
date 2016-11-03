/**
 * Project: aspes.msc
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    11/3/2016
 * Time:    9:38 AM
 **/

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
  var x = sortDesc === true ? -1 : 1;
  listArr = listArr.sort(function (a, b) {
    return $.arrayAvg(b.weight) - (x * $.arrayAvg(a.weight))
  });
  var sn = 1;
  for (var x = 0; x < listArr.length; x++) {
    var factor = listArr[x];
    $(
      '<tr data-index="' + x + '">'
      + '<td class="data-col-sn">' + sn + '</td>'
      + '<td class="data-col-text"><span class="truncate">' + factor.text + '</span></td>'
      + '<td nowrap="nowrap" class="data-col-weight">' + factor.weight.toString() + '</td>' +
      '</tr>'
    ).appendTo(listBox);
    sn++
  }
}

function previewDataRow(row, Storage, Previewer) {
  var object = Storage.listed[parseInt($(row).attr('data-index'))];
  if (object.id in Storage.loaded) {
    previewDataObject(Storage.loaded[object.id], Storage, Previewer);
  }
  else {
    fetchObjectInfo(object.id, Storage.infoUrl).done(function (response) {
      if (response.status === true && 'object' in response) {
        previewDataObject(response.object, Storage, Previewer);
      }
    }).fail(function (xhr) {

    })
  }
}

function previewDataObject(object, Storage, Previewer) {
  var previewer = new Previewer(object);
  if (object.id in Storage.loaded === false) {
    Storage.loaded[object.id] = object
  }
  previewer.show();
}

function fetchObjectInfo(id, url) {
  return $.getJSON(url, {id: id});
}

var AbstractPreviewer = {
  Container: function () {
    return this.container;
  },
  JSelector: function () {
    if (!this.isBuilt) {
      this.build();
    }
    return this.jSelector;
  },
  show: function () {
    if (!this.isBuilt) {
      this.build();
    }
    this.Container().children().hide();
    this.JSelector().show();
  },
  hide: function () {
    if (!this.isBuilt) {
      this.build();
    }
    this.JSelector().hide();
  }
};

function ExercisePreviewer(object) {
  var $this = this;
  $this.isBuilt = false;
  $this.container = window.AppView.previewBox;

  $this.build = function () {
    var main = object.main;
    var factors = object.relations.factors;
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
      + '<div id="factors" class="clearfix">'
      + '</div>'
      + '<p class="center-align">'
      + '<button class="btn z-depth-half"><i class="material-icons right">edit</i> EDIT EXERCISE</button>'
      + '<button class="btn z-depth-half grey white-text"><i class="material-icons">delete</i></button>'
      + '</p>' +
      '</div>');

    if (factors.length) {
      var section = $(
            '<div class="section lighten-5 light-blue tiny-padding">'
            + '<h6 class="font-bold">Evaluation Factors</h6>'
            + '<table class="bordered shrink">'
            + '<thead>'
            + '<tr>'
            + '<th>SN</th>'
            + '<th>Factor</th>'
            + '<th>Weight</th>'
            + '</tr>'
            + '</thead>'
            + '<tbody>'
            + '</tbody>'
            + '</table>'
            + '</div>');

      buildFactorsTable(factors, section.find('tbody'));
      $this.markup.find('#factors').append(section);
    }

    $this.container.append($this.markup);
    $this.jSelector = $('#x-' + object.id, $this.container);
    $this.isBuilt = true;
  };

  $this = $.extend(true, AbstractPreviewer, $this);
  return $this;
}

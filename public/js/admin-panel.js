/**
 * Project: aspes.msc
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    11/3/2016
 * Time:    9:38 AM
 **/

function buildDataTable(listArr, listBox) {
  var sn = 1;
  for (var x = 0; x < listArr.length; x++) {
    var exercise = listArr[x];
    $(
      '<tr data-index="' + x + '">'
      + '<td class="data-col-sn">' + sn + '</td>'
      + '<td class="data-col-title">' + exercise.title + '</td>'
      + '<td class="data-col-start">' + exercise.start_at + '</td>'
      + '<td class="data-col-stop">' + exercise.stop_at + '</td>' +
      '</tr>'
    ).appendTo(listBox);
    sn++
  }
  listBox.find('#tmp').remove();
}

function previewDataRow(row, Storage, Previewer) {
  var object = Storage.listed[parseInt($(row).attr('data-index'))];
  if (object.id in Storage.loaded) {
    //ToDo
    //Previewer.container.find()
    console.log('already loaded')
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
  if(object.id in Storage.loaded === false) {
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
    this.Container().children().find(':visible').hide();
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
  $this.data = object;
  $this.isBuilt = false;
  $this.container = window.AppView.previewBox;

  $this.build = function () {
    $this.markup = '<div id="x-' + $this.data.id + '">' + $this.data.title + '</div>';
    $this.container.append($this.markup);
    $this.jSelector = $('#x-' + $this.data.id, $this.container);
    $this.isBuilt = true;
  };

  $this = $.extend(true, AbstractPreviewer, $this);
  return $this;
}


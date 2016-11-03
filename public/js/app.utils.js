/**
 * jQuery Extensions
 */
(function ($) {
  var GEXT = {
    clearForm: function () {
      return this.each(function () {
        var type = this.type
        var tag = this.tagName.toLowerCase()
        if (tag === 'form') {
          return $(':input', this)
            .clearForm()
        }
        if (type === 'text' || type === 'password' || tag === 'textarea') {
          this.value = ''
        } else if (type === 'checkbox' || type === 'radio') {
          this.checked = false
        } else if (tag === 'select') {
          this.selectedIndex = -1
        }
      })
    },
    getPath: function () {
      var paths = []

      this.each(function (index, element) {
        var path
        var $node = $(element)

        while ($node.length) {
          var realNode = $node.get(0)
          var name = realNode.localName
          if (!name) {
            break
          }

          name = name.toLowerCase()
          var parent = $node.parent()
          var sameTagSiblings = parent.children(name)

          if (sameTagSiblings.length > 1) {
            var allSiblings = parent.children()
            var i = allSiblings.index(realNode) +
              1
            if (i > 0) {
              name += ':nth-child(' + i + ')'
            }
          }

          path = name + (path ? ' > ' + path : '')
          $node = parent
        }

        paths.push(path)
      })

      return paths.join(',')
    },
    scrollSpyX: function (a, b, c) {
      var jQuery = $
      var f
      var s = $(this)
      if (arguments.length === 0) {
        s.scrollSpy()
      }
      if (arguments.length === 1 && (typeof a === 'string' || a instanceof jQuery)) {
        s = a = typeof a === 'string' ? $(a) : a
        $.scrollSpy(a)
      } else if (arguments.length === 1 && typeof a === 'function') {
        f = a
        s.scrollSpy()
      } else if (arguments.length === 2 && (typeof a === 'string' || a instanceof jQuery) && typeof b === 'object') {
        s = a = typeof a === 'string' ? $(a) : a
        $.scrollSpy(a, b)
      } else if (arguments.length === 2 && (typeof a === 'string' || a instanceof jQuery) && typeof b === 'function') {
        f = b
        s = a = typeof a === 'string' ? $(a) : a
        $.scrollSpy(a)
      } else if (arguments.length === 2 && typeof a === 'object' && typeof b === 'function') {
        f = b
        s.scrollSpy(a)
      } else if (arguments.length === 3 && (typeof a === 'string' || a instanceof jQuery) && typeof b === 'object' && typeof c === 'function') {
        f = c
        s = a = typeof a === 'string' ? $(a) : a
        $.scrollSpy(a, b)
      } else {
        console.error('Invalid argument set')
      }

      window.ScrollSpyX = {}
      var visible = []
      if (typeof f !== 'undefined') {
        s.on('scrollSpy:enter', function () {
          visible = $.grep(visible, function (value) {
            return value.is(':visible')
          })
          visible = visible.sort(function (a, b) {
            return b.offset().top - a.offset().top
          })

          var $this = $(this)
          if (visible[0]) {
            if ($this.data('scrollSpy:id') < visible[0].data('scrollSpy:id')) {
              visible.unshift($(this))
            } else {
              visible.push($(this))
            }
          } else {
            visible.push($(this))
          }

          window.ScrollSpyX.visible = visible
          f(visible[0], 'enter')
        })
        s.on('scrollSpy:exit', function () {
          visible = $.grep(visible, function (value) {
            return value.is(':visible')
          })
          visible = visible.sort(function (a, b) {
            return b.offset().top - a.offset().top
          })

          if (visible[0]) {
            var $this = $(this)
            visible = $.grep(visible, function (value) {
              return value.attr('id') !== $this.attr('id')
            })
            visible = visible.sort(function (a, b) {
              return b.offset().top - a.offset().top
            })
            if (visible[0]) { // Check if empty
              f(visible[0], 'exit')
            }
          }
        })
      }
    }
  }

  var BEXT = {
    isNumber: function (n) {
      return !isNaN(n)
    },
    isInt: function (n) {
      return $.isNumber(n) && n % 1 === 0
    },
    isFloat: function (n) {
      return $.isNumber(n) && n % 1 !== 0
    },
    isOdd: function (n) {
      return n % 2 !== 0
    },
    isEven: function (n) {
      return n % 2 === 0
    },
    isInArray: function (value, array) {
      if(typeof value === 'object') {
        var found = $.grep(array, function (object) {
          return $.data(value) === $.data(object)
        });
        return found.length > 0;
      }
      return ($.inArray(value, array) > -1)
    },
    isJsonString: function (str) {
      try {
        $.parseJSON(str)
      } catch (e) {
        return false
      }
      return true
    },
    parseJSON: function (str) {
      var $object
      try {
        $object = $.parseJSON(str)
      } catch (e) {
        return false
      }
      return $object
    },
    jsonDecode: function (jsonObject) {
      return jsonDecode(jsonObject);
    },
    isInPageAnchor: function (baseUrl, link) {
      return (new RegExp(baseUrl)).test(link) && (new RegExp('#')).test(link)
    },
    getAnchor: function (link) {
      var urlParts = link.toString().split('#')

      return urlParts[1]
    },
    getUrlBase: function (link) {
      link = link.split('?')[0]
      var a = link.split('/')
      a = a.splice(0, a.length - 1)
      return a.join('/')
    },
    scrollTo: function (name, semaphore, duration) {
      var $this = this
      $this.scroll = function (animateOptions) {
        if (target.length) {
          var defaults = {
            duration: duration,
            queue: true,
            easing: 'easeOutCubic'
          }
          if (typeof animateOptions === 'object') {
            defaults = $.extend({}, defaults, animateOptions)
          }

          $('html, body').animate({
            scrollTop: target.offset().top
          }, defaults)
        }
      }

      var target = $('#' + name)
      target = target.length ? target : $('[name=' + name + ']')
      duration = typeof duration === 'undefined' ? 400 : duration
      if (semaphore instanceof Semaphore) {
        semaphore.lock('func.scrollTo')
        $this.scroll({
          complete: function () {
            window.location.href = '#' + name
            semaphore.unlock('func.scrollTo')
          }
        })
      } else {
        $this.scroll()
      }
    }
    ,
    range: function (min, max) {
      if (arguments.length === 1) {
        max = min
        min = 0
      }

      var a = []
      for (var i = min; i < max + 1; i++) {
        a.push(i)
      }
      return a
    }
    ,
    getKeys: function (obj) {
      var keys = []
      for (var key in obj) {
        keys.push(key)
      }
      return keys
    }
    ,
    uniqueArray: function (a) {
      var seen = {}
      var out = []
      var len = a.length
      var j = 0
      for (var i = 0; i < len; i++) {
        var item = a[i]
        if (seen[item] !== 1) {
          seen[item] = 1
          out[j++] = item
        }
      }
      return out
    }
  }

  var FNEXT = {
    instantSearch: function (callable, scope) {
      window.is_timer = undefined
      if ($(this).is('input')) {
        //  No browser autocomplete, we have it covered
        $(this).attr('autocomplete', 'off')

        //  Check key pressed
        $(this).on('keyup', function (e) {
          if (e.keyCode === 13 || e.keyCode === 27) {
            //  Enter or esc key pressed
            var select = $('div#is-poplist')
            if (select.length) {
              select.hide()
            }
            return
          } else {
            if (!isNaN(window.is_timer)) {
              clearTimeout(window.is_timer)
            }
            var input = $(this).val()
            if (input !== '') {
              //  Save input element scope
              var element = this
              window.is_timer = setTimeout(function () {
                var url = window.HomeUrl + '/instant-search'

                $.getJSON(url, {
                  'terms': input,
                  'scope': scope
                }, function (data) {
                  var select = $('div#is-poplist')
                  if (!select.length) {
                    //  Create popup if not exist
                    select = $('body').append('<div id="is-poplist"></div>').find('div#is-poplist')
                  }
                  //  Position popup
                  var window_width = $(window).width()
                  var pop_width = $(select).width()
                  if (window_width > pop_width) {
                    var left = $(element).offset().left
                    var area = left + pop_width
                    if (area < window_width) {
                      select.css('left', left)
                    } else {
                      select.css('left', area - window_width)
                    }
                  }
                  var top = $(element).offset().top + $(element).height()
                  select.css('top', top)

                  //  Populate
                  var items = ''
                  for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                      items += '<span class="pop-item" val="' + key + '">'
                      items += data[key]
                      items += '</span>'
                    }
                  }
                  select.html(items)
                  $(select.children()).on('click', function () {
                    if (typeof callable === 'function') {
                      callable($(this).attr('val'), $(this).text())
                    }
                    select.hide()
                  })

                  $('body').on('click', function () {
                    select.hide()
                  })

                  select.show()
                })
              }, 500)
            } else {
              $('div#is-poplist').hide()
            }
          }
        })
      }
    }
  }

  $.extend(BEXT)
  $.extend(GEXT)
  $.fn.extend(GEXT)
  $.fn.extend(FNEXT)
}(jQuery))

function notify(pane, response, style) {
  var handle = pane.prop('data-timer')
  if ($.isInt(handle)) {
    clearTimeout(handle)
  }

  if ('message' in response) {
    pane.html('message' in response ? response.message : toString(response))
    pane.attr('class', 'mode' in response ? response.mode + '-text' : (
      response.status === true ? 'green-text' : 'red-text'))
  } else {
    pane.html(toString(response))
    pane.attr('class', typeof style === 'undefined' ? 'orange-text' : style)
  }
  pane.show()
  pane.prop('data-timer', setTimeout(function () {
    pane.hide()
  }, 15000))
}

function Semaphore() {
  var $this = this
  $this.locked = false
  $this.lockKey = undefined

  $this.lock = function (key) {
    if (typeof $this.lockKey === 'undefined' && !$this.locked) {
      $this.locked = true
      $this.lockKey = key
    }
  }

  $this.unlock = function (key) {
    if ($this.lockKey === key) {
      $this.locked = false
      $this.lockKey = undefined
    }
  }
}

function handleHttpErrors(xhr, form) {
  var response = xhr.responseJSON;
  switch (xhr.status) {
    case 422 : {
      handle402Error(form, response)
    }
      break;
    case 500 : {
      notify($('#notify', form), {'status': false, 'message': 'Internal Server Error. Please try again shortly.'})
    }
      break;
  }
}

function handle402Error(form, response) {
  var field_names = [];
  form.find(':input').each(function (i, o) {
    var name = $(o).attr('name');
    if (typeof name !== 'undefined') field_names.push(name)
  })
  var textArr = [];
  for (var field in response) {
    if (field in response) {
      textArr.push($(response).prop(field).join("<br/>"));
    }
  }
  var notification = {
    'message': textArr.join('<br/>'),
    'status': false
  }
  notify($('#notify', form), notification);
}

function jsonDecode(jsonObject) {
  return $.map(jsonObject, function (el) {
    return el
  })
}

/**
 * Project: academy.zeesaa.com
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    10/10/2016
 * Time:    4:15 PM
 **/
/**
 * jQuery Extensions
 */

$.fn.extend({
    isNumber: function (n) {
        return Number(n) === n;
    },
    isInt: function (n) {
        return $.fn.isNumber(n) && n % 1 === 0;
    },
    isFloat: function (n) {
        return $.fn.isNumber(n) && n % 1 !== 0;
    },
    isInArray: function (value, array) {
        return array.indexOf(value) > -1;
    },
    clearForm: function () {
        return this.each(function () {
            var type = this.type, tag = this.tagName.toLowerCase();
            if (tag == 'form')
                return $(':input', this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
                this.value = '';
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.selectedIndex = -1;
        });
    },
    getPath: function () {
        var paths = [];

        this.each(function (index, element) {
            var path, $node = jQuery(element);

            while ($node.length) {
                var realNode = $node.get(0), name = realNode.localName;
                if (!name) {
                    break;
                }

                name = name.toLowerCase();
                var parent = $node.parent();
                var sameTagSiblings = parent.children(name);

                if (sameTagSiblings.length > 1) {
                    allSiblings = parent.children();
                    var i = allSiblings.index(realNode) + 1;
                    if (i > 0) {
                        name += ':nth-child(' + i + ')';
                    }
                }

                path = name + (path ? ' > ' + path : '');
                $node = parent;
            }

            paths.push(path);
        });

        return paths.join(',');
    },
    isJsonString: function (str) {
        try {
            $.parseJSON(str);
        } catch (e) {
            return false;
        }
        return true;
    },
    parseJSON: function (str) {
        var $object;
        try {
            $object = $.parseJSON(str);
        } catch (e) {
            return false;
        }
        return $object;
    }
});

var getKeys = function (obj) {
    var keys = [];
    for (var key in obj) {
        keys.push(key);
    }
    return keys;
};

function notify(pane, response, type) {
    var handle = pane.prop('data-notify_handle');
    if ($.fn.isInt(handle)) clearTimeout(handle);

    /**
     * ToDo: Fix bug
     * block runs only for the first time
     */
    if ('message' in response) {
        pane.html('message' in response ? response.message : toString(response));
        pane.attr('class', 'mode' in response ? response.mode + "-text" : (response.status ? "green-text" : "red-text"));
    } else {
        pane.html(toString(response));
        pane.attr('class', type + "-text");
    }
    handle = setTimeout(function () {
        pane.hide();
    }, 10000);
    pane.prop('data-notify_handle', handle);
    pane.attr('style', 'display:block;');
}
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin apps settings class.
var admin__apps__settings__class = function() {

    // If is AJAx request.
    this.a = false;

    // Code mirror.
    this.c = null;

    // If is size and alignment.
    this.sa = false;

    // If is CSS.
    this.cs = false;

    // If is JavaScript.
    this.js = false;

    // Execute settings.
    this.ex = function(c, f, p) {
        var x = admin__apps__settings;
        if (x.a) return;
        x.a = true;
        var css = $('#admin__apps__size_and_align__css').html();
        $('#admin__apps__settings__template').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: c,
                fn: f,
                admin__apps__settings__parameters: p,
                css: css,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__apps__settings;
                $('#admin__apps__settings__template').html(r);
                $('#admin__apps__settings__template').css('opacity', '1');
                $('#admin__apps__settings__ajax_error').removeClass('d-none').hide().fadeIn();
                $('#admin__apps__settings__ajax_confirm').removeClass('d-none').hide().fadeIn();
                if (x.sa) {
                    x.sars();
                    x.sage();
                }
                if (x.cs) {
                    x.incs();
                }
                if (x.js) {
                    x.injs();
                }
                x.a = false;
            }
        });
    };

    // Data execute.
    this.daex = function() {
        var x = admin__apps__settings;
        var b = 'off';
        if($('#admin__apps__settings__cache').prop("checked") == true) {
            b = 'on';
        }
        var j = 'off';
        if($('#admin__apps__settings__js_cache').prop("checked") == true) {
            j = 'on';
        }
        var c = 'off';
        if($('#admin__apps__settings__css_cache').prop("checked") == true) {
            c = 'on';
        }
        var p = '["' + $('#admin__apps__settings__description').val() + '","' + $('#admin__apps__settings__css_container_fluid').val() + '","' + $('#admin__apps__settings__css_container').val() + '","' + $('#admin__apps__settings__css_app').val() +'","' + b + '","' + j + '","' + c + '"]';
        x.ex('settings__data', 'update', p);
    };

    // Initialize CSS.
    this.incs = function() {
        var x = admin__apps__settings;
        var el = document.getElementById('admin__apps__settings__css');
        x.cs = true;
        x.c = CodeMirror(function(elt) {
            el.parentNode.replaceChild(elt, el);
        }, {value: el.value, lineNumbers: true, matchBrackets: true, mode: 'css'});
        x.c.setSize(null, 700);
    };

    // CSS execute.
    this.csex = function() {
        var x = admin__apps__settings;
        var p = x.c.getValue();
        x.ex('settings__css', 'update', p);
    };

    // Initialize JavaScript.
    this.injs = function() {
        var x = admin__apps__settings;
        var el = document.getElementById('admin__apps__settings__js');
        x.js = true;
        x.c = CodeMirror(function(elt) {
            el.parentNode.replaceChild(elt, el);
        }, {value: el.value, lineNumbers: true, matchBrackets: true, mode: 'javascript'});
        x.c.setSize(null, 700);
    };

    // JavaScript execute.
    this.jsex = function() {
        var x = admin__apps__settings;
        var p = x.c.getValue();
        x.ex('settings__js', 'update', p);
    };

    // On resize size and alignment.
    $(window).resize(function() {
        var x = admin__apps__settings;
        if (x.sa) {
            x.sars();
        }
    });

    // Resize blocks size and alignment.
    this.sars = function() {
        $('div[data-object="block"]').each(function () {
            $(this).height($(this).width());
        });
    };

    // Block click size and alignment.
    this.sacl = function(e) {
        var x = admin__apps__settings;
        var size = e.getAttribute('data-size');
        var block = e.getAttribute('data-block') - 1;
        var values = [];
        $('div[data-size="' + size + '"]').each(function () {
            values.push($(this).attr('data-val'));
        });
        var val = values[block];
        if (val === '0') {
            values[block] = '2';
        }
        else if (val === '1') {
            values[block] = '2';
        }
        else if (val === '2') {
            values[block] = '0';
        }
        var isoffset = true;
        var iscol = true;
        var isnull = true;
        for (var i = 0; i < values.length; i++) {
            if (isoffset) {
                if (values[i] === '0' || values[i] === '1') {
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('data-val', '1');
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('class', 'admin__apps__settings__block bg-dark');
                }
                else {
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('data-val', '2');
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('class', 'admin__apps__settings__block bg-primary');
                    isoffset = false;
                }
            }
            else if (iscol) {
                if (values[i] !== '2') {
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('data-val', '0');
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('class', 'admin__apps__settings__block bg-secondary');
                    iscol = false;
                }
                else {
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('data-val', '2');
                    $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('class', 'admin__apps__settings__block bg-primary');
                }
            }
            else {
                $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('data-val', '0');
                $('div[data-size="' + size + '"][data-block="' + (i + 1) + '"]').attr('class', 'admin__apps__settings__block bg-secondary');
            }
            if (values[i] === '2') {
                isnull = false;
            }
        }
        if (isnull) {
            $('div[data-size="' + size + '"]').each(function () {
                $(this).attr('data-val' , '2');
                $(this).attr('class', 'admin__apps__settings__block bg-primary');
            });
        }
        x.sage();
    };

    // Generate CSS size and alignment.
    this.sage = function() {
        var size = ['-', '-sm-', '-md-', '-lg-', '-xl-'];
        var css ='';
        for (var i = 0; i < size.length; i++) {
            var offset = 0;
            var col = 0;
            $('div[data-size="' + size[i] + '"]').each(function () {
                if ($(this).attr('data-val') === '1') {
                    offset++;
                }
                if ($(this).attr('data-val') === '2') {
                    col++;
                }
            });
            if (offset > 0) {
                css += 'offset' + size[i] + '' + offset + ' ';
            }
            else {
                css += 'offset' + size[i] + '0 ';
            }
            if (col > 0) {
                css += 'col' + size[i] + '' + col + ' ';
            }
            else {
                css += 'col' + size[i] + '0 ';
            }
        }
        $('#admin__apps__settings__css').html(css);
    };

    // Save size and alignment.
    this.saex = function() {
        var x = admin__apps__settings;
        var p = $('#admin__apps__settings__css').html();
        x.ex('settings__size', 'update', p);
    };

    // Document ready.
    $(document).ready(function() {
        var x = admin__apps__settings;
        if ($('[data-type="admin__apps__settings__size"]').length !== 0) {
            x.sa = true;
            x.sars();
            x.sage();
        }
        else if ($('[data-type="admin__apps__settings__css"]').length !== 0) {
            x.incs();
        }
        else if ($('[data-type="admin__apps__settings__js"]').length !== 0) {
            x.injs();
        }
    });
};
var admin__apps__settings = new admin__apps__settings__class();
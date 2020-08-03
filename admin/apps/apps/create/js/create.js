/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
*/

// Admin apps create class.
var admin__apps__create__class = function() {

    // If is AJAx request.
    this.a = false;

    // On keypress HTML.
    this.hk = function(ev) {
        if (ev.which == 13) {
            var a = admin__apps__create;
            a.he();
        }
    };

    // HTML execute.
    this.he = function() {
        var a = admin__apps__create;
        if (a.ajax) return;
        $('#admin__apps__create__template').css('opacity', '0.65');
        a.ajax = true;
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'create__html',
                fn: 'build',
                name: $('#admin__apps__create_html__name').val(),
                description: $('#admin__apps__create_html__description').val(),
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function (r) {
                $('#admin__apps__create__template').html(r);
                $('#admin__apps__create__template').css('opacity', '1');
                $('#admin__apps__create_html__ajax_error').removeClass('d-none').hide().fadeIn();
                $('#admin__apps__create_html__ajax_confirm').removeClass('d-none').hide().fadeIn();
                var a = admin__apps__create;
                a.ajax = false;
            }
        });
    };

    // On keypress HTML String.
    this.hsk = function(ev) {
        if (ev.which == 13) {
            var a = admin__apps__create;
            a.hse();
        }
    };

    // HTML String execute.
    this.hse = function() {
        var a = admin__apps__create;
        if (a.ajax) return;
        $('#admin__apps__create__template').css('opacity', '0.65');
        a.ajax = true;
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'create__html_string',
                fn: 'build',
                template: $('input[name="admin__apps__create_html_string__template"]:checked').val(),
                name: $('#admin__apps__create_html_string__name').val(),
                description: $('#admin__apps__create_html_string__description').val(),
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function (r) {
                $('#admin__apps__create__template').html(r);
                $('#admin__apps__create__template').css('opacity', '1');
                $('#admin__apps__create_html_string__ajax_error').removeClass('d-none').hide().fadeIn();
                $('#admin__apps__create_html_string__ajax_confirm').removeClass('d-none').hide().fadeIn();
                var a = admin__apps__create;
                a.ajax = false;
            }
        });
    };

    // On keypress developer.
    this.dk = function(ev) {
        if(ev.which == 13) {
            var a = admin__apps__create;
            a.de();
        }
    };

    // Create developer app.
    this.de = function() {
        var a = admin__apps__create;
        if (a.ajax) return;
        $('#admin__apps__create__template').css('opacity', '0.65');
        a.ajax = true;
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'create__developer',
                fn: 'build',
                development: $('input[name="admin__apps__create_developer__development"]:checked').val(),
                cache: $('input[name="admin__apps__create_developer__cache"]:checked').val(),
                container: $('input[name="admin__apps__create_developer__container"]:checked').val(),
                widget: $('input[name="admin__apps__create_developer__widget"]:checked').val(),
                name: $('#admin__apps__create_developer__name').val(),
                directory: $('#admin__apps__create_developer__directory').val(),
                namespace: $('#admin__apps__create_developer__namespace').val(),
                description: $('#admin__apps__create_developer__description').val(),
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__apps__create__template').html(r);
                $('#admin__apps__create__template').css('opacity', '1');
                $('#admin__apps__create_developer__ajax_error').removeClass('d-none').hide().fadeIn();
                $('#admin__apps__create_developer__ajax_confirm').removeClass('d-none').hide().fadeIn();
                var a = admin__apps__create;
                a.ajax = false;
            }
        });
    };
};
var admin__apps__create = new admin__apps__create__class();
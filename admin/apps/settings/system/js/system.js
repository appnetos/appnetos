/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin settings system class.
var admin__settings__system__class = function() {

    // If is AJAX request.
    this.a = false;

    // Cached data.
    this.c = null;

    // Execute settings.
    this.ex = function(t) {
        var x = admin__settings__system;
        var d = {
            ns: 'admin/settings',
            cl: 'system__model',
            fn: 'update',
            aid: $('[data-ajax-id]').data('ajax-id'),
        };
        if (t === 'debug') {
            if ($('#admin__settings__system__debug').is(':checked')) {
                d.admin__settings__system__debug = 'on';
            }
            else {
                d.admin__settings__system__debug = 'off';
            }
            if ($('#admin__settings__system__debug_ajax').is(':checked')) {
                d.admin__settings__system__debug_ajax = 'on';
            }
            else {
                d.admin__settings__system__debug_ajax = 'off';
            }
            x.ax(d);
        }
        if (t === 'admin') {
            if ($('#admin__settings__system__expert_mode').is(':checked')) {
                d.admin__settings__system__expert_mode = 'on';
            }
            else {
                d.admin__settings__system__expert_mode = 'off';
            }
            if ($('#admin__settings__system__info').is(':checked')) {
                d.admin__settings__system__info = 'on';
            }
            else {
                d.admin__settings__system__info = 'off';
            }
            x.ax(d);
        }
        if (t === 'cache') {
            d.admin__settings__system__cache_expire = $('#admin__settings__system__cache_expire').val();
            if ($('#admin__settings__system__app_cache').is(':checked')) {
                d.admin__settings__system__app_cache = 'on';
            }
            else {
                d.admin__settings__system__app_cache = 'off';
            }
            if ($('#admin__settings__system__file_cache').is(':checked')) {
                d.admin__settings__system__file_cache = 'on';
            }
            else {
                d.admin__settings__system__file_cache = 'off';
            }
            if ($('#admin__settings__system__directory_cache').is(':checked')) {
                d.admin__settings__system__directory_cache = 'on';
            }
            else {
                d.admin__settings__system__directory_cache = 'off';
            }
            if ($('#admin__settings__system__string_cache').is(':checked')) {
                d.admin__settings__system__string_cache = 'on';
            }
            else {
                d.admin__settings__system__string_cache = 'off';
            }
            if ($('#admin__settings__system__js_cache').is(':checked')) {
                d.admin__settings__system__js_cache = 'on';
            }
            else {
                d.admin__settings__system__js_cache = 'off';
            }
            if ($('#admin__settings__system__css_cache').is(':checked')) {
                d.admin__settings__system__css_cache = 'on';
            }
            else {
                d.admin__settings__system__css_cache = 'off';
            }
            if ($('#admin__settings__system__minify').is(':checked')) {
                d.admin__settings__system__minify = 'on';
            }
            else {
                d.admin__settings__system__minify = 'off';
            }
            if ($('#admin__settings__system__compressor').is(':checked')) {
                d.admin__settings__system__compressor = 'on';
            }
            else {
                d.admin__settings__system__compressor = 'off';
            }
            x.ax(d);
        }
    };

    // Execute AJAX.
    this.ax = function(d) {
        var x = admin__settings__system;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__settings__system__template').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: d,
            success: function(r) {
                var x = admin__settings__system;
                $('#admin__settings__system__template').html(r);
                $('#admin__settings__system__template').css('opacity', '1');
                $('#admin__settings__system__ajax_error').removeClass('d-none').hide().fadeIn();
                $('#admin__settings__system__ajax_confirm').removeClass('d-none').hide().fadeIn();
                x.a = false;
            }
        });
    };

    // Move class extend.
    this.mc = function(i, d) {
        var x = admin__settings__system;
        if (x.a) {
            return;
        }
        x.a = true;
        var data = {
            index: i,
            direction: d
        }
        $('#admin__settings__system__template').css('opacity', '0.65');
        appnetos.ajaxJson('admin/settings', 'system__extends', 'move', 'admin__settings__system.mcc', data);
    };
    // Move class extend callback.
    this.mcc = function(r) {
        var x = admin__settings__system;
        $('#admin__settings__system__template').html(r);
        $('#admin__settings__system__template').css('opacity', '1');
        $('#admin__settings__system__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#admin__settings__system__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };

    // Remove class.
    this.rm = function(i, t) {
        var x = admin__settings__system;
        x.c = {
            index: i,
            type: t
        }
        $('#admin__settings__system__modal_remove').modal('show');
    };
    // Remove class confirm.
    this.rma = function() {
        var x = admin__settings__system;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__settings__system__template').css('opacity', '0.65');
        $('#admin__settings__system__modal_remove').modal('hide').delay(550).queue(function() {
            var x = admin__settings__system;
            appnetos.ajaxJson('admin/settings', 'system__extends', 'remove', 'admin__settings__system.rmc', x.c);
        });
    };
    // Remove class callback.
    this.rmc = function(r) {
        var x = admin__settings__system;
        $('#admin__settings__system__template').html(r);
        $('#admin__settings__system__template').css('opacity', '1');
        $('#admin__settings__system__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#admin__settings__system__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };

    // Activate.
    this.on = function(i) {
        var x = admin__settings__system;
        if (x.a) {
            return;
        }
        x.a = true;
        var data = {
            index: i
        }
        $('#admin__settings__system__template').css('opacity', '0.65');
        appnetos.ajaxJson('admin/settings', 'system__extends', 'activate', 'admin__settings__system.onc', data);
    };
    // Activate callback.
    this.onc = function(r) {
        var x = admin__settings__system;
        $('#admin__settings__system__template').html(r);
        $('#admin__settings__system__template').css('opacity', '1');
        $('#admin__settings__system__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#admin__settings__system__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };

    // Deactivate.
    this.of = function(i) {
        var x = admin__settings__system;
        if (x.a) {
            return;
        }
        x.a = true;
        var data = {
            index: i
        }
        $('#admin__settings__system__template').css('opacity', '0.65');
        appnetos.ajaxJson('admin/settings', 'system__extends', 'deactivate', 'admin__settings__system.ofc', data);
    };
    // Deactivate callback.
    this.ofc = function(r) {
        var x = admin__settings__system;
        $('#admin__settings__system__template').html(r);
        $('#admin__settings__system__template').css('opacity', '1');
        $('#admin__settings__system__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#admin__settings__system__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var admin__settings__system = new admin__settings__system__class();


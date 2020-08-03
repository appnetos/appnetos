/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Forgotten password form class.
var appnetos__forgotten_password_form__class = function() {

    // If is AJAX.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Submit email.
    this.se = function(id) {
        var x = appnetos__forgotten_password_form;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show();
        var mid = null;
        if ($('#app-' + id + '-mid').length) {
            mid = $('#app-' + id + '-mid').html();
        }
        var data = {
            address: $('#app-' + id + '-address').val(),
            mid: mid,
        }
        appnetos.ajaxJson('appnetos', 'forgotten_password_form', 'submitEmail', 'appnetos__forgotten_password_form.sec', data);
    };
    // submit email callback.
    this.sec = function(r) {
        var x = appnetos__forgotten_password_form;
        $('#app-' + x.id).html(r);
        if ($('#app-' + x.id + '-confirm').length) {
            $('#app-' + x.id + '-confirm').fadeIn();
        }
        x.a = false;
    };

    // Submit pass.
    this.sp = function(id) {
        var x = appnetos__forgotten_password_form;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        $('#app-' + id + '-error').hide();
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show();
        var mid = null;
        if ($('#app-' + id + '-mid').length) {
            mid = $('#app-' + id + '-mid').html();
        }
        var data = {
            address: $('#app-' + id + '-address').val(),
            pass: $('#app-' + id + '-pass').val(),
            repeat: $('#app-' + id + '-repeat').val(),
            mid: mid,
        }
        appnetos.ajaxJson('appnetos', 'forgotten_password_form', 'submitPass', 'appnetos__forgotten_password_form.spc', data);
    };
    // Submit pass callback.
    this.spc = function(r) {
        var x = appnetos__forgotten_password_form;
        var id = x.id;
        $('#app-' + id).html(r);
        if ($('#app-' + x.id + '-error').length) {
            $('#app-' + x.id + '-error').fadeIn();
        }
        if ($('#app-' + x.id + '-confirm').length) {
            $('#app-' + x.id + '-confirm').fadeIn();
        }
        x.a = false;
    };

    // Show hide passwords.
    this.sh = function(id) {
        var url = $('[data-application-url]').data('application-url');
        if ($('#app-' + id + '-pass').attr('type') === 'password') {
            $('#app-' + id + '-pass').attr('type', 'text').next().find('img').attr('src', url + '/out/img/appnetos/eye_close.svg');
            $('#app-' + id + '-repeat').attr('type', 'text').next().find('img').attr('src', url + '/out/img/appnetos/eye_close.svg');
        }
        else{
            $('#app-' + id + '-pass').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
            $('#app-' + id + '-repeat').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
        }
    }
};
var appnetos__forgotten_password_form = new appnetos__forgotten_password_form__class();
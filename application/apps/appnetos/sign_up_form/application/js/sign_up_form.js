/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos sign up form class.
var appnetos__sign_up_form__class = function() {

    // If is AJAX.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Submit.
    this.su = function(id)  {
        var x = appnetos__sign_up_form;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        var h = $('#app-' + id + '-form').height();
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show().height(h);
        if ($('#app-' + id + '-mid').length) {
            var mid = $('#app-' + id + '-mid').html();
        }
        var terms = 'off';
        if ($('#app-' + id + '-terms').is(':checked')) {
            terms = 'on';
        }
        var data = {
            mid: mid,
            user: $('#app-' + id + '-user').val(),
            address: $('#app-' + id + '-address').val(),
            pass: $('#app-' + id + '-pass').val(),
            pass_repeat: $('#app-' + id + '-repeat').val(),
            terms: terms,
        }
        appnetos.ajaxJson('appnetos', 'sign_up_form', 'submit', 'appnetos__sign_up_form.suc', data);
    };
    // Submit callback.
    this.suc = function(r) {
        var x = appnetos__sign_up_form;
        $('#app-' + x.id).html(r);
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
    };
};
var appnetos__sign_up_form = new appnetos__sign_up_form__class();
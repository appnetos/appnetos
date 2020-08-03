/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Change password form class.
var appnetos__change_password_form__class = function() {

    // If is AJAX.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Submit.
    this.sm = function(id) {
        var x = appnetos__change_password_form;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        $('#app-' + id + '-error').hide();
        $('#app-' + id + '-confirm').hide();
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show();
        appnetos.ajaxForm('appnetos', 'change_password_form', 'submit', 'appnetos__change_password_form.smc', 'app-' + id + '-form');
    };
    // Submit callback.
    this.smc = function(r) {
        var x = appnetos__change_password_form;
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
            $('#app-' + id + '-passOld').attr('type', 'text').next().find('img').attr('src', url + '/out/img/appnetos/eye_close.svg');
        }
        else{
            $('#app-' + id + '-pass').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
            $('#app-' + id + '-repeat').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
            $('#app-' + id + '-passOld').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
        }
    };
};
var appnetos__change_password_form = new appnetos__change_password_form__class();
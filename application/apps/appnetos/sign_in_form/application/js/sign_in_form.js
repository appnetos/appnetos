/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos sign in form class.
var appnetos__sign_in_form__class = function() {

    // Cached ID.
    this.id = null;

    // Sign in.
    this.si = function(id) {
        appnetos__sign_in_form.lo(id);
        appnetos__sign_in_form.id = id;
        var data = {};
        data.stay = 0;
        if ($('#app-' + id + '-stay').prop('checked') === true) {
            data.stay = 1;
        }
        data.user = $('#app-' + id + '-user').val();
        data.pass = $('#app-' + id + '-pass').val();
        appnetos.ajaxJson('appnetos', 'sign_in_form', 'signIn', 'appnetos__sign_in_form.sic', data);
    };

    // Sign in callback.
    this.sic = function(data) {
        if (typeof data.success !== 'undefined') {
            window.open(window.location.href, '_self');
        }
        else {
            var id = appnetos__sign_in_form.id;
            $('#app-' + id) .html(data);
        }
    };

    // Sign out.
    this.so = function() {
        appnetos__sign_in_form.lo();
        appnetos.ajaxJson('appnetos', 'sign_in_form', 'signOut', 'appnetos__sign_in_form.soc');
    };

    // Sign out callback.
    this.soc = function(data) {
        window.open(window.location.href, '_self');
    };

    // Key down event.
    this.kd = function(event, id) {
        if (event.keyCode === 13) {
            var x = appnetos__sign_in_form;
            x.si(id);
        }
    };

    // Show loading.
    this.lo = function(id) {
        var h = $('#app-' + id + '-form').height();
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show().height(h);
    };

    // Show hide password.
    this.sh = function(id) {
        var url = $('[data-application-url]').data('application-url');
        if ($('#app-' + id + '-pass').attr('type') === 'password') {
            $('#app-' + id + '-pass').attr('type', 'text').next().find('img').attr('src', url + '/out/img/appnetos/eye_close.svg');
        }
        else{
            $('#app-' + id + '-pass').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
        }
    }
};
var appnetos__sign_in_form = new appnetos__sign_in_form__class();
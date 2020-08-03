/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// APPNET OS force sign in class.
var appnetos__force_sign_in__class = function() {

    // If is AJAX request.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Sign in key down.
    this.kd = function(event, id) {
        if (event.keyCode === 13) {
            var x = appnetos__force_sign_in;
            x.si(id);
        }
    };

    // Sign in.
    this.si = function(id) {
        var x = appnetos__force_sign_in;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        appnetos.ajaxForm('appnetos', 'force_sign_in', 'signIn', 'appnetos__force_sign_in.sic', 'app-' + id + '-form');
    };
    // Sign in callback.
    this.sic = function(r) {
        var x = appnetos__force_sign_in;
        if (r.success) {
            window.open(window.location.href, '_self');
        }
        else {
            $('#app-' + x.id).html(r);
            $('#appnetos__force_sign_in__error').fadeIn();
        }
        x.a = false;
    };

    // Show hide passwords.
    this.sh = function(id) {
        var url = $('[data-application-url]').data('application-url');
        if ($('#app-' + id + '-pass').attr('type') === 'password') {
            $('#app-' + id + '-pass').attr('type', 'text').next().find('img').attr('src', url + '/out/img/appnetos/eye_close.svg');
        }
        else{
            $('#app-' + id + '-pass').attr('type', 'password').next().find('img').attr('src', url + '/out/img/appnetos/eye_open.svg');
        }
    };
};
var appnetos__force_sign_in = new appnetos__force_sign_in__class();
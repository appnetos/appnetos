/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos navbar class.
var appnetos__navbar__class = function() {

    // In is AJAX.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Sign in key down.
    this.kd = function(ev, id) {
        if (ev.keyCode === 13) {
            var x = appnetos__navbar;
            x.si(id);
        }
    };

    // Sign in.
    this.si = function(id) {
        var x = appnetos__navbar;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        $('#app-' + id + '-sign_in').hide();
        $('#app-' + id + '-error').hide();
        $('#app-' + id + '-loading').show();
        var stay = 0;
        if ($('#app-' + id + '-stay').prop('checked') === true) {
            stay = 1;
        }
        var data = {
            user: $('#app-' + id + '-user').val(),
            pass: $('#app-' + id + '-pass').val(),
            stay: stay,
        }
        appnetos.ajaxJson('appnetos', 'navbar', 'signIn', 'appnetos__navbar.sic', data);
    };
    // Sign in callback.
    this.sic = function(r) {
        var x = appnetos__navbar;
        var id = x.id;
        if (r.success === false) {
            $('#app-' + id + '-sign_in').show();
            $('#app-' + id + '-loading').hide();
            $('#app-' + id + '-error').fadeIn();
        }
        else {
            window.open(window.location.href, '_self');
        }
        x.a = false;
    };

    // Sign out.
    this.so = function() {
        var x = appnetos__navbar;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxJson('appnetos', 'navbar', 'signOut', 'appnetos__navbar.soc', {});
    };
    // Sign out callback.
    this.soc = function(r) {
        var x = appnetos__navbar;
        window.open(window.location.href, '_self');
        x.a = false;
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
    };
};
var appnetos__navbar = new appnetos__navbar__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin sign in class.
var admin__sign_in__class = function() {

    // If is AJAX request.
    this.a = false;

    // Sign in.
    this.si = function() {
        var x = admin__sign_in;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('admin', 'sign_in', 'signIn', 'admin__sign_in.sic', 'admin__sign_in__form');
    };
    // Sign in callback.
    this.sic = function(r) {
        if (r.error) {
            $('#admin__sign_in__pass').val('');
            $('#admin__sign_in__error').hide().fadeIn();
            var x = admin__sign_in;
            x.a = false;
        }
        else {
            window.open(window.location.href, '_self');
        }
    };

    // Set triggers.
    $(document).ready(function() {
        var x = admin__sign_in;
        $('[class="form-control"]').keyup(function (event) {
            if (event.keyCode === 13) {
                x.si();
            }
        });
        $('#admin__sign_in__btn').click(function (event) {
            x.si();
        });
    });

    // Show hide passwords.
    this.sh = function() {
        var url = $('[data-application-url]').data('application-url');
        if ($('#admin__sign_in__pass').attr('type') === 'password') {
            $('#admin__sign_in__pass').attr('type', 'text').next().find('img').attr('src', url + '/out/admin/img/appnetos/eye_close.svg');
        }
        else{
            $('#admin__sign_in__pass').attr('type', 'password').next().find('img').attr('src', url + '/out/admin/img/appnetos/eye_open.svg');
        }
    };
};
var admin__sign_in = new admin__sign_in__class();
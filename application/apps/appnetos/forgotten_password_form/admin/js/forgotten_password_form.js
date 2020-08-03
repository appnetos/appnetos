/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Edit.
var appnetos__forgotten_password_form__class = function() {

    // If is AJAX.
    this.a = false;

    // Edit.
    this.ed = function() {
        var x = appnetos__forgotten_password_form;
        if (x.a) {
            return;
        }
        x.a = true;
        var data = {
            mailbox: $('#appnetos__forgotten_password_form__mailbox').val(),
            name: $('#appnetos__forgotten_password_form__name').val(),
        };
        appnetos.ajaxJson('appnetos', 'forgotten_password_form', 'edit', 'appnetos__forgotten_password_form.edc', data);
    };
    // Edit callback.
    this.edc = function(r) {
        var x = appnetos__forgotten_password_form;
        $('#appnetos__forgotten_password_form__settings').html(r);
        $('#appnetos__forgotten_password_form__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#appnetos__forgotten_password_form__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var appnetos__forgotten_password_form = new appnetos__forgotten_password_form__class();
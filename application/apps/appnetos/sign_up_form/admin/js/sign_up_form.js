/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos sign up form class.
var appnetos__sign_up_form__class = function() {

    // If is ajax.
    this.a = false;

    // Pick URI.
    this.pc = function(id) {
        $('#appnetos__sign_up_form__terms').val(id);
    };

    // Force checkbox click.
    this.fc = function() {
        if ($('#appnetos__sign_up_form__force').is(':checked')) {
            $('#appnetos__sign_up_form__mail').slideUp();
        }
        else
        {
            $('#appnetos__sign_up_form__mail').slideDown();
        }
    };

    // Edit.
    this.sa = function() {
        var x = appnetos__sign_up_form;
        if (x.a) {
            return;
        }
        x.a = true;
        var force = 'off';
        if ($('#appnetos__sign_up_form__force').is(':checked')) {
            force = 'on';
        }
        var data = {
            mailbox: $('#appnetos__sign_up_form__mailbox').val(),
            terms: $('#appnetos__sign_up_form__terms').val(),
            name: $('#appnetos__sign_up_form__name').val(),
            force: force,
        }
        appnetos.ajaxJson('appnetos', 'sign_up_form', 'edit', 'appnetos__sign_up_form.sac', data);
    };
    // Edit callback.
    this.sac = function(r) {
        var x = appnetos__sign_up_form;
        $('#appnetos__sign_up_form__settings').html(r);
        $('#appnetos__sign_up_form__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#appnetos__sign_up_form__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var appnetos__sign_up_form = new appnetos__sign_up_form__class();
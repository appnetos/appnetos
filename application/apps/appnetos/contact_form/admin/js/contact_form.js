/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos contact form class.
var appnetos__contact_form__class = function() {

    // Is is AJAX.
    this.a = false;

    // Edit settings.
    this.ed = function() {
        var x = appnetos__contact_form;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('appnetos', 'contact_form', 'edit', 'appnetos__contact_form.edc', 'appnetos__contact_form__form');
    };
    // Edit settings callback.
    this.edc = function(r) {
        var x = appnetos__contact_form;
        $('#appnetos__contact_form__settings').html(r);
        $('#appnetos__contact_form__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#appnetos__contact_form__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var appnetos__contact_form = new appnetos__contact_form__class();
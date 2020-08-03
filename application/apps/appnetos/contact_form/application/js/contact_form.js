/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos contact form class.
var appnetos__contact_form__class = function() {

    // If is AJAX.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Submit.
    this.su = function(id) {
        var x = appnetos__contact_form;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        $('#app-' + id + '-error').hide();
        $('#app-' + id + '-confirm').hide();
        var h = $('#app-' + id + '-form').height();
        $('#app-' + id + '-form').hide();
        $('#app-' + id + '-loading').show().height(h);
        appnetos.ajaxForm('appnetos', 'contact_form', 'submit', 'appnetos__contact_form.suc', 'app-' + id + '-form');
    };

    // Submit callback.
    this.suc = function(result) {
        var x = appnetos__contact_form;
        $('#app-' + x.id).html(result);
        if ($('#app-' + x.id + '-error').length) {
            $('#app-' + x.id + '-error').fadeIn();
        }
        if ($('#app-' + x.id + '-confirm').length) {
            $('#app-' + x.id + '-confirm').fadeIn();
        }
        x.a = false;
    };
};
var appnetos__contact_form = new appnetos__contact_form__class();
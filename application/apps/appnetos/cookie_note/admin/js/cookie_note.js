/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos cookie note class.
var appnetos__cookie_note__class = function() {

    // In is AJAX.
    this.a = false;

    // Edit.
    this.ed = function() {
        var x = appnetos__cookie_note;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('appnetos', 'cookie_note', 'edit', 'appnetos__cookie_note.edc', 'appnetos__cookie_note__form');
    };
    // Edit callback.
    this.edc = function(result) {
        var x = appnetos__cookie_note;
        $('#appnetos__cookie_note__settings').html(result);
        $('#appnetos__cookie_note__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#appnetos__cookie_note__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var appnetos__cookie_note = new appnetos__cookie_note__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos cookie note class.
var appnetos__cookie_note__class = function() {

    // If is AJAX.
    this.a = false;

    // Accept cookie.
    this.ac = function(id) {
        var x = appnetos__cookie_note;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('appnetos', 'cookie_note', 'accept', 'appnetos__cookie_note.acc', 'app-' + id + '-form');
    };
    // Accept cookie callback.
    this.acc = function() {
        var x = appnetos__cookie_note;
        x.a = false;
        window.open(window.location.href, '_self');
    };

    // Show modal information.
    this.sh = function(id) {
        $('#app-' + id + '-modal').modal('show');
    };

    // Hide min height.
    $(document).ready(function() {
        $('div[data-name="appnetos__cookie_note__children"]').parent().hide();
    });
};
var appnetos__cookie_note = new appnetos__cookie_note__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos language_menu class.
var appnetos__language_menu__class = function() {

    // In is AJAX.
    this.a = false;

    // Cached app ID.
    this.id = null;

    // Open close.
    this.to = function(event, id) {
        event.preventDefault();
        event.stopPropagation();
        var x = appnetos__language_menu;
        x.id = id;
        if ($('#app-' + id + '-sel').css('display') == 'none') {
            $('#app-' + id + '-sel').slideDown('fast');
        } else {
            $('#app-' + id + '-sel').slideUp('fast');
        }
    };

    // Close on click outside.
    $(window).click(function() {
        var x = appnetos__language_menu;
        if (x.id) {
            $('#app-' + x.id + '-sel').slideUp('fast');
        }
    });
    this.uf = function(event) {
        event.stopPropagation();
    };

    // Select.
    this.se = function(event, key) {
        event.preventDefault();
        var x = appnetos__language_menu;
        if (x.a) {
            return;
        }
        x.a = true;
        data = {
            key: key,
        }
        appnetos.ajaxJson('appnetos', 'language_menu', 'set', 'appnetos__language_menu.sec', data);
    };
    // Select callback.
    this.sec = function(r) {
        var x = appnetos__language_menu;
        if (r.link !== false) {
            window.open(r.link, '_self');
        } else {
            window.open(window.location.href, '_self');
        }
        x.a = false;
    };
};
var appnetos__language_menu = new appnetos__language_menu__class();

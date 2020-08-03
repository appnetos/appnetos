/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Appnetos widgets widgets cache class.
var appnetos__widgets__widget_cache__class = function() {

    // If is AJAx request.
    this.a = false;

    // Execute.
    this.ex = function(ev, fn) {
        ev.preventDefault();
        var x = appnetos__widgets__widget_cache;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxFunction('appnetos/widgets', 'widget_cache', fn, 'appnetos__widgets__widget_cache.exc', {});
    };
    // Execute callback.
    this.exc = function(r) {
        var x = appnetos__widgets__widget_cache;
        $('#appnetos__widgets__widget_cache__list').html(r);
        $('#appnetos__widgets__widget_cache__confirm').fadeIn();
        x.a = false;
    };
};
var appnetos__widgets__widget_cache = new appnetos__widgets__widget_cache__class();
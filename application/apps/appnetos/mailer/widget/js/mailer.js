/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos mailer class.
var appnetos__mailer__class = function() {

    // If is ajax.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Reset counter.
    this.re = function(ev, id) {
        ev.preventDefault();
        var x = appnetos__mailer;
        if (x.a) {
            return;
        }
        x.a = true;
        x.id = id;
        data = {
            aid: $('[data-ajax-id]').data('ajax-id'),
        }
        appnetos.ajaxJson('appnetos', 'mailer', 'reset', 'appnetos__mailer.rec', data);
    };
    // Reset counter callback.
    this.rec = function(r) {
        var x = appnetos__mailer;
        $('#app-' + x.id + '-mailer_count').html(r);
        $('#appnetos__mailer__confirm').show();
        x.a = false;
    };
};
var appnetos__mailer = new appnetos__mailer__class();
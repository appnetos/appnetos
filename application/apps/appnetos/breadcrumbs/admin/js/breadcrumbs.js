/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos breadcrumbs class.
var appnetos__breadcrumbs__class = function() {

    // In is AJAX.
    this.a = false;

    // Edit.
    this.ed = function () {
        var x = appnetos__breadcrumbs;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('appnetos', 'breadcrumbs', 'edit', 'appnetos__breadcrumbs.edc', 'appnetos__breadcrumbs__form');
    };
    // Edit callback.
    this.edc = function(r) {
        var x = appnetos__breadcrumbs;
        $('#appnetos__breadcrumbs__settings').html(r);
        $('#appnetos__breadcrumbs__ajax_error').removeClass('d-none').hide().fadeIn();
        $('#appnetos__breadcrumbs__ajax_confirm').removeClass('d-none').hide().fadeIn();
        x.a = false;
    };
};
var appnetos__breadcrumbs = new appnetos__breadcrumbs__class();
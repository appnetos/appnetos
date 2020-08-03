/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos background changer class.
var appnetos__background_changer__class = function() {

    // On input.
    this.oi = function(el) {
        var e = $(el);
        var n = e.val();
        n = n.replace(/\\/g, '/');
        var a = n.split('/');
        var v = a[a.length - 1];
        e.next('.custom-file-label').html(v);
    };
}
var appnetos__background_changer = new appnetos__background_changer__class();
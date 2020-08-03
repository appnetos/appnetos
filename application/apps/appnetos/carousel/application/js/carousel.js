/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos carousel class.
var appnetos__carousel__class = function() {

    // Click.
    this.cl = function(link) {
        window.open(link, '_self');
    };
}
var appnetos__carousel = new appnetos__carousel__class();
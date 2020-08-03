/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos sign in form class.
var appnetos__sign_in_form__class = function() {

    // URI Picker registration.
    this.pr = function(id) {
        $('#sign_in_form__signup').val(id);
    };

    // URI picker forget password.
    this.pp = function(id) {
        $('#sign_in_form__forgetPass').val(id);
    };
};
var appnetos__sign_in_form = new appnetos__sign_in_form__class();
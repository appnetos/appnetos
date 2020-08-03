/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin menu language menu class.
var admin__menu__language_menu__class = function() {

    // Select execute.
    this.ex = function(k) {
        $('.modal').modal('hide');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/menu',
                cl: 'language_menu',
                fn: 'select',
                admin__menu__language_menu__key: k,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                window.open(window.location.href, '_self');
            }
        });
    };

    // Document ready.
    $(document).ready(function() {
        var m = $('#admin__menu__language_menu__modal_languages').clone();
        $('#admin__menu__language_menu__modal_languages').remove();
        $('body').append(m);
    });
};
var admin__menu__language_menu = new admin__menu__language_menu__class();
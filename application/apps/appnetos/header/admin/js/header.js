/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos header class.
var appnetos__header__class = function() {

    // On input.
    this.oi = function(el) {
        var e = $(el);
        var n = e.val();
        n = n.replace(/\\/g, '/');
        var a = n.split('/');
        var v = a[a.length - 1];
        e.next('.custom-file-label').html(v);
    };

    // Add.
    this.ad = function(event, logo) {
        event.preventDefault();
        $('#appnetos__header__add_logo').val(logo);
        $('#appnetos__header__modal_add').modal('show');
    };

    // Edit.
    this.ed = function(id, link, width) {
        $('#appnetos__header__edit_id').val(id);
        $('#appnetos__header__edit_link').val(link);
        $('#appnetos__header__edit_width').val(width);
        $('#appnetos__header__edit').modal('show');
    };

    // Delete.
    this.de = function(id) {
        $('#appnetos__header__delete_id').val(id);
        $('#appnetos__header__modal_delete').modal('show');
    };

    // Edit images.
    this.ei = function(id) {
        $('#appnetos__header__edit_images_id').val(id);
        $('#appnetos__header__modal_edit_images').modal('show');
    };

    // Add languages.
    this.al = function(id) {
        $('#header__add_language_select').html($('#header__add_language_select_' + id).html());
        $('#appnetos__header__add_language_id').val(id);
        $('#appnetos__header__modal_add_language').modal('show');
    };

    // Add cms picker.
    this.pa = function (id) {
      $('input[name="header__add_link"]').val(id);
    };

    // Edit cms picker.
    this.pe = function (id) {
        $('input[name="header__edit_link"]').val(id);
    };
};
var appnetos__header = new appnetos__header__class();
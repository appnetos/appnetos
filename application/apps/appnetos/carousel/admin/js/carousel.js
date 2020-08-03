/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos carousel class.
var appnetos__carousel__class = function() {

    // On input.
    this.oi = function(el) {
        var e = $(el);
        var n = e.val();
        n = n.replace(/\\/g, '/');
        var a = n.split('/');
        var v = a[a.length - 1];
        e.next('.custom-file-label').html(v);
    };

    // Edit entry.
    this.ed = function(id, link) {
        $('#appnetos__carousel__edit_id').val(id);
        $('#appnetos__carousel__edit_link').val(link);
        $('#appnetos__carousel__modal_edit').modal('show');
    };

    // Edit image.
    this.ei = function(id) {
        $('#appnetos__carousel__edit_image_id').val(id);
        $('#appnetos__carousel__modal_edit_image').modal('show');
    };

    // Delete.
    this.de = function(id) {
        $('#appnetos__carousel__delete_id').val(id);
        $('#appnetos__carousel__modal_delete').modal('show');
    };

    // Add language.
    this.al = function(id) {
        $('#appnetos__carousel__add_language_select').html($('#appnetos__carousel__add_language_select_' + id).html());
        $('#appnetos__carousel__add_language_id').val(id);
        $('#appnetos__carousel__modal_add_language').modal('show');
    };

    // Add cms picker add.
    this.pa = function (id) {
        $('input[name="carousel__add_link"]').val(id);
    };

    // Add cms picker edit.
    this.pe = function (id) {
        $('input[name="carousel__edit_link"]').val(id);
    };
}
var appnetos__carousel = new appnetos__carousel__class();
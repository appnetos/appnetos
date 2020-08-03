/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos navbar class.
var appnetos__navbar__class = function() {

    // Cached element.
    this.el = null;

    // CMS picker pick.
    this.pp = function(n) {
        var x = appnetos__navbar;
        x.el = n;
        admin__cms__picker.pick('appnetos__navbar.pc')
    };

    // CMS picker callback.
    this.pc = function(id) {
        var x = appnetos__navbar;
        var n = x.el;
        $('input[name="' + n + '"').val(id);
    };

    // Add.
    this.ad = function(event, id) {
        event.preventDefault();
        $('#appnetos__navbar__add_id').val(id);
        $('#appnetos__navbar__add_name').val('');
        $('#appnetos__navbar__add_link').val('');
        $('#appnetos__navbar__modal_add').modal('show');
    };

    // Delete.
    this.de = function(event, id) {
        event.preventDefault();
        $('#appnetos__navbar__delete_id').val(id);
        $('#appnetos__navbar__modal_delete').modal('show');
    };

    // Move menu.
    this.mm = function(event, id, to) {
        event.preventDefault();
        $('body').append($('<form/>')
            .attr({'action': window.location.href, 'method': 'post', 'id': 'navbar__replacer'})
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'action', 'value': 'navbar__move'})
            )
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'navbar__id', 'value': id})
            )
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'navbar__to', 'value': to})
            )
        ).find('#navbar__replacer').submit();
    };

    // Move submenu.
    this.ms = function(event, id, to) {
        event.preventDefault();
        $('body').append($('<form/>')
            .attr({'action': window.location.href, 'method': 'post', 'id': 'navbar__replacer_sub'})
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'action', 'value': 'navbar__move_sub'})
            )
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'navbar__id', 'value': id})
            )
            .append($('<input/>')
                .attr({'type': 'hidden', 'name': 'navbar__to', 'value': to})
            )
        ).find('#navbar__replacer_sub').submit();
    };

    // Scroll.
    $('[data-appnetos__navbar="scroll"]').on('scroll', function (e) {
        horizontal = e.currentTarget.scrollLeft;
        $('[data-appnetos__navbar="scroll"]').scrollLeft(horizontal);
    });
};
var appnetos__navbar = new appnetos__navbar__class();
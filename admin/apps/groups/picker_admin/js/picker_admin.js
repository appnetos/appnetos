/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin groups picker admin class.
var admin__groups__picker_admin__class = function() {

    // Function for picker.
    this.f = null;

    // If is AJAx request.
    this.a = false;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__groups__picker_admin;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__groups__picker_admin;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__groups__picker_admin__groups_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/groups',
                cl: 'picker_admin',
                fn: 'search',
                admin__groups__picker_admin__search_number: $('#admin__groups__picker_admin__search_number').val(),
                admin__groups__picker_admin__search_order: $('#admin__groups__picker_admin__search_order').val(),
                admin__groups__picker_admin__search_search: $('#admin__groups__picker_admin__search_search').val(),
                admin__groups__picker_admin__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__groups__picker_admin__groups_list').html(r).css('opacity', '1');
                var x = admin__groups__picker_admin;
                x.a = false;
            }
        });
    };

    // Open picker and set function.
    this.pick = function(f) {
        var x = admin__groups__picker_admin;
        x.f = f;
        $('#admin__groups__picker_admin__modal').modal('show');
    };

    // Pick application.
    this.p = function(id) {
        $('#admin__groups__picker_admin__modal').modal('hide');
        var x = admin__groups__picker_admin;
        var f = x.f;
        x.ex(f, window, id);
    };

    // Execute function by name.
    this.ex = function(f, c) {
        var args = Array.prototype.slice.call(arguments, 2);
        var n = f.split(".");
        var fn = n.pop();
        for(var i = 0; i < n.length; i++) {
            c = c[n[i]];
        }
        return c[fn].apply(c, args);
    };
};
var admin__groups__picker_admin = new admin__groups__picker_admin__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin widgets picker class.
var admin__widgets__picker__class = function() {

    // Function for picker.
    this.f = null;

    // If is AJAx request.
    this.a = false;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__widgets__picker;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__widgets__picker;
        if (x.a) return;
        x.a = true;
        $('#admin__widgets__picker__widgets_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/widgets',
                cl: 'picker',
                fn: 'search',
                admin__widgets__picker__search_number: $('#admin__widgets__picker__search_number').val(),
                admin__widgets__picker__search_order: $('#admin__widgets__picker__search_order').val(),
                admin__widgets__picker__search_search: $('#admin__widgets__picker__search_search').val(),
                admin__widgets__picker__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__widgets__picker__widgets_list').html(r).css('opacity', '1');
                var x = admin__widgets__picker;
                x.a = false;
            }
        });
    };

    // Open picker and set function.
    this.pick = function(f) {
        var x = admin__widgets__picker;
        x.f = f;
        $('#admin__widgets__picker__modal').modal('show');
    };

    // Pick application.
    this.p = function(id) {
        $('#admin__widgets__picker__modal').modal('hide');
        var x = admin__widgets__picker;
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
var admin__widgets__picker = new admin__widgets__picker__class();
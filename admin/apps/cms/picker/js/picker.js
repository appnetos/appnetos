/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms picker class.
var admin__cms__picker__class = function() {

    // Function for picker.
    this.f = null;

    // If is AJAx request.
    this.a = false;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__cms__picker;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__cms__picker;
        if (x.a) return;
        x.a = true;
        $('#admin__cms__picker__uris_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'picker',
                fn: 'search',
                admin__cms__picker__search_number: $('#admin__cms__picker__search_number').val(),
                admin__cms__picker__search_order: $('#admin__cms__picker__search_order').val(),
                admin__cms__picker__search_search: $('#admin__cms__picker__search_search').val(),
                admin__cms__picker__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__picker__uris_list').html(r).css('opacity', '1');
                var x = admin__cms__picker;
                x.a = false;
            }
        });
    };

    // Open picker and set function.
    this.pick = function(f) {
        var x = admin__cms__picker;
        x.f = f;
        $('#admin__cms__picker__modal').modal('show');
    };

    // Pick application.
    this.p = function(id) {
        $('#admin__cms__picker__modal').modal('hide');
        var x = admin__cms__picker;
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
var admin__cms__picker = new admin__cms__picker__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms picker_application class.
var admin__cms__picker_application__class = function() {

    // Function for picker.
    this.f = null;

    // Excluded IDs.
    this.e = [];

    // If is AJAx request.
    this.a = false;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__cms__picker_application;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__cms__picker_application;
        if (x.a) {
            return;
        }
        x.a = true;
        if (typeof x.e === 'undefined') {
            x.e = [];
        }
        $('#admin__cms__picker_application__uris_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'picker_application',
                fn: 'search',
                admin__cms__picker_application__search_number: $('#admin__cms__picker_application__search_number').val(),
                admin__cms__picker_application__search_order: $('#admin__cms__picker_application__search_order').val(),
                admin__cms__picker_application__search_search: $('#admin__cms__picker_application__search_search').val(),
                admin__cms__picker_application__search_excluded: x.e,
                admin__cms__picker_application__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__picker_application__uris_list').html(r).css('opacity', '1');
                var x = admin__cms__picker_application;
                x.a = false;
            }
        });
    };

    // Open picker and set function.
    this.pick = function(f, e) {
        var x = admin__cms__picker_application;
        if (typeof e === 'undefined') {
            e = [];
        }
        x.e = e;
        x.f = f;
        x.se(0);
        $('#admin__cms__picker_application__modal').modal('show');
    };

    // Check URI.
    this.ch = function(id) {
        var e = $('[data-type="admin__cms__picker_application_selection"][name="' + id + '"]');
        if ($(e).prop('checked') === true) {
            $(e).prop('checked', false);
        } else {
            $(e).prop('checked', true);
        }
    };

    // Prevent default.
    this.pd = function(e) {
        e.preventDefault();
    };

    // Pick Uris.
    this.p = function(id) {
        $('#admin__cms__picker_application__modal').modal('hide');
        var e = [];
        $('[data-type="admin__cms__picker_application_selection"]').each(function() {
           if ($(this).prop('checked') === true) {
                e.push($(this).attr('name'));
           }
        });
        var x = admin__cms__picker_application;
        var f = x.f;
        x.ex(f, window, e);
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
var admin__cms__picker_application = new admin__cms__picker_application__class();
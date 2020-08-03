/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin apps management class.
var admin__apps__management__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__apps__management;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a, v) {
        var x = admin__apps__management;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__apps__management__apps_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'management',
                fn: 'search',
                admin__apps__management__search_number: $('#admin__apps__management__search_number').val(),
                admin__apps__management__search_order: $('#admin__apps__management__search_order').val(),
                admin__apps__management__search_search: $('#admin__apps__management__search_search').val(),
                admin__apps__management__search_area: a,
                admin__apps__management__search_view: v,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__apps__management__apps_list').html(r).css('opacity', '1');
                var x = admin__apps__management;
                x.a = false;
            }
        });
    };

    // Action click.
    this.ac = function(a, el, id) {
        var x = admin__apps__management;
        if (x.a) {
            return;
        }
        x.id = id;
        x.el = el;
        $('#admin__apps__management__modal_' + a).modal('show');
    };

    // Action execute.
    this.ae = function(a, el, id) {
        var x = admin__apps__management;
        if (x.a) {
            return;
        }
        x.a = true;
        $('.modal').modal('hide');
        if (el === 0) {
            el = x.el;
        }
        if (id === 0) {
            id = x.id;
        }
        x.id = id;
        $('[data-type="admin__apps__management__ajax_error"]').remove();
        $('[data-type="admin__apps__management__ajax_confirm"]').remove();
        $(el).closest('[data-type="admin__apps__management__app"]').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'management',
                fn: a,
                admin__apps__management__id: id,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $(el).closest('[data-type="admin__apps__management__app"]').replaceWith(r);
                $('[data-type="admin__apps__management__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__apps__management__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                var x = admin__apps__management;
                x.a = false;
            }
        });
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__apps__management__app"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__apps__management__app"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__apps__management__app"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__apps__management__app"]').find('[data-nav="' + t + '"]').addClass('active');
    };
};
var admin__apps__management = new admin__apps__management__class();
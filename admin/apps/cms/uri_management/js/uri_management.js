/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms uri management class.
var admin__cms__uri_management__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__cms__uri_management;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a, v) {
        var x = admin__cms__uri_management;
        if (x.a) return;
        x.a = true;
        $('#admin__cms__uri_management__uris_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'uri_management',
                fn: 'search',
                admin__cms__uri_management__search_number: $('#admin__cms__uri_management__search_number').val(),
                admin__cms__uri_management__search_order: $('#admin__cms__uri_management__search_order').val(),
                admin__cms__uri_management__search_search: $('#admin__cms__uri_management__search_search').val(),
                admin__cms__uri_management__search_area: a,
                admin__cms__uri_management__search_view: v,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__uri_management__uris_list').html(r).css('opacity', '1');
                var x = admin__cms__uri_management;
                x.a = false;
            }
        });
    };

    // Add click.
    this.nc = function() {
        var x = admin__cms__uri_management;
        if (x.a) return;
        x.a = true;
        var p = '["' + $('#admin__cms__uri_management__uri').val() + '","' + $('#admin__cms__uri_management__title').val() + '","' + $('#admin__cms__uri_management__favicon').val() + '"]';
        $('.modal').modal('hide');
        $('#admin__cms__uri_management__uris_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'uri_management',
                fn: 'add',
                admin__cms__uri_management__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__uri_management__uris_list').html(r).css('opacity', '1');
                $('[data-type="admin__cms__uri_management__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__cms__uri_management__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                if ($('[data-type="admin__cms__uri_management__ajax_confirm"]').length) {
                    $('#admin__cms__uri_management__uri').val('');
                    $('#admin__cms__uri_management__title').val('');
                    $('#admin__cms__uri_management__favicon').val('');
                }
                $('html,body').scrollTop(0);
                var x = admin__cms__uri_management;
                x.a = false;
            }
        });
    };

    // Action click.
    this.ac = function(a, el, id) {
        var x = admin__cms__uri_management;
        if (x.a) return;
        x.id = id;
        x.el = el;
        $('#admin__cms__uri_management__modal_' + a).modal('show');
    };

    // Action execute.
    this.ae = function(a, el, id) {
        var x = admin__cms__uri_management;
        if (x.a) return;
        x.a = true;
        $('.modal').modal('hide');
        if (el === 0) el = x.el;
        if (id === 0) id = x.id;
        x.id = id;
        $('[data-type="admin__cms__uri_management__ajax_error"]').remove();
        $('[data-type="admin__cms__uri_management__ajax_confirm"]').remove();
        $(el).closest('[data-type="admin__cms__uri_management__uri"]').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'uri_management',
                fn: a,
                admin__cms__uri_management__id: id,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $(el).closest('[data-type="admin__cms__uri_management__uri"]').replaceWith(r);
                $('[data-type="admin__cms__uri_management__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__cms__uri_management__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                var x = admin__cms__uri_management;
                x.a = false;
            }
        });
    };
};
var admin__cms__uri_management = new admin__cms__uri_management__class();
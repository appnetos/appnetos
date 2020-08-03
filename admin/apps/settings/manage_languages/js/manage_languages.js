/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin settings manage languages class.
var admin__settings__manage_languages__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__settings__manage_languages;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__settings__manage_languages;
        if (x.a) return;
        x.a = true;
        $('#admin__settings__manage_languages__languages_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/settings',
                cl: 'manage_languages',
                fn: 'search',
                admin__settings__manage_languages__search_number: $('#admin__settings__manage_languages__search_number').val(),
                admin__settings__manage_languages__search_search: $('#admin__settings__manage_languages__search_search').val(),
                admin__settings__manage_languages__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__settings__manage_languages__languages_list').html(r).css('opacity', '1');
                var x = admin__settings__manage_languages;
                x.a = false;
            }
        });
    };

    // Action execute.
    this.ae = function(a, el, id) {
        var x = admin__settings__manage_languages;
        if (x.a) return;
        x.a = true;
        $('.modal').modal('hide');
        if (el === 0) el = x.el;
        if (id === 0) id = x.id;
        x.id = id;
        $('[data-type="admin__settings__manage_languages__ajax_error"]').remove();
        $('[data-type="admin__settings__manage_languages__ajax_confirm"]').remove();
        $(el).closest('[data-type="admin__settings__manage_languages__language"]').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/settings',
                cl: 'manage_languages',
                fn: a,
                admin__settings__manage_languages__parameters: id,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $(el).closest('[data-type="admin__settings__manage_languages__language"]').replaceWith(r);
                $('[data-type="admin__settings__manage_languages__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__settings__manage_languages__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                var x = admin__settings__manage_languages;
                x.a = false;
            }
        });
    };

    // Deactivate click.
    this.dc = function(el, id) {
        var x = admin__settings__manage_languages;
        x.id = id;
        x.el = el;
        $('#admin__settings__manage_languages__modal_deactivate').modal('show');
    };

    // Deactivate execute.
    this.de = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__settings__manage_languages;
            x.ae('deactivate', x.el, x.id);
        }, 550);
    }
};
var admin__settings__manage_languages = new admin__settings__manage_languages__class();
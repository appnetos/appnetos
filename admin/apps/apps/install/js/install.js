/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin apps install class.
var admin__apps__install__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__apps__install;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__apps__install;
        if (x.a) return;
        x.a = true;
        $('#admin__apps__install__apps_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'install',
                fn: 'search',
                admin__apps__installer__search_number: $('#admin__apps__install__search_number').val(),
                admin__apps__installer__search_search: $('#admin__apps__install__search_search').val(),
                admin__apps__installer__search_area: a,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__apps__install__apps_list').html(r).css('opacity', '1');
                var x = admin__apps__install;
                x.a = false;
            }
        });
    };

    // Install execute.
    this.ie = function(el, d) {
        var x = admin__apps__install;
        if (x.a) return;
        x.a = true;
        $('[data-type="admin__apps__install__ajax_error"]').remove();
        $('[data-type="admin__apps__install__ajax_confirm"]').remove();
        $(el).closest('[data-type="admin__apps__install__app"]').css('opacity', '0.65');
        x.el = el;
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'install',
                fn: 'install',
                admin__apps__installer__directory: d,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__apps__install;
                var el = x.el;
                $(el).closest('[data-type="admin__apps__install__app"]').replaceWith(r);
                $('[data-type="admin__apps__install__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__apps__install__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                x.a = false;
            }
        });
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__apps__install__app"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__apps__install__app"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__apps__install__app"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__apps__install__app"]').find('[data-nav="' + t + '"]').addClass('active');
    };

    // Show hide description.
    this.sh = function(ev, el) {
        ev.preventDefault();
        var d = $(el).parent().prev();
        if($(d).hasClass('admin__apps__install__description_hide')) {
            $(d).removeClass('admin__apps__install__description_hide').addClass('admin__apps__install__description_show');
            $(el).html($(el).attr('data-text-hide') + '&nbsp;<i class="fas fa-caret-up"></i>');
        } else {
            $(d).removeClass('admin__apps__install__description_show').addClass('admin__apps__install__description_hide');
            $(el).html($(el).attr('data-text-show') + '&nbsp;<i class="fas fa-caret-down"></i>');
        }
    };
};
var admin__apps__install = new admin__apps__install__class();
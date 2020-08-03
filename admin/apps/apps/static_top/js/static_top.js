/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin apps static top class.
var admin__apps__static_top__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached function.
    this.f = null;

    // Action execute.
    this.ex = function(ev, f, id, p) {
        if(ev !== 0) {
            ev.preventDefault();
        }
        var x = admin__apps__static_top;
        if (x.a) return;
        x.a = true;
        x.f = f;
        $('[data-type="admin__apps__static_top__ajax_error"]').remove();
        $('[data-type="admin__apps__static_top__ajax_confirm"]').remove();
        $('#admin__apps__static_top__apps_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/apps',
                cl: 'static_top',
                fn: f,
                admin__apps__static_top__id: id,
                admin__apps__static_top__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__apps__static_top__apps_list').html(r).css('opacity', '1');
                $('[data-type="admin__apps__static_top__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__apps__static_top__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                var x = admin__apps__static_top;
                if (x.f === 'add' || x.f === 'remove') {
                    $('html,body').scrollTop(0);
                }
                x.a = false;
            }
        });
    };

    // Change view.
    this.se = function(v) {
        var x = admin__apps__static_top;
        x.ex(0, 'search', null, v);
    };

    // Add click.
    this.ac = function(ev) {
        ev.preventDefault();
        admin__apps__picker.pick('admin__apps__static_top.ae');
    };

    // Add execute.
    this.ae = function(id) {
        var x = admin__apps__static_top;
        x.ex(0, 'add', id, 0);
    };
};
var admin__apps__static_top = new admin__apps__static_top__class();
/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms manage apps.
var admin__cms__manage_apps__class = function() {

    // If is AJAx request.
    this.a = false;

    // Add click.
    this.nc = function(ev) {
        ev.preventDefault();
        admin__apps__picker.pick('admin__cms__manage_apps.ne');
    };

    // Add execute.
    this.ne = function(p) {
        var x = admin__cms__manage_apps;
        x.la('add', p);
    };

    // Move click.
    this.mc = function(i, s) {
        var x = admin__cms__manage_apps;
        var p = '["' + i + '","' + s + '"]';
        x.la('move', p);
    };

    // Change view.
    this.se = function(v) {
        var x = admin__cms__manage_apps;
        x.la('search', v);
    };

    // Apps list execute.
    this.la = function(a, p) {
        var x = admin__cms__manage_apps;
        if (x.a) return;
        x.a = true;
        $('.modal').modal('hide');
        $('[data-type="admin__cms__manage_apps__ajax_error"]').remove();
        $('[data-type="admin__cms__manage_apps__ajax_confirm"]').remove();
        $('#admin__cms__manage_apps__apps_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'manage_apps',
                fn: a,
                admin__cms__manage_apps__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__manage_apps__apps_list').html(r).css('opacity', '1');
                $('[data-type="admin__cms__manage_apps__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__cms__manage_apps__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                $('html,body').scrollTop(0);
                var x = admin__cms__manage_apps;
                x.a = false;
            }
        });
    };
};
var admin__cms__manage_apps = new admin__cms__manage_apps__class();
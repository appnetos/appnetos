/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin dashboard dashboard class.
var admin__dashboard__dashboard__class = function() {

    // If is AJAX request.
    this.a = false;

    // Cached function.
    this.fn = null;

    // Cached element.
    this.el = null;

    // Cached ID.
    this.id = null;

    // Execute AJAX.
    this.ax = function(fn, p, el) {
        var x = admin__dashboard__dashboard;
        if (x.a) {
            return;
        }
        x.a = true;
        x.fn = fn;
        $('.modal').modal('hide');
        $('[data-type="admin__dashboard__dashboard__ajax_error"]').remove();
        $('[data-type="admin__dashboard__dashboard__ajax_confirm"]').remove();
        if (el === null) {
            $('#admin__dashboard__dashboard__template').css('opacity', '0.65');
        } else {
            x.el = el;
            $(el).css('opacity', '0.65');
        }
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/dashboard',
                cl: 'dashboard__model',
                fn: fn,
                admin__dashboard__dashboard__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__dashboard__dashboard;
                if (x.fn === 'createDashboard' || x.fn === 'editDashboardName' || x.fn === 'removeDashboard') {
                    if (r.length === 36) {
                        window.location.reload();
                        return;
                    }
                }
                if (x.el === null) {
                    $('#admin__dashboard__dashboard__template').html(r).css('opacity', '1');
                }
                else {
                    var el = x.el;
                    $(el).replaceWith(r);
                    x.el = null;
                }
                $('[data-type="admin__dashboard__dashboard__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__dashboard__dashboard__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                x.fn = null;
                x.a = false;
            }
        });
    };

    // Create dashboard.
    this.cd = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__dashboard__dashboard;
            var p = $('#admin__dashboard__dashboard__create_name').val();
            x.ax('createDashboard', p, null);
        }, 550);
    };

    // Create dashboard keypress.
    this.ck = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__dashboard__dashboard;
            x.cd();
        }
    };

    // Add widget.
    this.aw = function(ev) {
        ev.preventDefault();
        admin__widgets__picker.pick('admin__dashboard__dashboard.ac');
    };

    // Add widget click.
    this.ac = function(id) {
        var x = admin__dashboard__dashboard;
        x.id = id;
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__dashboard__dashboard;
            var p = x.id;
            x.ax('addWidget', p, null);
        }, 550);
    };

    // Edit dashboard name.
    this.en = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__dashboard__dashboard;
            var p = $('#admin__dashboard__dashboard__edit_name_name').val();
            x.ax('editDashboardName', p, null);
        }, 550);
    };

    // Edit dashboard name keypress.
    this.ec = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__dashboard__dashboard;
            x.cd();
        }
    };
};
var admin__dashboard__dashboard = new admin__dashboard__dashboard__class();
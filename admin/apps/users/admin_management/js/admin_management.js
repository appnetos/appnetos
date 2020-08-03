/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms edit uri.
var admin__users__admin_management__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached user ID.
    this.i = null;

    // Cached parameters.
    this.p = null;

    // Cached function.
    this.f = null;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__users__admin_management;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a, v) {
        var x = admin__users__admin_management;
        if (x.a) return;
        x.a = true;
        $('#admin__users__admin_management__users_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/users',
                cl: 'admin_management',
                fn: 'search',
                admin__users__admin_management__search_number: $('#admin__users__admin_management__search_number').val(),
                admin__users__admin_management__search_order: $('#admin__users__admin_management__search_order').val(),
                admin__users__admin_management__search_selection: $('#admin__users__admin_management__search_selection').val(),
                admin__users__admin_management__search_search: $('#admin__users__admin_management__search_search').val(),
                admin__users__admin_management__search_area: a,
                admin__users__admin_management__search_view: v,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__users__admin_management__users_list').html(r).css('opacity', '1');
                $('html,body').scrollTop(0);
                var x = admin__users__admin_management;
                x.a = false;
            }
        });
    };

    // Action execute.
    this.ae = function(f, p, el) {
        var x = admin__users__admin_management;
        if (x.a) return;
        x.a = true;
        $('.modal').modal('hide');
        x.el = el;
        x.f = f;
        $('[data-type="admin__users__admin_management__ajax_error"]').remove();
        $('[data-type="admin__users__admin_management__ajax_confirm"]').remove();
        if (el === 0) {
            $('#admin__users__admin_management__users_list').css('opacity', '0.65');
        }
        else {
            $(el).css('opacity', '0.65');
        }
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/users',
                cl: 'admin_management',
                fn: f,
                admin__users__admin_management__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__users__admin_management;
                var el = x.el;
                if (el === 0) {
                    $('#admin__users__admin_management__users_list').html(r).css('opacity', '1');
                    $('html,body').scrollTop(0);
                }
                else {
                    $(el).replaceWith(r);
                }
                $('[data-type="admin__users__admin_management__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__users__admin_management__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                if (x.f === 'add') {
                    if ($('[data-type="admin__users__admin_management__ajax_confirm"]').length) {
                        x.ar();
                    }
                }
                x.a = false;
            }
        });
    };

    // Edit click.
    this.ec = function(el, i) {
        var x = admin__users__admin_management;
        if (x.a) {
            return;
        }
        x.a = true;
        var el = $(el).closest('[data-type="admin__users__admin_management__user"]');
        x.el = el;
        $(el).css('opacity', '0.65');
        $('[data-type="admin__users__admin_management__ajax_error"]').remove();
        $('[data-type="admin__users__admin_management__ajax_confirm"]').remove();
        var form = $('#form_edit_' + i)[0];
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(r) {
                var x = admin__users__admin_management;
                var el = x.el;
                $(el).replaceWith(r);
                $('[data-type="admin__users__admin_management__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__users__admin_management__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                x.a = false;
            }
        });
    };

    // Add click.
    this.ac = function() {
        var x = admin__users__admin_management;
        $('.modal').modal('hide');
        var p = $('[data-type="form_add_user"] *').serializeArray();
        x.p = p;
        setTimeout(function() {
            var x = admin__users__admin_management;
            x.ae('add', x.p, 0);
        }, 550);
    };

    // Add reset.
    this.ar = function() {
        $('#admin__users__admin_management__add_min_user').prop( "checked", false );
        $('#admin__users__admin_management__add_min_pass').prop( "checked", false );
        $('#admin__users__admin_management__add_user').val('');
        $('#admin__users__admin_management__add_mail').val('');
        $('#admin__users__admin_management__add_pass').val('');
    };

    // Lock click.
    this.lc = function(el, i) {
        var x = admin__users__admin_management;
        x.el = $(el).closest('[data-type="admin__users__admin_management__user"]');
        x.i = i;
        $('#admin__users__admin_management__modal_lock').modal('show');
    };

    // Lock execute.
    this.le = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__users__admin_management;
            x.ae('lock', x.i, x.el);
        }, 550);
    };

    // Delete click.
    this.dc = function(el, i) {
        var x = admin__users__admin_management;
        x.i = i;
        $('#admin__users__admin_management__modal_delete').modal('show');
    };

    // Delete execute.
    this.de = function() {
        var x = admin__users__admin_management;
        $('.modal').modal('hide');
        x.p = '["' + x.i + '"]';
        setTimeout(function() {
            var x = admin__users__admin_management;
            x.ae('delete', x.p, 0);
        }, 550);
    };

    // Activate execute.
    this.te = function(el, i) {
        var x = admin__users__admin_management;
        el = $(el).closest('[data-type="admin__users__admin_management__user"]');
        x.ae('activate', i, el);
    };

    // Administrator group click.
    this.ug = function(el) {
        var x = admin__users__admin_management;
        x.el = el;
        admin__groups__picker_admin.pick('admin__users__admin_management.ugc');
    };

    // Administrator group click callback.
    this.ugc = function(i) {
        var x = admin__users__admin_management;
        var el = x.el;
        $(el).val(i);
    };

    // Group trash click.
    this.dg = function(el) {
        $(el).prev().val('0');
    };

    // Show hide passwords.
    this.sh = function (el, h) {
        if ($(el).prev().attr('type') === 'password') {
            $(el).prev().attr('type', 'text').next().find('img').attr('src', h + '/out/admin/img/appnetos/eye_close.svg');
        }
        else{
            $(el).prev().attr('type', 'password').next().find('img').attr('src', h + '/out/admin/img/appnetos/eye_open.svg');
        }
    };

    // On input.
    this.oi = function(el) {
        var e = $(el);
        var n = e.val();
        n = n.replace(/\\/g, '/');
        var a = n.split('/');
        var v = a[a.length - 1];
        e.next('.custom-file-label').html(v);
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__users__admin_management__user"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__users__admin_management__user"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__users__admin_management__user"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__users__admin_management__user"]').find('[data-nav="' + t + '"]').addClass('active');
    };
};
var admin__users__admin_management = new admin__users__admin_management__class();
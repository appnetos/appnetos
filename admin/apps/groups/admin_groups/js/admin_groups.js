/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin groups admin groups.
var admin__groups__admin_groups__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached group ID.
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
            var x = admin__groups__admin_groups;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a, v) {
        var x = admin__groups__admin_groups;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__groups__admin_groups__groups_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/groups',
                cl: 'admin_groups',
                fn: 'search',
                admin__groups__admin_groups__search_number: $('#admin__groups__admin_groups__search_number').val(),
                admin__groups__admin_groups__search_order: $('#admin__groups__admin_groups__search_order').val(),
                admin__groups__admin_groups__search_search: $('#admin__groups__admin_groups__search_search').val(),
                admin__groups__admin_groups__search_area: a,
                admin__groups__admin_groups__search_view: v,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__groups__admin_groups__groups_list').html(r).css('opacity', '1');
                $('html,body').scrollTop(0);
                var x = admin__groups__admin_groups;
                x.a = false;
            }
        });
    };

    // Action execute.
    this.ae = function(f, p, el) {
        var x = admin__groups__admin_groups;
        if (x.a) {
            return;
        }
        x.a = true;
        $('.modal').modal('hide');
        x.el = el;
        x.f = f;
        $('[data-type="admin__groups__admin_groups__ajax_error"]').remove();
        $('[data-type="admin__groups__admin_groups__ajax_confirm"]').remove();
        if (el === 0) {
            $('#admin__groups__admin_groups__groups_list').css('opacity', '0.65');
        }
        else {
            $(el).css('opacity', '0.65');
        }
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/groups',
                cl: 'admin_groups',
                fn: f,
                admin__groups__admin_groups__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__groups__admin_groups;
                var el = x.el;
                if (el === 0) {
                    $('#admin__groups__admin_groups__groups_list').html(r).css('opacity', '1');
                    $('html,body').scrollTop(0);
                }
                else {
                    $(el).replaceWith(r);
                }
                $('[data-type="admin__groups__admin_groups__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__groups__admin_groups__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                if (x.f === 'add') {
                    if ($('[data-type="admin__groups__admin_groups__ajax_confirm"]').length) {
                        $('#admin__groups__admin_groups__name').val('');
                    }
                }
                x.a = false;
            }
        });
    };

    // Add keydown.
    this.ak = function(ev) {
        if (ev.keyCode == 13) {
            admin__groups__admin_groups.ac(0);
        }
    };

    // Add click.
    this.ac = function() {
        var x = admin__groups__admin_groups;
        $('.modal').modal('hide');
        var p = $('#admin__groups__admin_groups__name').val();
        x.p = p;
        setTimeout(function() {
            var x = admin__groups__admin_groups;
            x.ae('add', x.p, 0);
        }, 550);
    };

    // Edit click.
    this.ed = function(el, i) {
        var x = admin__groups__admin_groups;
        var n = $('[data-type="group_name"][data-group-id="' + i + '"]').val();
        if (n) {
            x.el = $(el).closest('[data-type="admin__groups__admin_groups__group"]');
            var p = {
                'id': i,
                'name': n
            };
            x.ae('edit', p, x.el);
        }
    };

    // Set as default click.
    this.sd = function(i) {
        var x = admin__groups__admin_groups;
        var p = {
            'id': i
        };
        x.ae('setDefault', p, 0);
    };

    // Add granted click.
    this.ag = function(el, i) {
        var x = admin__groups__admin_groups;
        x.i = i;
        x.el = $(el).closest('[data-type="admin__groups__admin_groups__group"]');
        var d = $('[data-type="used_array"][data-id="' + i + '"]').html();
        var e = JSON.parse(d);
        admin__cms__picker_admin.pick('admin__groups__admin_groups.agc', e);
    };

    // Add granted callback.
    this.agc = function(a) {
        if (!a.length) {
            return;
        }
        var x = admin__groups__admin_groups;
        var p = {
            'id': x.i,
            'add': a
        };
        x.p = p;
        setTimeout(function() {
            var x = admin__groups__admin_groups;
            x.ae('addGranted', x.p, x.el);
        }, 550);
    };

    // Remove granted click.
    this.rg = function(el, g) {
        var x = admin__groups__admin_groups;
        var a = [];
        $('[data-type="granted"][data-group-id="' + g + '"]').each(function() {
            if ($(this).prop('checked') === true) {
                a.push($(this).attr('name'));
            }
        });
        if (a.length) {
            var p = {
                'id': g,
                'remove': a
            };
            x.el = $(el).closest('[data-type="admin__groups__admin_groups__group"]');
            x.ae('removeGranted', p, x.el);
        }
    };

    // Remove denied click.
    this.rd = function(el, g) {
        var x = admin__groups__admin_groups;
        var a = [];
        $('[data-type="denied"][data-group-id="' + g + '"]').each(function() {
            if ($(this).prop('checked') === true) {
                a.push($(this).attr('name'));
            }
        });
        if (a.length) {
            var p = {
                'id': g,
                'remove': a
            };
            x.el = $(el).closest('[data-type="admin__groups__admin_groups__group"]');
            x.ae('removeDenied', p, x.el);
        }
    };

    // Add denied click.
    this.ad = function(el, i) {
        var x = admin__groups__admin_groups;
        x.i = i;
        x.el = $(el).closest('[data-type="admin__groups__admin_groups__group"]');
        var d = $('[data-type="used_array"][data-id="' + i + '"]').html();
        var e = JSON.parse(d);
        admin__cms__picker_admin.pick('admin__groups__admin_groups.adc', e);
    };

    // Add denied callback.
    this.adc = function(a) {
        if (!a.length) {
            return;
        }
        var x = admin__groups__admin_groups;
        var p = {
            'id': x.i,
            'add': a
        };
        x.p = p;
        setTimeout(function() {
            var x = admin__groups__admin_groups;
            x.ae('addDenied', x.p, x.el);
        }, 550);
    };

    // Check URI.
    this.ch = function(g, k, t) {
        var e = $('[data-type="' + t + '"][data-group-id="' + g + '"][name="' + k + '"]');
        if ($(e).prop('checked') === true) {
            $(e).prop('checked', false);
        } else {
            $(e).prop('checked', true);
        }
        var a = true;
        $('[data-type="' + t + '"][data-group-id="' + g + '"]').each(function() {
            if ($(this).prop('checked') === false) {
                a = false;
            }
        });
        if (a) {
            $('[data-type="' + t + '_all"][data-group-id="' + g + '"]').prop('checked', true);
        } else {
            $('[data-type="' + t + '_all"][data-group-id="' + g + '"]').prop('checked', false);
        }
    };

    // Check all URIs.
    this.cha = function(e, g, t) {
        var c = false;
        $('[data-type="' + t + '"][data-group-id="' + g + '"]').each(function() {
            if ($(this).prop('checked') === false) {
                c = true;
            }
        });
        if (c) {
            $('[data-type="' + t + '"][data-group-id="' + g + '"]').prop('checked', true);
            $(e).prop('checked', true);
        } else {
            $('[data-type="' + t + '"][data-group-id="' + g + '"]').prop('checked', false);
            $(e).prop('checked', false);
        }
    };

    // Delete click.
    this.dc = function(el, i) {
        var x = admin__groups__admin_groups;
        x.i = i;
        $('#admin__groups__admin_groups__modal_delete').modal('show');
    };

    // Delete execute.
    this.de = function() {
        var x = admin__groups__admin_groups;
        $('.modal').modal('hide');
        x.p = {
            'id': x.i
        };
        setTimeout(function() {
            var x = admin__groups__admin_groups;
            x.ae('delete', x.p, 0);
        }, 550);
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__groups__admin_groups__group"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__groups__admin_groups__group"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__groups__admin_groups__group"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__groups__admin_groups__group"]').find('[data-nav="' + t + '"]').addClass('active');
    };
};
var admin__groups__admin_groups = new admin__groups__admin_groups__class();
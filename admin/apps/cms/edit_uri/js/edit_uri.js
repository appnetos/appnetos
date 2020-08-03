/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin cms edit uri.
var admin__cms__edit_uri__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached parameters.
    this.p = null;

    // Cached element.
    this.el = null;

    // Action URI click.
    this.ac = function(a, el, p) {
        var x = admin__cms__edit_uri;
        if (x.a) {
            return;
        }
        x.p = p;
        x.el = el;
        $('#admin__cms__edit_uri__modal_' + a).modal('show');
    };

    // Edit URI click.
    this.ec = function(el, id) {
        var x = admin__cms__edit_uri;
        var p = $('form[data-type="form_uri"][data-uri-id="' + id + '"]').serializeArray();
        x.ae('editUri', el, p);
    };

    // Clear meta tag.
    this.cm = function(id, i) {
        $('[data-type="meta_name_tag"][data-uri-id="' + id + '"][data-meta-id="' + i + '"').val('name');
        $('[data-type="meta_name"][data-uri-id="' + id + '"][data-meta-id="' + i + '"').val('');
        $('[data-type="meta_content_tag"][data-uri-id="' + id + '"][data-meta-id="' + i + '"').val('content');
        $('[data-type="meta_content"][data-uri-id="' + id + '"][data-meta-id="' + i + '"').val('');
    };

    // Edit meta tags.
    this.em = function(el, id) {
        var x = admin__cms__edit_uri;
        var p = $('form[data-type="form_meta"][data-uri-id="' + id + '"]').serializeArray();
        x.ae('editMeta', el, p);
    };

    // Add click.
    this.nc = function() {
        var x = admin__cms__edit_uri;
        $('.modal').modal('hide');
        var p = '[" ' + $('#admin__cms__edit_uri__add_language').val() + '"," ' + $('#admin__cms__edit_uri__add_uri').val() + '"," ' + $('#admin__cms__edit_uri__add_title').val() + '"," ' + $('#admin__cms__edit_uri__add_favicon').val() + '"]';
        x.p = p;
        setTimeout(function() {
            var x = admin__cms__edit_uri;
            x.ne('add', x.p);
        }, 550);
    };

    // Remove click.
    this.dc = function(p) {
        var x = admin__cms__edit_uri;
        x.p = p;
        $('#admin__cms__edit_uri__modal_remove').modal('show');
    };

    // Remove execute.
    this.de = function() {
        var x = admin__cms__edit_uri;
        var p = x.p;
        x.ne('remove', p);
    };

    // URI execute.
    this.ae = function(a, el, p) {
        var x = admin__cms__edit_uri;
        if (x.a) {
            return;
        }
        x.a = true;
        $('.modal').modal('hide');
        if (el === 0) el = x.el;
        if (p === 0) p = x.p;
        x.p = p;
        $('[data-type="admin__cms__edit_uri__ajax_error"]').remove();
        $('[data-type="admin__cms__edit_uri__ajax_confirm"]').remove();
        $(el).closest('[data-type="admin__cms__edit_uri__uri"]').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'edit_uri',
                fn: a,
                admin__cms__edit_uri__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $(el).closest('[data-type="admin__cms__edit_uri__uri"]').replaceWith(r);
                $('[data-type="admin__cms__edit_uri__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__cms__edit_uri__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                var x = admin__cms__edit_uri;
                x.a = false;
            }
        });
    };

    // URIs list execute.
    this.ne = function(a, p) {
        var x = admin__cms__edit_uri;
        if (x.a) {
            return;
        }
        x.a = true;
        $('.modal').modal('hide');
        $('[data-type="admin__cms__edit_uri__ajax_error"]').remove();
        $('[data-type="admin__cms__edit_uri__ajax_confirm"]').remove();
        $('#admin__cms__edit_uri__uris_list').css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/cms',
                cl: 'edit_uri',
                fn: a,
                admin__cms__edit_uri__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                $('#admin__cms__edit_uri__uris_list').html(r).css('opacity', '1');
                $('[data-type="admin__cms__edit_uri__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__cms__edit_uri__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                if ($('[data-type="admin__cms__edit_uri__ajax_confirm"]').length) {
                    $('#admin__cms__edit_uri__add_language').val('');
                    $('#admin__cms__edit_uri__add_uri').val('');
                    $('#admin__cms__edit_uri__add_title').val('');
                    $('#admin__cms__edit_uri__add_favicon').val('');
                }
                $('html,body').scrollTop(0);
                var x = admin__cms__edit_uri;
                x.a = false;
            }
        });
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__cms__edit_uri__uri"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__cms__edit_uri__uri"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__cms__edit_uri__uri"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__cms__edit_uri__uri"]').find('[data-nav="' + t + '"]').addClass('active');
    };
};
var admin__cms__edit_uri = new admin__cms__edit_uri__class();
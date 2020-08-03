/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin settings languages.
var admin__settings__languages__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached element.
    this.el = null;

    // Action execute.
    this.ae = function(f, p, el) {
        var x = admin__settings__languages;
        if (x.a) return;
        x.a = true;
        x.el = el;
        $('[data-type="admin__settings__languages__ajax_error"]').remove();
        $('[data-type="admin__settings__languages__ajax_confirm"]').remove();
        $(el).css('opacity', '0.65');
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/settings',
                cl: 'languages',
                fn: f,
                admin__settings__languages__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__settings__languages;
                var el = x.el;
                $(el).replaceWith(r);
                $('[data-type="admin__settings__languages__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__settings__languages__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                x.a = false;
            }
        });
    };

    // Edit click.
    this.ec = function(el, i) {
        var x = admin__settings__languages;
        var e = $(el).closest('[data-type="edit"]');
        var p = '["' + i + '","' + $(e).find('[data-type="admin__settings__languages__title"]').val() + '","' + $(e).find('[data-type="admin__settings__languages__favicon"]').val() + '"]';
        el = $(el).closest('[data-type="admin__settings__languages__language"]');
        x.ae('edit', p, el);
    };

    // Default click.
    this.dc = function(el, p) {
        var x = admin__settings__languages;
        el = $(el).closest('[data-type="admin__settings__languages__language"]');
        x.ae('default', p, el);
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__settings__languages__language"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__settings__languages__language"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__settings__languages__language"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__settings__languages__language"]').find('[data-nav="' + t + '"]').addClass('active');
    };
};
var admin__settings__languages = new admin__settings__languages__class();
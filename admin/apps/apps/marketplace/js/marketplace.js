/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin apps marketplace class.
var admin__apps__marketplace__class = function() {

    // If is AJAx request.
    this.a = false;

    // Cached ID.
    this.id = null;

    // Cached element.
    this.el = null;

    // Search keydown.
    this.sk = function(ev) {
        if (ev.keyCode == 13) {
            var x = admin__apps__marketplace;
            x.se(0);
        }
    };

    // Search execute.
    this.se = function(a) {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        x.a = true;
        var data = {
            number: $('#admin__apps__marketplace__search_number').val(),
            order: $('#admin__apps__marketplace__search_order').val(),
            search: $('#admin__apps__marketplace__search_search').val(),
            category: $('#admin__apps__marketplace__search_category').val(),
            area: a,
        }
        appnetos.ajaxJson('admin/apps', 'marketplace', 'search', 'admin__apps__marketplace.sec', data);
    };
    // Search execute callback.
    this.sec = function(r) {
        if (typeof r.menu_user !== 'undefined') {
            $('#admin__apps__marketplace__menu_user').html(r.menu_user);
        }
        if (typeof r.apps_list !== 'undefined') {
            $('#admin__apps__marketplace__apps_list').html(r.apps_list).css('opacity', '1');
        }
        var x = admin__apps__marketplace;
        x.a = false;
        x.events();
    };

    // Sign in.
    this.si = function() {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxForm('admin/apps', 'marketplace', 'signIn', 'admin__apps__marketplace.sic', 'admin__apps__marketplace__form_sign_in');
    };
    // Sign in callback.
    this.sic = function(r) {
        var x = admin__apps__marketplace;
        if (typeof r.error !== 'undefined') {
            if (r.error) {
                $('#admin__apps__marketplace__error_sign_in').html(r.error).show();
            }
        }
        if (typeof r.menu_user !== 'undefined') {
            window.location = window.location.href;
        }
        x.a = false;
    };

    // Sign out.
    this.so = function(e) {
        e.preventDefault();
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        x.a = true;
        appnetos.ajaxJson('admin/apps', 'marketplace', 'signOut', 'admin__apps__marketplace.soc', {});
    };
    // Sign out callback.
    this.soc = function(r) {
        var x = admin__apps__marketplace;
        window.location = window.location.href;
        x.a = false;
    };

    // Select downloads area.
    this.sd = function(area){
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        $('#admin__apps__marketplace__apps_list').css('opacity', '0.65');
        appnetos.ajaxJson('admin/apps', 'marketplace', 'getDownloadsByArea', 'admin__apps__marketplace.sdc', {area});
    };
    // Select downloads area callback.
    this.sdc = function(r){
        if (typeof r.menu_user !== 'undefined') {
            $('#admin__apps__marketplace__menu_user').html(r.menu_user);
        }
        if (typeof r.apps_list !== 'undefined') {
            $('#admin__apps__marketplace__apps_list').html(r.apps_list).css('opacity', '1');
        }
        var x = admin__apps__marketplace;
        x.a = false;
        x.events();
    };

    // Edit cart.
    this.ec = function() {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        x.a = true;
        $('#admin__apps__marketplace__cart').css('opacity', '0.65');
        appnetos.ajaxForm('admin/apps', 'marketplace', 'editCart', 'admin__apps__marketplace.rcc', 'admin__apps__marketplace__cart_form');
    };
    // Edit cart callback.
    this.ecc = function(r) {
        var x = admin__apps__marketplace;
        $('#admin__apps__marketplace__menu_user').html(r.user);
        $('#admin__apps__marketplace__cart').html(r.cart);
        $('#admin__apps__marketplace__cart').css('opacity', '1');
        x.a = false;
        x.events();
    };

    // Remove from cart.
    this.rc = function(data) {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        $('#admin__apps__marketplace__cart').css('opacity', '0.65');
        appnetos.ajaxJson('admin/apps', 'marketplace', 'removeFromCart', 'admin__apps__marketplace.rcc', {data});
    };
    // Remove from cart callback.
    this.rcc = function(r) {
        var x = admin__apps__marketplace;
        $('#admin__apps__marketplace__menu_user').html(r.user);
        $('#admin__apps__marketplace__cart').html(r.cart);
        $('#admin__apps__marketplace__cart').css('opacity', '1');
        x.a = false;
        x.events();
    };

    // Add to cart.
    this.ac = function(data) {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        $('#admin__apps__marketplace__apps_list').css('opacity', '0.65');
        appnetos.ajaxJson('admin/apps', 'marketplace', 'addToCart', 'admin__apps__marketplace.acc', {data});
    };
    // Add to cart callback.
    this.acc = function(r) {
        var x = admin__apps__marketplace;
        $('#admin__apps__marketplace__menu_user').html(r.user);
        $('#admin__apps__marketplace__apps_list').html(r.apps_list);
        $('#admin__apps__marketplace__apps_list').css('opacity', '1');
        x.a = false;
        x.events();
    };

    // Install.
    this.in = function(data) {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        var m = $('#admin__apps__marketplace__modal_' + data);
        x.el = m;
        $(m).find("[data-type='element-text']").hide();
        $(m).find("[data-type='element-loading']").show();
        $(m).find("[data-type='button-close']").attr('disabled', true);
        appnetos.ajaxJson('admin/apps', 'marketplace', 'install', 'admin__apps__marketplace.inc', {data});
    };

    // Update.
    this.up = function(data) {
        var x = admin__apps__marketplace;
        if (x.a) {
            return;
        }
        var m = $('#admin__apps__marketplace__modal_' + data);
        x.el = m;
        $(m).find("[data-type='element-text']").hide();
        $(m).find("[data-type='element-loading']").show();
        $(m).find("[data-type='button-close']").attr('disabled', true);
        appnetos.ajaxJson('admin/apps', 'marketplace', 'update', 'admin__apps__marketplace.inc', {data});
    };

    // Install or update callback.
    this.inc = function(r) {
        var x = admin__apps__marketplace;
        var m = x.el;
        if (typeof r.error !== 'undefined') {
            $(m).find("[data-type='element-loading']").hide();
            $(m).find("[data-type='element-error']").find('.alert').html(r.error);
            $(m).find("[data-type='element-error']").show();
        } else {
            $(m).find("[data-type='element-loading']").hide();
            $(m).find("[data-type='element-success']").show();
        }
        x.a = false;
        x.events();
    };

    // Self link.
    this.ln = function() {
        location.href = window.location.href;
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__apps__marketplace__app"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__apps__marketplace__app"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__apps__marketplace__app"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__apps__marketplace__app"]').find('[data-nav="' + t + '"]').addClass('active');
    };

    // Set events.
    this.events = function() {

        // Images gallery.
        $('[data-thumb-id]').mouseover(function () {
            var c = $(this).attr('data-thumb-id');
            var s = $(this).attr('data-image');
            $('[data-image-id="' + c + '"]').attr('src', s);
        });
        $('[data-thumb-id]').mouseout(function () {
            var c = $(this).attr('data-thumb-id');
            $('[data-image-id="' + c + '"]').attr('src', $('[data-image-id="' + c + '"]').attr('data-image'));
        });

        // Select version and license.
        $('[data-select="version_and_license"]').change(function () {
            var c = $(this).attr('data-id');
            var i = $(this).children("option:selected").val();
            $('[data-div="version_and_license"][data-id="' + c + '"]').addClass('d-none');
            $('[data-div="version_and_license"][data-id="' + c + '"][data-index="' + i + '"]').removeClass('d-none');
        });
    }
    $(document).ready(function () {
        var x = admin__apps__marketplace;
        x.events();
    });
};
var admin__apps__marketplace = new admin__apps__marketplace__class();
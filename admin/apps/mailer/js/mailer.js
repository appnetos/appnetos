/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Admin settings system class.
var admin__mailer__mailer__class = function() {

    // If is AJAX request.
    this.a = false;

    // Cached function.
    this.fn = null;

    // Cached element.
    this.el = null;

    // Cached UUID.
    this.uuid = null;

    // Execute AJAX.
    this.ax = function(fn, p, el) {
        var x = admin__mailer__mailer;
        if (x.a) return;
        x.a = true;
        x.fn = fn;
        $('.modal').modal('hide');
        $('[data-type="admin__mailer__mailer__ajax_error"]').remove();
        $('[data-type="admin__mailer__mailer__ajax_confirm"]').remove();
        if (el === null) {
            $('#admin__mailer__mailer__template').css('opacity', '0.65');
        } else {
            x.el = el;
            $(el).css('opacity', '0.65');
        }
        $.ajax({
            type: 'POST',
            data: {
                ns: 'admin/mailer',
                cl: 'mailer__model',
                fn: fn,
                admin__mailer__mailer__parameters: p,
                aid: $('[data-ajax-id]').data('ajax-id'),
            },
            success: function(r) {
                var x = admin__mailer__mailer;
                if (x.el === null) {
                    $('#admin__mailer__mailer__template').html(r).css('opacity', '1');
                }
                else {
                    var el = x.el;
                    $(el).replaceWith(r);
                    x.el = null;
                }
                $('[data-type="admin__mailer__mailer__ajax_error"]').removeClass('d-none').hide().fadeIn();
                $('[data-type="admin__mailer__mailer__ajax_confirm"]').removeClass('d-none').hide().fadeIn();
                if (x.fn === 'addMailbox') {
                    if ($('[data-type="admin__mailer__mailer__ajax_confirm"]').length) {
                        x.rm();
                    }
                }
                x.fn = null;
                x.st();
                x.a = false;
            }
        });
    };

    // New mailbox click.
    this.nm = function() {
        var x = admin__mailer__mailer;
        var p = {};
        p.admin__mailer__mailer__mailboxes__add_name = $('#admin__mailer__mailer__mailboxes__add_name').val();
        p.admin__mailer__mailer__mailboxes__add_address = $('#admin__mailer__mailer__mailboxes__add_address').val();
        p.admin__mailer__mailer__mailboxes__add_host = $('#admin__mailer__mailer__mailboxes__add_host').val();
        p.admin__mailer__mailer__mailboxes__add_port = $('#admin__mailer__mailer__mailboxes__add_port').val();
        p.admin__mailer__mailer__mailboxes__add_user = $('#admin__mailer__mailer__mailboxes__add_user').val();
        p.admin__mailer__mailer__mailboxes__add_pass = $('#admin__mailer__mailer__mailboxes__add_pass').val();
        p.admin__mailer__mailer__mailboxes__add_timeout = $('#admin__mailer__mailer__mailboxes__add_timeout').val();
        if ($('#admin__mailer__mailer__mailboxes__add_is_smtp').is(':checked')) {
            p.admin__mailer__mailer__mailboxes__add_is_smtp = 'on';
        }
        else {
            p.admin__mailer__mailer__mailboxes__add_is_smtp = 'off';
        }
        if ($('#admin__mailer__mailer__mailboxes__add_smtp_auth').is(':checked')) {
            p.admin__mailer__mailer__mailboxes__add_smtp_auth = 'on';
        }
        else {
            p.admin__mailer__mailer__mailboxes__add_smtp_auth = 'off';
        }
        p.admin__mailer__mailer__mailboxes__add_smtp_secure = $('#admin__mailer__mailer__mailboxes__add_smtp_secure').val();
        if ($('#admin__mailer__mailer__mailboxes__add_firewall_1').is(':checked')) {
            p.admin__mailer__mailer__mailboxes__add_firewall = 'on';
        }
        else {
            p.admin__mailer__mailer__mailboxes__add_firewall = 'off';
        }
        p.admin__mailer__mailer__mailboxes__add_from_name = $('#admin__mailer__mailer__mailboxes__add_from_name').val();
        x.ax('addMailbox', p, null);
    };

    // Reset new mailbox.
    this.rm = function() {
        $('#admin__mailer__mailer__mailboxes__add_name').val('');
        $('#admin__mailer__mailer__mailboxes__add_address').val('');
        $('#admin__mailer__mailer__mailboxes__add_host').val('');
        $('#admin__mailer__mailer__mailboxes__add_port').val('');
        $('#admin__mailer__mailer__mailboxes__add_user').val('');
        $('#admin__mailer__mailer__mailboxes__add_pass').val('');
        $('#admin__mailer__mailer__mailboxes__add_is_smtp').prop("checked", false);
        $('#admin__mailer__mailer__mailboxes__add_is_smtp_auth').prop("checked", false);
        $('#admin__mailer__mailer__mailboxes__add_firewall_1').prop("checked", false);
    };

    // Edit mailbox click.
    this.em = function(el) {
        var x = admin__mailer__mailer;
        el = $(el).closest('[data-type="edit"]');
        var p = {};
        p.admin__mailer__mailer__mailbox__edit_uuid = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_uuid"]').val();
        p.admin__mailer__mailer__mailbox__edit_name = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_name"]').val();
        p.admin__mailer__mailer__mailbox__edit_address = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_address"]').val();
        p.admin__mailer__mailer__mailbox__edit_host = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_host"]').val();
        p.admin__mailer__mailer__mailbox__edit_port = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_port"]').val();
        p.admin__mailer__mailer__mailbox__edit_user = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_user"]').val();
        p.admin__mailer__mailer__mailbox__edit_pass = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_pass"]').val();
        p.admin__mailer__mailer__mailbox__edit_timeout = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_timeout"]').val();
        if ($(el).find('[data-type="admin__mailer__mailer__mailbox__edit_is_smtp"]').is(':checked')) {
            p.admin__mailer__mailer__mailbox__edit_is_smtp = 'on';
        }
        else {
            p.admin__mailer__mailer__mailbox__edit_is_smtp = 'off';
        }
        if ($(el).find('[data-type="admin__mailer__mailer__mailbox__edit_smtp_auth"]').is(':checked')) {
            p.admin__mailer__mailer__mailbox__edit_smtp_auth = 'on';
        }
        else {
            p.admin__mailer__mailer__mailbox__edit_smtp_auth = 'off';
        }
        p.admin__mailer__mailer__mailbox__edit_smtp_secure = $(el).find('[data-type="admin__mailer__mailer__mailboxes__edit_smtp_secure"]').val();
        if ($(el).find('[data-type="admin__mailer__mailer__mailboxes__edit_firewall_1"]').is(':checked')) {
            p.admin__mailer__mailer__mailbox__edit_firewall = 'on';
        }
        else {
            p.admin__mailer__mailer__mailbox__edit_firewall = 'off';
        }
        p.admin__mailer__mailer__mailbox__edit_from_name = $(el).find('[data-type="admin__mailer__mailer__mailbox__edit_from_name"]').val();
        x.ax('editMailbox', p, $(el).closest('[data-type="admin__mailer__mailer__mailbox"]'));
    };

    // Delete mailbox.
    this.dc = function(uuid) {
        var x = admin__mailer__mailer;
        x.uuid = uuid;
        $('#admin__mailer__mailer__modal_delete').modal('show');
    };

    // Delete execute.
    this.de = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__mailer__mailer;
            var p = x.uuid;
            x.uuid = null;
            x.ax('deleteMailbox', p, null);
        }, 550);
    };

    // Update settings click.
    this.us = function() {
        var x = admin__mailer__mailer;
        var p = {};
        p.admin__mailer__mailer__settings__error_log = $('#admin__mailer__mailer__settings__error_log').val();
        p.admin__mailer__mailer__settings__confirm_log = $('#admin__mailer__mailer__settings__confirm_log').val();
        p.admin__mailer__mailer__settings__default_mailbox = $('#admin__mailer__mailer__settings__default_mailbox').val();
        p.admin__mailer__mailer__settings__lock_ip_request = $('#admin__mailer__mailer__settings__lock_ip_request').val();
        p.admin__mailer__mailer__settings__lock_ip_time = $('#admin__mailer__mailer__settings__lock_ip_time').val();
        p.admin__mailer__mailer__settings__lock_ip_expire = $('#admin__mailer__mailer__settings__lock_ip_expire').val();
        p.admin__mailer__mailer__settings__lock_email_request = $('#admin__mailer__mailer__settings__lock_email_request').val();
        p.admin__mailer__mailer__settings__lock_email_time = $('#admin__mailer__mailer__settings__lock_email_time').val();
        p.admin__mailer__mailer__settings__lock_email_expire = $('#admin__mailer__mailer__settings__lock_email_expire').val();
        x.ax('updateSettings', p, null);
    };

    // Add to whitelist.
    this.aw = function() {
        var x = admin__mailer__mailer;
        var p = $('#admin__mailer__mailer__whitelist__add_email_or_ip').val();
        x.ax('addWhitelist', p, null);
    };

    // Remove from whitelist.
    this.rw = function(p) {
        var x = admin__mailer__mailer;
        x.ax('removeWhitelist', p, null);
    };

    // Add to blacklist.
    this.ab = function() {
        var x = admin__mailer__mailer;
        var p = {};
        p.admin__mailer__mailer__blacklist__add_email_or_ip = $('#admin__mailer__mailer__blacklist__add_email_or_ip').val();
        if ($('#admin__mailer__mailer__blacklist__add_static').is(':checked')) {
            p.admin__mailer__mailer__blacklist__add_static = 'on';
        }
        else {
            p.admin__mailer__mailer__blacklist__add_static = 'off';
        }
        x.ax('addBlacklist', p, null);
    };

    // Remove from whitelist.
    this.rb = function(p) {
        var x = admin__mailer__mailer;
        x.ax('removeBlacklist', p, null);
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

    // Clear error logs click.
    this.ce = function () {
        var x = admin__mailer__mailer;
        x.fn = 'clearError';
        $('[data-type="admin__mailer__mailer__modal_clear__error"]').removeClass('d-none');
        $('[data-type="admin__mailer__mailer__modal_clear__confirm"]').addClass('d-none');
        $('#admin__mailer__mailer__modal_clear').modal('show');
    };

    // Clear confirm logs click.
    this.cc = function () {
        var x = admin__mailer__mailer;
        x.fn = 'clearConfirm';
        $('[data-type="admin__mailer__mailer__modal_clear__confirm"]').removeClass('d-none');
        $('[data-type="admin__mailer__mailer__modal_clear__error"]').addClass('d-none');
        $('#admin__mailer__mailer__modal_clear').modal('show');
    };

    // Clear logs.
    this.cl = function() {
        $('.modal').modal('hide');
        setTimeout(function() {
            var x = admin__mailer__mailer;
            x.ax(x.fn, null, null);
            x.fn = null;
        }, 550);
    };

    // Tabs click.
    this.tc = function(ev, el, t) {
        ev.preventDefault();
        $(el).closest('[data-type="admin__mailer__mailer__mailbox"]').find('[data-type]').addClass('d-none');
        $(el).closest('[data-type="admin__mailer__mailer__mailbox"]').find('[data-type="' + t + '"]').removeClass('d-none');
        $(el).closest('[data-type="admin__mailer__mailer__mailbox"]').find('[data-nav]').removeClass('active');
        $(el).closest('[data-type="admin__mailer__mailer__mailbox"]').find('[data-nav="' + t + '"]').addClass('active');
    };

    // Set triggers.
    this.st = function() {
        $("#admin__mailer__mailer__whitelist__add_email_or_ip").keyup(function (event) {
            var x = admin__mailer__mailer;
            if (event.keyCode === 13) {
                x.aw();
            }
        });
        $("#admin__mailer__mailer__blacklist__add_email_or_ip").keyup(function (event) {
            var x = admin__mailer__mailer;
            if (event.keyCode === 13) {
                x.ab();
            }
        });
    };
    $(document).ready(function() {
        var x = admin__mailer__mailer;
        x.st();
    });
};
var admin__mailer__mailer = new admin__mailer__mailer__class();
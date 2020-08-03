/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// Open directory.
function admin__files__management__open(event, path) {
    event.preventDefault();
    admin__files__management__open_exec(path);
}
function admin__files__management__open_exec(path) {
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'openDirectory',
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            if (result !== '') {
                $('#admin__files__management__navbar').html(result);
                admin__files__management__ready();
            }
        }
    });
}

// Close directory.
function admin__files__management__close(event, path) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'closeDirectory',
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__navbar').html(result);
            admin__files__management__ready();
        }
    });
}

// Show content.
function admin__files__management__show(event, path) {
    event.preventDefault();
    admin__files__management__show_exec(path);
}
function admin__files__management__show_exec(path) {
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'show',
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__upload_path').val(path);
            admin__files__management__ready();
        }
    });
    admin__files__management__open_exec(path);
}

// Synchronize directories.
function admin__files__management__sync(event) {
    event.preventDefault();
    $('#admin__files__management__list').html();
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'sync',
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__navbar').html(result);
            admin__files__management__ready();
        }
    });
}

// Select.
function admin__files__management__select(el, event) {
    var all = true;
    $('input[data-file]').each(function() {
        if ($(this).prop('checked') == false) {
            all = false;
        }

    });
    if (all) {
        $('input[data-files-all]').prop('checked', true);
    }
    else {
        $('input[data-files-all]').prop('checked', false);
    }
}

// Select all.
function admin__files__management__select_all() {
    var uncheck = true;
    $('input[data-file]').each(function(){
        if ($(this).prop('checked') == false) {
            $(this).prop('checked', true);
            uncheck = false;
        }
    });
    if (uncheck) {
        $('input[data-file]').prop('checked', false);
        $('input[data-files-all]').prop('checked', false);
    }
    else {
        $('input[data-files-all]').prop('checked', true);
    }
}

// Rename directory.
var admin__files__management__directory = null;
function admin__files__management__rename_directory(n) {
    admin__files__management__directory = n;
    $('#admin__files__management__rename_directory_name').val(n);
    $('#admin__files__management__modal_rename_directory').modal('show');
}
function admin__files__management__rename_directory_keydown(e) {
    if (e.keyCode == 13) {
        admin__files__management__rename_directory_exec();
    }
}
function admin__files__management__rename_directory_exec() {
    var n = $('#admin__files__management__rename_directory_name').val();
    var path = $('#admin__files__management__path').html();
    $('#admin__files__management__modal_rename_directory').modal('hide');
    $('#admin__files__management__list').html('');
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'renameDirectory',
            oldName: admin__files__management__directory,
            newName: n,
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__ajax_error').removeClass('d-none').hide().fadeIn();
            $('#admin__files__management__ajax_confirm').removeClass('d-none').hide().fadeIn();
            admin__files__management__open_exec($('#admin__files__management__path').html());
            admin__files__management__ready();
        }
    });
}

// Rename file.
var admin__files__management__file = null;
function admin__files__management__rename_file(n) {
    admin__files__management__file = n;
    $('#admin__files__management__rename_file_name').val(n);
    $('#admin__files__management__modal_rename_file').modal('show');
}
function admin__files__management__rename_file_keydown(e) {
    if (e.keyCode == 13) {
        admin__files__management__rename_file_exec();
    }
}
function admin__files__management__rename_file_exec() {
    var n = $('#admin__files__management__rename_file_name').val();
    var path = $('#admin__files__management__path').html();
    $('#admin__files__management__modal_rename_file').modal('hide');
    $('#admin__files__management__list').html('');
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'renameFile',
            oldName: admin__files__management__file,
            newName: n,
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__ajax_error').removeClass('d-none').hide().fadeIn();
            $('#admin__files__management__ajax_confirm').removeClass('d-none').hide().fadeIn();
            admin__files__management__ready();
        }
    });
}

// Add directory.
function admin__files__management__add_directory() {
    $('#admin__files__management__add_directory_name').val('');
    $('#admin__files__management__modal_add_directory').modal('show');
}
function admin__files__management__add_directory_keydown(e) {
    if (e.keyCode == 13) {
        admin__files__management__add_directory_conf();
    }
}
function admin__files__management__add_directory_conf() {
    var n = $('#admin__files__management__add_directory_name').val();
    var path = $('#admin__files__management__path').html();
    $('#admin__files__management__modal_add_directory').modal('hide');
    $('#admin__files__management__list').html('');
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'addDirectory',
            name: n,
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__ajax_error').removeClass('d-none').hide().fadeIn();
            $('#admin__files__management__ajax_confirm').removeClass('d-none').hide().fadeIn();
            admin__files__management__open_exec($('#admin__files__management__path').html());
            admin__files__management__ready();
        }
    });
}

// Delete directory.
function admin__files__management__delete_directory(p) {
    admin__files__management__directory = p;
    $('#admin__files__management__modal_delete_directory').modal('show');
}
function admin__files__management__delete_directory_conf() {
    $('#admin__files__management__modal_delete_directory').modal('hide');
    $('#admin__files__management__list').html('');
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'deleteDirectory',
            path: admin__files__management__directory,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__ajax_error').removeClass('d-none').hide().fadeIn();
            $('#admin__files__management__ajax_confirm').removeClass('d-none').hide().fadeIn();
            admin__files__management__open_exec($('#admin__files__management__path').html());
            admin__files__management__ready();
        }
    });
}

// Delete File.
var admin__files__management__delete_files = null;
function admin__files__management__delete_file(file) {
    admin__files__management__delete_files = [file];
    $('#admin__files__management__modal_delete').modal('show');
}
function admin__files__management__delete_selection() {
    admin__files__management__delete_files = [];
    $('input[data-file]').each(function(){
        if ($(this).prop('checked') == true) {
            admin__files__management__delete_files.push($(this).attr('data-file'));
        }
    });
    if (admin__files__management__delete_files.length > 0) {
        $('#admin__files__management__modal_delete').modal('show');
    }
}
function admin__files__management__delete_conf() {
    $('#admin__files__management__modal_delete').modal('hide');
    var path = $('#admin__files__management__path').html();
    $('#admin__files__management__list').html('');
    $.ajax({
        type: 'POST',
        data: {
            ns: 'admin/files',
            cl: 'management',
            fn: 'delete',
            files: admin__files__management__delete_files,
            path: path,
            aid: $('[data-ajax-id]').data('ajax-id'),
        },
        success: function(result) {
            $('#admin__files__management__list').html(result);
            $('#admin__files__management__ajax_error').removeClass('d-none').hide().fadeIn();
            $('#admin__files__management__ajax_confirm').removeClass('d-none').hide().fadeIn();
            admin__files__management__ready();
        }
    });
}

// Open upload modal.
function admin__files__management__modal_upload_open(){
    $('#admin__files__management__modal_upload').modal({
        backdrop: 'static',
        keyboard: false
    })
}

// If closing upload modal.
$('#admin__files__management__modal_upload').on('hidden.bs.modal', function(){
    $('#admin__files__management__upload_list').html('');
});

// Dropzone and button.
function admin__files__management__upload_btn_click(event) {
    event.stopPropagation();
}

// Dropzone prevent.
$('html').on('drop', function(event) {
    event.preventDefault();
    event.stopPropagation();
});

// File upload.
var admin__files__management__count = 0;
var admin__files__management__ready = function () {
    var ul = $('#admin__files__management__upload_list');
    $('#admin__files__management__dropzone').click(function(e){
        e.preventDefault();
        $('#admin__files__management__upload_btn').click();
    });
    $('#admin__files__management__upload').fileupload({
        dropZone: $('#admin__files__management__dropzone'),
        add: function (e, data) {
            var error = function(message) {
                admin__files__management__modal_upload_open();
                $('button[data-btn-abort]').hide();
                $('button[data-btn-close]').show();
                var tpl = $('<li class="list-group-item d-flex justify-content-between align-items-center"><div class="float-left mr-3"><input type="text" value="0" data-width="48" data-height="48" data-fgColor="#0568b5" data-readOnly="1" data-bgColor="#eee" /></div><div class="float-left w-100"><div data-name="true"></div><div data-size="true"></div></div><div data-info="true" class="float-right"></div></li>');
                tpl.find('div[data-name]').html(data.files[0].name);
                tpl.find('div[data-size]').html(formatFileSize(data.files[0].size));
                tpl.find('div[data-info]').html('<h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i></h3>');
                data.context = tpl.appendTo(ul);
                tpl.find('input').knob();
                tpl.find('div[data-info]').click(function(){
                    jqXHR.abort();
                    tpl.fadeOut(function(){
                        tpl.remove();
                    });
                });
                tpl.after('<li class="list-group-item p-0" data-error="true"><div class="alert alert-danger m-0">' + message + '</div></li>');
            };
            var maxSize = $('#admin__files__management__max_upload_size').html();
            if (data.files[0].size > maxSize){
                var limit = formatFileSize(parseInt(maxSize));
                var message = $('#admin__files__management__max_upload_err').html() + limit;
                error(message);
                return;
            }
            var filesTypes = JSON.parse($('#admin__files__management__files_types').html());
            var array = data.files[0].name.split('.');
            var ext = array[array.length - 1];
            var err = true;
            for(var i = 0; i < filesTypes.length; i++) {
                if (ext === filesTypes[i]) {
                    err = false;
                    break;
                }
            }
            if (err) {
                var message = $('#admin__files__management__files_types_err').html();
                error(message);
                return;
            }
            admin__files__management__count++;
            admin__files__management__modal_upload_open();
            $('button[data-btn-abort]').show();
            $('button[data-btn-close]').hide();
            var tpl = $('<li class="list-group-item d-flex justify-content-between align-items-center"><div class="float-left mr-3"><input type="text" value="0" data-width="48" data-height="48" data-fgColor="#0568b5" data-readOnly="1" data-bgColor="#eee" /></div><div class="float-left w-100"><div data-name="true"></div><div data-size="true"></div></div><div data-info="true" class="float-right"></div></li>');
            tpl.find('div[data-name]').html(data.files[0].name);
            tpl.find('div[data-size]').html(formatFileSize(data.files[0].size));
            tpl.find('div[data-info]').html('<div class="tool-tip"><button class="btn btn-danger"><i class="fas fa-times"></i></button><span class="tool-tip-text bg-danger text-light">' + $('#admin__files__management__text_cancel').html() + '</span></div>');
            data.context = tpl.appendTo(ul);
            tpl.find('input').knob();
            tpl.find('div[data-info]').click(function(){
                jqXHR.abort();
                tpl.fadeOut(function(){
                    tpl.remove();
                });
            });
            var jqXHR = data.submit();
        },
        progress: function(e, data){
            var progress = parseInt(data.loaded / data.total * 100, 10);
            data.context.find('input').val(progress).change();
            if(progress == 100){
                data.context.removeClass('working');
            }
        },
        fail:function(e, data){
            data.context.addClass('error');
            admin__files__management__count--;
            if (admin__files__management__count <= 0) {
                $('button[data-btn-abort]').hide();
                $('button[data-btn-close]').show();
                admin__files__management__count = 0;
            }
        },
        done: function(e, data){
            var result = JSON.parse(data.result);
            if (result.status == 'success') {
                data.context.find('div[data-info]').html('<h3 class="text-success"><i class="fas fa-check"></i></h3>').unbind();
                admin__files__management__show_exec($('#admin__files__management__upload_path').val());
            }
            else {
                data.context.find('div[data-info]').html('<h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i></h3>').unbind();
                data.context.after('<li class="list-group-item p-0" data-error="true" style="display: none;"><div class="alert alert-danger m-0">' + result.error + '</div></li>');
                data.context.next().fadeIn();
            }
            admin__files__management__count--;
            if (admin__files__management__count <= 0) {
                $('button[data-btn-abort]').hide();
                $('button[data-btn-close]').show();
                admin__files__management__count = 0;
            }
        }
    });
    $(document).on('admin__files__management__dropzone dragover', function (e) {
        e.preventDefault();
    });
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }
};

// Abort all uploads.
function admin__files__management__cancel_all() {
    $('div[data-info]').click();
}


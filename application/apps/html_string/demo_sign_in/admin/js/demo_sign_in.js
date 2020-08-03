/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
*/

 // JavaScript.
var appnetos__html_string__demo_sign_in__textareas = [];
var appnetos__html_string__demo_sign_in__instances = [];
var appnetos__html_string__demo_sign_in__css = null;
$(document).ready(function() {
    if ($('form[data-html="true"]').attr('data-html') === 'true') {
        $('input[type=text], textarea').each(function () {
            appnetos__html_string__demo_sign_in__textareas.push($(this).attr('id'));
            var tmp = new nicEditor({fullPanel: true}).panelInstance($(this).attr('id'));
            appnetos__html_string__demo_sign_in__instances.push(tmp);
        });
    }
    else {
        $('input[type=text], textarea').each(function () {
            if ($(this).attr('id') !== 'appnetos__html_string__css') {
                appnetos__html_string__demo_sign_in__textareas.push($(this).attr('id'));
                var appnetos__html_string__tmp = document.getElementById($(this).attr('id'));
                var tmp = CodeMirror(function(elt) {
                    appnetos__html_string__tmp.parentNode.replaceChild(elt, appnetos__html_string__tmp);
                }, {'value': appnetos__html_string__tmp.value, 'lineNumbers': true, 'mode': 'htmlmixed'});
                tmp.setSize(null, 650);
                tmp.unicode = true;
                appnetos__html_string__demo_sign_in__instances.push(tmp);
            }
        });
    }
    var appnetos__html_string__css = document.getElementById('appnetos__html_string__css');
    if (typeof appnetos__html_string__css != null) {
        appnetos__html_string__demo_sign_in__css = CodeMirror(function (elt) {
            appnetos__html_string__css.parentNode.replaceChild(elt, appnetos__html_string__css);
        }, {'value': appnetos__html_string__css.value, 'lineNumbers': true, 'matchBrackets': true, 'mode': 'css'});
    }
});
function appnetos__html_string__demo_sign_in__demo_sign_in__edit() {
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', window.location.href);
    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'appnetos__html_string__action');
    input.setAttribute('value', 'edit');
    form.appendChild(input);
    for (var i = 0; i < appnetos__html_string__demo_sign_in__instances.length; i++) {
        var input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', appnetos__html_string__demo_sign_in__textareas[i]);
        input.setAttribute('value', appnetos__html_string__demo_sign_in__instances[i].getValue());
        form.appendChild(input);
    }
    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'appnetos__html_string__css');
    input.setAttribute('value', appnetos__html_string__demo_sign_in__css.getValue());
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
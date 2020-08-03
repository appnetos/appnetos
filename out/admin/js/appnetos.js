/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */
var appnetosClass = function() {

    // Variables.
    this.debug = false;
    this.ajaxId = null;
    this.baseUrl = null;
    this.url = null;
    this.onloadFunctions = [];

    /**
     * Add function to call onload.
     *
     * @param onloadFunction {string} function to call.
     * @param ar {mixed} arguments.
     */
    this.addOnload = function(onloadFunction, /*, ar */) {
        var ar = Array.prototype.slice.call(arguments, 1);
        var ad = {
            fn: onloadFunction,
            ar: ar
        };
        appnetos.onloadFunctions.push(ad);
    };

    /**
     * AJAX API get Element to render.
     *
     * @param ajaxNamespace {string} namespace to call in PHP.
     * @param ajaxClass {string} class to call in PHP.
     * @param ajaxFunction {string} function to call in PHP.
     * @param renderElement {string} element ID to render html into.
     * @param dataObject {mixed} data to send.
     * @returns {*}
     */
    this.ajaxElement = function(ajaxNamespace, ajaxClass, ajaxFunction, renderElement, dataObject) {
        if (typeof dataObject === 'undefined') {
            dataObject = {};
        }
        else if (typeof dataObject !== 'object') {
            dataObject = {dataObject};
        }
        dataObject.ns = ajaxNamespace;
        dataObject.cl = ajaxClass;
        dataObject.fn = ajaxFunction;
        dataObject.aid = appnetos.ajaxId;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (appnetos.debug) {
                    var debug = {
                        data: dataObject,
                        result: this
                    }
                    console.log(debug);
                }
            }
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(renderElement).innerHTML = this.responseText;
            }
        };
        xhr.open('POST', window.location.href);
        xhr.send(appnetos.objectToForm(dataObject));
    };

    /**
     * AJAX API get and call function with result as arguments.
     *
     * @param ajaxNamespace {string} namespace to call in PHP.
     * @param ajaxClass {string} class to call in PHP.
     * @param ajaxFunction {string} function to call in PHP.
     * @param callbackFunction [string} function to call with result as argument.
     * @param dataObject {mixed} data to send.
     * @returns {*}
     */
    this.ajaxFunction = function(ajaxNamespace, ajaxClass, ajaxFunction, callbackFunction, dataObject) {
        if (typeof dataObject === 'undefined') {
            dataObject = {};
        }
        else if (typeof dataObject !== 'object') {
            dataObject = {dataObject};
        }
        dataObject.ns = ajaxNamespace;
        dataObject.cl = ajaxClass;
        dataObject.fn = ajaxFunction;
        dataObject.aid = appnetos.ajaxId;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (appnetos.debug) {
                    var debug = {
                        data: dataObject,
                        result: this
                    }
                    console.log(debug);
                }
            }
            if (this.readyState == 4 && this.status == 200) {
                appnetos.call(callbackFunction, this.responseText);
            }
        };
        xhr.open('POST', window.location.href);
        xhr.send(appnetos.objectToForm(dataObject));
    };

    /**
     * AJAX API get JSON and call function with result as arguments.
     *
     * @param ajaxNamespace {string} namespace to call in PHP.
     * @param ajaxClass {string} class to call in PHP.
     * @param ajaxFunction {string} function to call in PHP.
     * @param callbackFunction [string} function to call with result as argument.
     * @param dataObject {mixed} data to send.
     * @returns {*}
     */
    this.ajaxJson = function(ajaxNamespace, ajaxClass, ajaxFunction, callbackFunction, dataObject) {
        if (typeof dataObject === 'undefined') {
            dataObject = {};
        }
        else if (typeof dataObject !== 'object') {
            dataObject = {dataObject};
        }
        dataObject.ns = ajaxNamespace;
        dataObject.cl = ajaxClass;
        dataObject.fn = ajaxFunction;
        dataObject.aid = appnetos.ajaxId;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (appnetos.debug) {
                    var debug = {
                        data: dataObject,
                        result: this
                    }
                    console.log(debug);
                }
            }
            if (this.readyState == 4 && this.status == 200) {
                appnetos.call(callbackFunction, JSON.parse(this.responseText));
            }
        };
        xhr.open('POST', window.location.href);
        xhr.send(appnetos.objectToForm(dataObject));
    };

    /**
     * AJAX API get serialize form to JSON and call function with result as arguments.
     *
     * @param ajaxNamespace {string} namespace to call in PHP.
     * @param ajaxClass {string} class to call in PHP.
     * @param ajaxFunction {string} function to call in PHP.
     * @param callbackFunction [string} function to call with result as argument.
     * @param form {mixed} form to serialize.
     * @returns {*}
     */
    this.ajaxForm = function(ajaxNamespace, ajaxClass, ajaxFunction, callbackFunction, form) {
        var data = serialize(form, true);
        if (!data) {
            if (appnetos.debug) {
                console.log('Error: Serialize form');
                return false;
            }
        }
        dataObject = {};
        dataObject.data = data;
        dataObject.ns = ajaxNamespace;
        dataObject.cl = ajaxClass;
        dataObject.fn = ajaxFunction;
        dataObject.aid = appnetos.ajaxId;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (appnetos.debug) {
                    var debug = {
                        data: dataObject,
                        result: this
                    }
                    console.log(debug);
                }
            }
            if (this.readyState == 4 && this.status == 200) {
                appnetos.call(callbackFunction, JSON.parse(this.responseText));
            }
        };
        xhr.open('POST', window.location.href);
        xhr.send(appnetos.objectToForm(dataObject));
    };

    /**
     * Serialize form data.
     *
     * @param form {mixed} form object or form ID.
     * @param assoc {bool} return as array with name and value.
     * @returns {mixed} serialized string or array.
     */
    var serialize = function (form, assoc = false) {
        if (typeof form === 'string') {
            form = document.getElementById(form);
        }
        if (typeof form != 'object' || form.nodeName != "FORM") {
            return false;
        }
        var field;
        var optionsLength;
        var string = [];
        var array = [];
        var elementsLength = form.elements.length;
        for (var i = 0; i < elementsLength; i++) {
            field = form.elements[i];
            if (field.name && !field.disabled && field.type != 'button' && field.type != 'file' && field.type != 'reset' && field.type != 'submit') {
                if (field.type == 'select-multiple') {
                    optionsLength = form.elements[i].options.length;
                    for (var j = 0; j < l; j++) {
                        if (field.options[j].selected) {
                            string[string.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[j].value);
                            array.push({'name': field.name, 'value': field.options[j].value});
                        }
                    }
                }
                else if ((field.type != 'checkbox' && field.type != 'radio') || field.checked) {
                    string[string.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value);
                    array.push({'name': field.name, 'value': field.value});
                }
            }
        }
        if (assoc) {
            return array;
        }
        return string.join('&').replace(/%20/g, '+');
    };

    /**
     * Call function by namespace and name.
     *
     * @param na function name.
     * @param ar arguments.
     * @returns {*}
     */
    this.call = function(functionName /*, args */) {
        var context = window;
        var args = Array.prototype.slice.call(arguments, 1);
        var namespaces = functionName.split(".");
        var func = namespaces.pop();
        for(var i = 0; i < namespaces.length; i++) {
            context = context[namespaces[i]];
        }
        return context[func].apply(context, args);
    };

    /**
     * JSON object to from data.
     *
     * @param data {object} JSON object.
     * @return object.
     */
    this.objectToForm = function(data) {
        var formData = new FormData();
        appnetos.objectToFormBuild(formData, data);
        return formData;
    };

    /**
     * JSON object to form builder.
     *
     * @param formData {formData}.
     * @param data {object}.
     * @param parentKey {string}.
     */
    this.objectToFormBuild = function(formData, data, parentKey) {
        if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
            Object.keys(data).forEach(key => {
                appnetos.objectToFormBuild(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
            });
        } else {
            var value = data == null ? '' : data;
            formData.append(parentKey, value);
        }
    };

    /**
     * Add onload event.
     *
     * @param object.
     */
    this.onloadEvent = function(func) {
        var oldonload = window.onload;
        if (typeof window.onload != 'function') {
            window.onload = func;
        }
        else {
            window.onload = function() {
                if (oldonload) {
                    oldonload();
                }
                func();
            }
        }
    };

    /**
     * APPNET OS onload.
     */
    this.onload = function() {
        if (typeof APPNETOS_DEBUG_AJAX !== 'undefined') {
            if (APPNETOS_DEBUG_AJAX === true) {
                appnetos.debug = true;
            }
        }
        appnetos.ajaxId = document.querySelector('[data-ajax-id]').getAttribute('data-ajax-id');
        appnetos.baseUrl = document.querySelector('[data-application-url]').getAttribute('data-application-url');
        appnetos.url = appnetos.base + '/' + window.location.href;
        for (var i = 0; i < appnetos.onloadFunctions.length; i++) {
            appnetos.call(appnetos.onloadFunctions[i].fn, appnetos.onloadFunctions[i].ar);
        }
    };

};
var appnetos = new appnetosClass();

/*
 * Add on load event.
 */
appnetos.onloadEvent(appnetos.onload);
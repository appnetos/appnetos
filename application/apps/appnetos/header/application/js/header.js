/**
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 */

// appnetos header class.
var appnetos__header__class = function() {

    // Icons sets.
    this.s = {};
    
    // Icon mouse over.
    this.ov = function(index, id) {
        var x = appnetos__header;
        if (typeof x.s[id] == 'undefined') {
            var a = [];
            $('[data-set="app-' + id + '-icon"]').each(function() {
                var w = $(this).width();
                a.push(w);
                x.s[id] = a;
            });
        }
        var s = x.s[id];
        for (var i = 0; i < s.length; i++) {
            if (i === (index - 1)) {
                var w = s[i] / 100 * 120;
                var m = (w - s[i]) / 2;
                var m = m - (m * 2);
                $('#app-' + id + '-icon' + i).width(parseInt(w));
                $('#app-' + id + '-icon' + i).css('zIndex', 2);
                $('#app-' + id + '-icon' + i).css({'margin': + m + 'px'});
            }
            else if (i === index) {
                w = s[i] / 100 * 140;
                m = (w - s[i]) / 2;
                m = m - (m * 2);
                $('#app-' + id + '-icon' + i).width(parseInt(w));
                $('#app-' + id + '-icon' + i).css('zIndex', 3);
                $('#app-' + id + '-icon' + i).css({'margin': + m + 'px'});
            }
            else if (i === (index + 1)) {
                w = s[i] / 100 * 120;
                m = (w - s[i]) / 2;
                m = m - (m * 2);
                $('#app-' + id + '-icon' + i).width(parseInt(w));
                $('#app-' + id + '-icon' + i).css('zIndex', 2);
                $('#app-' + id + '-icon' + i).css({'margin': + m + 'px'})
            }
            else {
                $('#app-' + id + '-icon' + i).width(s[i]);
                $('#app-' + id + '-icon' + i).css('zIndex', 1);
                $('#app-' + id + '-icon' + i).css({'margin':'0px'});
            }
        }
    };
    
    // Icon mouse out.
    this.oo = function(id) {
        var x = appnetos__header;
        var s = x.s[id];
        for (var i = 0; i < s.length; i++) {
            $('#app-' + id + '-icon' + i).width(s[i]);
            $('#app-' + id + '-icon' + i).css({'margin':'0px'});
            $('#app-' + id + '-icon' + i).css('zIndex', 1);
        }
    };
};
var appnetos__header = new appnetos__header__class();
import { clearForm, changeAction } from '../modules/components/forms.js';
import { overloading } from '../modules/components/overloading.js';
import { errorMessage } from '../modules/components/messages.js';

$(function () {
    /**
     * main common object
     * include all common function and variables
     */
    var _common = {};
    // bind to window variable, make it usable everywhere
    $.extend(window, {
        _common: _common,
    });

    _common.clearForm = clearForm;
    _common.errorMessage = errorMessage;
    _common.overloading = overloading;
    _common.changeAction = changeAction;
});

$(document).ready(function () {
    $("#logout-a01").click(function () {
        _common.overloading();
    });
});

$(document).ready(function () {
    $('a').click(function () {
        $('#overlay').show();
    });
});

$(document).ready(function () {
    (function () {
        window.onpageshow = function(event) {
            if (event.persisted) {
                document.body.classList.add('hidden-body');
                window.location.reload(true);
            }
        };
    })();
});

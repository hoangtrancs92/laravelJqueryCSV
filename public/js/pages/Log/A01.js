$(document).ready(function () {
    "use strict";
    $("#login-form").validate({
        rules: {
            email: {
                required: true,
                emailCustomRule: true,
            },
            password: {
                required: true,
            },
        },

        messages: {
            email: {
                required: _common.errorMessage("EBT001", "Email"),
                emailCustomRule: _common.errorMessage("EBT005"),
            },

            password: {
                required: _common.errorMessage("EBT001", "Password"),
            },
        },

        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                var firstErrorField = $(validator.errorList[0].element);
                firstErrorField.focus();
            }
        },

        submitHandler: function (form) {
            form.submit();
            _common.overloading();
            $(document).ready(function () {
                $("#login-button").prop("disabled", true);
            });
        },

        onfocusout: function (element) {
            $(element).valid();
        },
    });
});

$.validator.addMethod("emailCustomRule", function (value, element) {
    var regex =
    /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@([a-zA-Z0-9]+\.)*[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](\.[a-zA-Z]{2,})+$/;
    var specialCharRegex = /[!#$%^&*()+=\[\]{}|\\<>?,;:'"/]/;
    return regex.test(value) && !specialCharRegex.test(value);
});

$(document).ready(function() {
    $("input").on("focus", function() {
      $(".alert-danger").hide();
    });
  });

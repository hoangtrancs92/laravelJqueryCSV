import { leapYear } from "../../modules/components/leapYear.js";

$(document).ready(function () {
    "use strict";
    $("#user-form").validate({
        rules: {
            email: {
                required: true,
                emailCustomRule: true,
                utf8OneByte: true,
                maxlength: 255,
            },
            name: {
                required: true,
                utf8OneByte: true,
                maxlength: 100,
            },
            group: {
                required: true,
                number: true,
            },
            position: {
                required: true,
                number: true,
            },
            startedDate: {
                required: true,
                dateDDMMYYYY: true,
                leapYear: true,
            },
            password: {
                required: true,
                checkLength: true,
                passwordRule: true,
                nullOrAlphaNumeric: true,
            },
            rePassword: {
                required: true,
                equalTo: "#password",
            },
            updatePassword: {
                checkLength: true,
                nullOrAlphaNumeric: true,
                passwordRule: true,
            },
            reUpdatePassword: {
                updatePassword: true,
                equalTo: "#updatePassword",
            },
        },

        messages: {
            email: {
                required: _common.errorMessage("EBT001", "Email"),
                emailCustomRule: _common.errorMessage("EBT005"),
                utf8OneByte: _common.errorMessage("EBT004", "Email"),
                maxlength: function (params, element) {
                    return _common.errorMessage(
                        "EBT002",
                        "Email",
                        "255",
                        element.value.length
                    );
                },
            },
            name: {
                required: _common.errorMessage("EBT001", "User Name"),
                utf8OneByte: _common.errorMessage("EBT004", "User Name"),
                maxlength: function (params, element) {
                    return _common.errorMessage(
                        "EBT002",
                        "User Name",
                        "100",
                        element.value.length
                    );
                },
            },
            group: {
                required: _common.errorMessage("EBT001", "Group"),
                number: _common.errorMessage("EBT010", "Group"),
            },
            password: {
                required: _common.errorMessage("EBT001", "Password"),
                checkLength: _common.errorMessage("EBT023"),
                nullOrAlphaNumeric: _common.errorMessage(
                    "EBT004",
                    "Password"
                ),
                passwordRule: "パスワードには半角数字のみ、または半角英字のみの値は使用できません。"
            },
            rePassword: {
                required: _common.errorMessage(
                    "EBT001",
                    "Password Confirmation"
                ),
                length8to20: _common.errorMessage("EBT023"),
                equalTo: _common.errorMessage("EBT030"),
            },
            position: {
                required: _common.errorMessage("EBT001", "Position"),
                number: _common.errorMessage("EBT010", "Position"),
            },
            startedDate: {
                required: _common.errorMessage("EBT001", "Started Date"),
                dateDDMMYYYY: _common.errorMessage("EBT008", "Started Date"),
                leapYear: _common.errorMessage("EBT008", "Started Date"),
            },
            updatePassword: {
                checkLength: _common.errorMessage("EBT023"),
                nullOrAlphaNumeric: _common.errorMessage("EBT004", "Password"),
                passwordRule: "パスワードには半角数字のみ、または半角英字のみの値は使用できません。"
            },
            reUpdatePassword: {
                updatePassword: _common.errorMessage("EBT001", "Password Confirmation"),
                equalTo: _common.errorMessage("EBT030"),
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
            $('#overlay').show();
            form.submit();
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

$.validator.addMethod(
    "leapYear",
    function (value, element) {
        let startDateFrom = $("#start-date-from").val();
        if (startDateFrom === "" || value === "") {
            return true;
        }
        return leapYear(value);
    },
    ""
);

$("input").on("change", function () {
    $(this).valid();
});

$("select").on("change", function () {
    $(this).valid();
});

$.validator.addMethod(
    "dateDDMMYYYY",
    function (value, element) {
        let regex = /^\d{2}\/\d{2}\/\d{4}$/;
        return this.optional(element) || regex.test(value);
    },
    "Please dd/mm/YYYY"
);

$(document).ready(function () {
    $("#startedDate").datepicker({
        dateFormat: "dd/mm/yy",
    });
});

$.validator.addMethod(
    "utf8OneByte",
    function (value, element) {
        return /^[\x00-\x7F]*$/.test(value);
    },
    ""
);

$.validator.addMethod(
    "nullOrAlphaNumeric",
    function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    },
    "only A-Za-z0-9."
);

$.validator.addMethod(
    "passwordRule",
    function (value, element) {
        return this.optional(element) || /^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]+$/.test(value);
    },
    ""
);

$.validator.addMethod(
    "checkLength",
    function (value, element) {
        if (value.trim() === "") {
            return true;
        } else {
            return value.length >= 8 && value.length <= 20;
        }
    },
    "8-20 character"
);

// Select option (long text to ...)
$(document).ready(function() {
    var selects = $('select');
    selects.each(function() {
        var options = $(this).find('option');
        options.each(function() {
            var maxCharacters = 40;
            var originalText = $(this).text();
            if (originalText.length > maxCharacters) {
                $(this).text(originalText.substr(0, maxCharacters) + '...');
            }
        });
    });
});

$.validator.addMethod("updatePassword", function(value, element) {
    var password = $("#updatePassword").val();
    return (password === "" || value !== "");
});


$(document).ready(function() {
    $('#update-director-button').click(function (event) {
        event.preventDefault();
        var formId = $(this).data('form-id');
        var route = $(this).data('route') + formId;
        console.log(route);
        var form = $('#user-form');
        // Change action
        form.attr('action', route);
        $(form).submit();
    });
  });

  $(document).ready(function() {
    $("#email").on("change", function() {
      $(".alert-danger").hide();
    });
  });

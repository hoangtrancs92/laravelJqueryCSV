import { leapYear } from "../../modules/components/leapYear.js";
$(document).ready(function () {
    "use strict";
    $("#search-form").validate({
        rules: {
            startDateFrom: {
                dateDDMMYYYY: true,
                leapYear: true,
            },
            startDateTo: {
                dateDDMMYYYY: true,
                leapYear: true,
                dateGreaterThan: "#start-date-from",
            },
        },
        messages: {
            startDateFrom: {
                dateDDMMYYYY: _common.errorMessage(
                    "EBT008",
                    "Started Date From"
                ),
                leapYear: _common.errorMessage("EBT008", "Started Date From"),
            },

            startDateTo: {
                dateDDMMYYYY: _common.errorMessage("EBT008", "Started Date To"),
                leapYear: _common.errorMessage("EBT008", "Started Date To"),
                dateGreaterThan: _common.errorMessage("EBT044"),
            },
        },

        onchange: function (element) {
            $(element).valid();
        },
    });
});

$("#start-date-from,#start-date-to").on("change", function () {
    var startedDateFrom = $('#start-date-from');
    var startedDateTo = $('#start-date-to');
    if (startedDateTo.hasClass('error')) {
        startedDateTo.removeClass('error');
        startedDateTo.next('.error').remove();
    }
    $(this).valid();
    startedDateFrom.valid();
    startedDateTo.valid();
});

$.validator.addMethod(
    "dateDDMMYYYY",
    function (value, element) {
        let regex = /^\d{2}\/\d{2}\/\d{4}$/;
        return this.optional(element) || regex.test(value);
    },
    "Please dd/mm/YYYY"
);

$.validator.addMethod("dateGreaterThan", function (value, element, params) {
    let startDate = $(params).val();
    if (startDate === "" || value === "") {
        return true;
    }

    let currentDate = value;
    let startDateObj = $.datepicker.parseDate("dd/mm/yy", startDate);
    let currentDateObj = $.datepicker.parseDate("dd/mm/yy", currentDate);

    return currentDateObj >= startDateObj;
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

$(document).ready(function () {
    $("#start-date-from")
        .datepicker({
            dateFormat: "dd/mm/yy",
            autoclose: true,
            orientation: "bottom right",
        })
        .on("focusout", function () {
            $("#search-form").data("validator").settings.ignore = "";
            $(this).valid();
        })
        .on("focus", function () {
            $("#search-form").data("validator").settings.ignore =
                "#start-date-from, :hidden";
        });
    $("#start-date-to").datepicker({
        dateFormat: "dd/mm/yy",

    }) .on("focusout", function () {
        $("#search-form").data("validator").settings.ignore = "";
        $(this).valid();
    }) .on("focus", function () {
        $("#search-form").data("validator").settings.ignore =
            "##start-date-to, :hidden";
    });
});

$(document).ready(function () {
    $("#clear-button").click(function () {
        $("label.error").hide();
        $('input[type="text"]').val("");
    });
});

$("#export-button").click(function () {
    let route = $(this).data("route");
    let form = $("#export-form");
    console.log("export button");
    // Change action
    form.attr("action", route);
    // Submit form
    form.submit();
    _common.overloading();
});
$('#search-button').on('click', function (event) {
    $('#overlay').show();

    setTimeout(function () {
        $('#overlay').hide();
        // $('#search-form').submit();

    }, 200);
});

$(document).ready(function() {
    $("input").on("focus", function() {
      $(".alert-danger").hide();
    });
  });

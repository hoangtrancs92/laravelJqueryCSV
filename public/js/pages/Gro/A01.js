$(document).ready(function () {
    "use strict";
    $("#csv-import").validate({
        rules: {
            csvFile: {
                required: true,
                extension: "csv|xlsx|txt",
                filesize: 1024 * 1024,
            },
        },

        messages: {
            csvFile: {
                required: _common.errorMessage("EBT001", "CSV"),
                extension: _common.errorMessage("EBT033", "CSV"),
                filesize: _common.errorMessage("EBT034", "1MB"),
            },
        },

        submitHandler: function (form) {
            form.submit();
            _common.overloading();
            $(document).ready(function () {
                $("#submitButton").prop("disabled", true);
            });
        },

        onfocus: function (element) {
            $(element).valid();
        },
    });
});

$("#csv-file").on("change", function () {
    $(this).valid();
});

// Validator File Size
$.validator.addMethod(
    "filesize",
    function (value, element, param) {
        return this.optional(element) || element.files[0].size <= param;
    },
    "File size must be less than {0} bytes"
);

// open dialog import file
$(document).ready(function () {
    var modal = $("#myModal");

    // Get the button that opens the modal
    var btn = $("#import-button");

    // Get the <span> element that closes the modal
    var span = $(".close").eq(0);

    // When the user clicks the button, open the modal
    btn.click(function() {
        modal.css("display", "block");
    });

    // When the user clicks on <span> (x), close the modal
    span.click(function() {
        modal.css("display", "none");
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(event) {
        if (event.target == modal[0]) {
            modal.css("display", "none");
        }
    });
});

$(document).ready(function() {
    $(".close").click(function() {
        $("#errorDialog").fadeOut();
    });

    function openDialog() {
        $("#errorDialog").fadeIn();
    }

    function closeDialog() {
        $("#errorDialog").fadeOut();
    }
});

$(document).ready(function() {
    $("input").on("focus", function() {
      $(".alert-danger").hide();
    });
  });

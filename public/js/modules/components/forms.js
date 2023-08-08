// clear button
export const clearForm = () => {
        $('label.error').hide();
        $('input[type="text"]').val('');
        $('input[type="checkbox"]').prop('checked', true);
};

export const changeAction = (buttonId, formId) => {
    $('#' + buttonId).click(function () {
        var route = $(this).data('route');
        var form = $(formId);
        // Change action
        form.attr('action', route);

        // Submit form
        form.submit();
    });
}


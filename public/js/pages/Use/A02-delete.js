// Action delete user with show Alert (use sweetAlert2 library)
$(document).ready(function () {
    $('#delete-button').click(function (event) {
        event.preventDefault();
        var formId = $(this).data('form-id');
        Swal.fire({
            // title: "Are you sure you want to delete the record with id " + formId + " ?",
            title: "このユーザーを削除してもいいですか？ ",
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        })

        $('.swal2-confirm').click(()=>{
              $('#delete-form-' + formId).submit();
        })
    });
});


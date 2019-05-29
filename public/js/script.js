$(function () {
    function upload(img) {
        var form_data = new FormData();
        form_data.append('file_name', img.files[0]);
        form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            url: "/companies/upload-image",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (!data.fail) {
                    $('#logo').val(data.file_name);
                    $('#image').attr('src', '/storage/logos/' + data.file_name);
                    $('#image').show();
                } else {
                    console.log(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                $('#image').hide();
            }
        });
    }

    $('#file').change(function () {
        if ($(this).val() != '') {
            upload(this);
        }
    });


});

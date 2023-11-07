$().ready(function () {
    const imageDetailList = [];
    const elementListImage = $('.list-image');
    $('#form-add-images').on('submit', function (e) {
        e.preventDefault();

        let file = $('#image')[0].files[0];
        let description = $('#description').val();

        imageDetailList.push({
            file,
            description,
        });

        var formData = new FormData();
        formData.append('file', file);
        formData.append('description', description);

        $.ajax({
            url: "/admin/image/uploadTempImage",
            type: 'POST',
            data: formData,
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            }
        });
    })

})


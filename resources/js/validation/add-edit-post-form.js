$().ready(function () {
    $('#post-form').validate({
        onclick: false,
        rules: {
            'title': {
                required: true,
            },
            'image_title': {
                required: true,
                extension: 'png|jpeg|jpg',
                filesize: '1MB',
            },
            'content_title': {
                required: true,
            },
        },
        messages: {
            'title': {
                required: function () {
                    return jQuery.validator.messages.required('Ttile');
                },
            },
            'image_title': {
                required: function () {
                    return jQuery.validator.messages.required('Image title');
                },
                filesize: function (size) {
                    return jQuery.validator.messages.filesize(size);
                },
                extension: function (extension) {
                    return jQuery.validator.messages.extension('IMAGE/JPG');
                }
            },
            'content_title': {
                required: function () {
                    return jQuery.validator.messages.required('Content title');
                },
            },
        },
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            const errorDiv = $(`div.error-div.error-${$(element).attr('name')}`);
            errorDiv.html(error);
        },
        onfocusin: function (element) {
            $('div.alert').css('display', 'none');
        },
        onkeyup: function (element) {
            $(element).valid();
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        submitHandler: function (form) {
            if ($(form).data('is-submitted') === undefined) {
                $(form).data('is-submitted', true)
                form.submit();
            }
        },
    })

});

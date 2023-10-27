$().ready(function() {
    $('#register-form').validate({
        onkeyup: false,
        onclick: false,
        rules: {
            'name': {
                required: true,
            },
            'email': {
                required: true,
                email: true,
                maxlength: 255,
                remote: {
                    url: "/checkDuplicateEmail",
                    type: "post",
                    data: {
                        email:() => $("input[name='email']").val(),
                        _token:() => _token = $("input[name='_token']").val(),
                    },
                    dataFilter: function(data){
                        if(data == 'true') {
                            return false;
                        }
                        return true;
                    }
                },
            },
            'password': {
                required: true,
                stringValueRange: [8, 20],
            },
            'password_confirmation': {
                required: function() {
                    let passWord = $('#password').val();

                    return Boolean(passWord.length);
                },
                stringValueRange: [8, 20],
                equalTo: "#password",
            },
        },
        messages: {
            'name': {
                required: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.required(attributeName);
                },
            },
            'email': {
                maxlength: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    let length = Array.from($(element).val()).length;
                    return jQuery.validator.messages.max(attributeName, param, length);
                },
                required: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.required(attributeName);
                },
                remote: function() {
                    return jQuery.validator.messages.existsEmail();
                },
            },
            'password': {
                required: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.required(attributeName);
                },
                stringValueRange: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.stringValueRange(attributeName, param[0], param[1]);
                },
            },
            'password_confirmation': {
                required: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.required(attributeName);
                },
                stringValueRange: function(param, element) {
                    let attributeName = $(element).data('content').slice(0, -1);
                    return jQuery.validator.messages.stringValueRange(attributeName, param[0], param[1]);
                },
            },
        },
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            const errorDiv = $(`div.error-div.error-${$(element).attr('name')}`);
            errorDiv.html(error);
        },
        onfocusin: function(element) {
           $('div.alert').css('display', 'none');
        },
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            $(element).valid();
        },
        submitHandler: function(form) {
            if($(form).data('is-submitted') === undefined) {
                $(form).data('is-submitted', true)
                form.submit();
            }
        },
    });
});

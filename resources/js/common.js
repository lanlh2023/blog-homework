$(document).ready(function () {
    //Prevent multiple submit
    let formElements = $('form.form-submit');
    $.each(formElements, function (index, form) {
        $(form).on('submit', function (e) {
            if ($(this).data('is-submit') === true) {
                e.preventDefault();
            } else {
                $(this).data('is-submit', true);
            }
        })
    });

    (function () {
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    })();

    const toggleClassForSildebar = (isAdd = true) => {
        if (isAdd) {
            $('.sidebar').addClass('col-xl-1 col-lg-1')
            $('.menu-list').addClass('collapse')
            return;
        }
        $('.sidebar').removeClass('col-xl-1 col-lg-1')
        $('.menu-list').removeClass('collapse')
    }

    $("#navbar-checkbox").change(function () {
        if ($(window).width() >= 768) {
            if ($(this).prop('checked')) {
                toggleClassForSildebar();
            } else {
                toggleClassForSildebar(false);
            }
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.loadNotification = function ({ success, message }) {
        $("#toast").toast('hide');

        let classForNotification = 'bg-danger'
        if (success) {
            classForNotification = 'bg-success'
        }

        $('#toast-body').text(message)
        $('#toast-body').addClass(classForNotification)
        $('#wrap-toast').addClass('open-toast')

        $("#toast").toast('show');

        $('#toast').on('hidden.bs.toast', function () {
            $('#toast-body').text('')
            $('#toast-body').removeClass(classForNotification)
            $('#wrap-toast').removeClass('open-toast')
        })
    }

    tinymce.init({
        selector: '#content',
        skin: false,
        content_css: false,
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    });

})


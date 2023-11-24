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

    $("#navbar-checkbox").change(function () {
        if ($(window).width() >= 768) {
            if ($(this).prop('checked')) {
                $('.sidebar').addClass('col-xl-1 col-lg-1')
                $('.menu-list').addClass('collapse')
            } else {
                $('.sidebar').removeClass('col-xl-1 col-lg-1')
                $('.menu-list').removeClass('collapse')
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

        $("#toast").toast('show');

        $('#toast').on('hidden.bs.toast', function () {
            $('#toast-body').text('')
            $('#toast-body').removeClass(classForNotification)
        })
    }
})


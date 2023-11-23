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

    window.onload = function () {
        if (localStorage.getItem("collapse") == null) {
            localStorage.setItem("collapse", false);
        }

        let isClose = JSON.parse(localStorage.getItem("collapse"));
        if ($(window).width() >= 768) {
            if (isClose) {
                toggleClassForSildebar()
            }
        }
    };

    $("#navbar-checkbox").change(function () {
        if (localStorage.getItem("collapse") == null) {
            localStorage.setItem("collapse", false);
        }

        if ($(window).width() >= 768) {
            if ($(this).prop('checked')) {
                localStorage.setItem("collapse", true);
                toggleClassForSildebar();
            } else {
                localStorage.setItem("collapse", false);
                toggleClassForSildebar(false);
            }
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})


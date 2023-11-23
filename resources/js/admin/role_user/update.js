$().ready(function () {
    const loadNotification = function ({ success, message }) {
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

    $('.btn-update-role').on('click', function () {
        let elementTr = $(this).closest('.item-user');
        let tdIncludeSelect = $(elementTr).children("td.role_user_td")[0];
        let select = $(tdIncludeSelect).children()[0];
        let roleId = $(select).val();

        let idUserElement = $(elementTr).children("td.user_id").children()[0];
        let userId = $(idUserElement).text();


        const data = new FormData();
        data.append('userId', userId);
        data.append('roleId', roleId);

        $.ajax({
            url: "/admin/role_user/store",
            type: 'POST',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                loadNotification(data)
            },
            error: function (xhr, status, error) {
                loadNotification({ success: false, message: xhr.responseJSON.message })
            }
        })
    })
})

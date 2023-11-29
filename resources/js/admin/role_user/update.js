$().ready(function () {
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

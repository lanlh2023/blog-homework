$().ready(function () {
    const subContentList = [];

    $('#add-image').on('click', function () {
        let elementFile = $('#file');
        let elementContent = $('#content');

        let file = $(elementFile).prop('files')[0];
        let content = $(elementContent).val();

        elementFile.val('');
        elementContent.val('');

        if (file) {
            let reader = new FileReader();
            reader.onloadend = function () {
                let imagePath = this.result;

                let item = {
                    content: content,
                    'imagePath': imagePath,
                };

                subContentList.push(item);

                renderImages(subContentList);

            };

            reader.readAsDataURL(file);
        }

        function renderImages(subContentList) {
            $('#content-detail-list').html('');

            for (const item of subContentList) {
                let div = $('<div>')
                    .attr('class', 'content-detail-item d-flex justify-content-between align-items-center border')
                    .append($('<img>')
                        .attr('class', 'rounded float-left object-fit-cover')
                        .css({ "height": '300px', "width": "300px" })
                        .attr('src', item.imagePath),
                    )
                    .append($('<div>')
                        .attr('class', 'content-detail-body w-50')
                        .append(item.content)
                    );

                $('#content-detail-list').append(div);
            }
        }
    });
    function resetAllForm() {
        $('#content-detail-list').html('');
        $('#post-form')[0].reset();
    }
    $('.btn-add-post').on('click', function (e) {
        const form = $("#post-form");
        if (form.valid() && subContentList.length) {
            let title = $('#title').val();
            let contentTitle = $('#content_title').val();
            let imageTitle = $('#image_title').prop('files')[0];

            const data = new FormData();
            data.append('title', title);
            data.append('content_title', contentTitle);
            data.append('image_title', imageTitle);
            data.append('content', JSON.stringify(subContentList));

            e.preventDefault();
            $.ajax({
                url: "/admin/post/store",
                type: 'POST',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success) {
                        resetAllForm();
                        alert(data.message)
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        }

    })

})

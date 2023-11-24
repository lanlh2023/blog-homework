$().ready(function () {
    tinymce.init({
        selector: '#content',
        skin: false,
        content_css: false,
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    });

    const subContentList = [];

    $('#add-image').on('click', function () {
        let elementFile = $('#file');

        let file = $(elementFile).prop('files')[0];
        let content = tinymce.get("content").getContent();

        elementFile.val('');
        tinymce.get("content").setContent("");

        if (content.length == 0) {
            loadNotification({ success: false, message: 'Please enter sub content for post' })
            return;
        }

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
            let index = 0;
            for (const item of subContentList) {
                let div = $('<div>')
                    .attr('class', 'content-detail-item d-flex justify-content-between align-items-center border')
                    .append($('<img>')
                        .attr('class', 'rounded float-left object-fit-cover ml-2 img-sub-item')
                        .attr('src', item.imagePath),
                    )
                    .append($('<div>')
                        .attr('class', 'content-detail-body w-50')
                        .append(item.content)
                    )
                    .append($('<div>')
                        .attr('class', 'btn btn-secondary btn-delete-sub-content-item mr-2')
                        .attr('data-index', index)
                        .append('x')
                    );
                index++;
                $('#content-detail-list').append(div);
            }

            addEventClickForButtonDelete(renderImages, subContentList);
        }
    });

    function addEventClickForButtonDelete(callback, subContentList) {
        let elementsButtonDelete = $('.btn-delete-sub-content-item');
        elementsButtonDelete.each(function (index, element) {
            $(element).on('click', function () {
                subContentList = subContentList.filter((val, i) => {
                    return index != i
                })
                callback(subContentList);
            })
        });
    };

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
                        window.loadNotification(data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);

                    loadNotification({ success: false, message: xhr.responseJSON.message })
                }
            })
        } else {
            loadNotification({ success: false, message: 'Please add sub content for post' })
        }

    })
})

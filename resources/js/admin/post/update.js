$().ready(function () {
    let subContentList = [];
    const PUBLIC = 'PUBLIC';
    const BASE64 = 'BASE64';
    let subItemSelect = null;

    const getListSubcontent = function () {

        let textAreaContentElement = $('#post-content');
        subContentList.push(...(addTypePublicForImageGetFromDB(JSON.parse(textAreaContentElement.text()))));
    }

    const addTypePublicForImageGetFromDB = function (subContentList) {
        return subContentList.map(element => {
            return { ...element, type: PUBLIC }
        });
    }

    const renderImages = function (subContentList) {
        $('#content-detail-list').html('');
        let index = 0;
        for (const item of subContentList) {
            let div = $('<div>')
                .attr('class', 'content-detail-item d-flex justify-content-between align-items-center border')
                .append($('<img>')
                    .attr('class', 'rounded float-left object-fit-cover ml-2 img-sub-item')
                    .attr('src', item.image),
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

        addEventClickForButtonDelete();
        addEventClickForItemSubContent(subContentList);
    }

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
                let image = this.result;

                let item = {
                    content: content,
                    image: image,
                    type: BASE64
                };

                subContentList.push(item);

                renderImages(subContentList);

            };

            reader.readAsDataURL(file);
        }
    });

    $('#update-subcontent').on('click', function () {
        let elementFile = $('#file');
        let file = $(elementFile).prop('files')[0];
        let content = tinymce.get("content").getContent();
        let item = {
            content: content,
            type: PUBLIC
        }

        if (content.length == 0) {
            loadNotification({ success: false, message: 'Please enter sub content for post' })
            return;
        }

        if (file) {
            let reader = new FileReader();
            reader.onloadend = function () {
                let imagePath = this.result;
                item.image = imagePath;
                item.type = BASE64;
                subContentList[subItemSelect] = item;

                renderImages(subContentList);
            };

            reader.readAsDataURL(file);
        } else {
            item.image = elementFile.attr('src');
            subContentList[subItemSelect] = item;
            renderImages(subContentList);
        }

        tinymce.get("content").setContent("");
        elementFile.val('');
        disabledAddSubcontent(false)
    })

    function addEventClickForItemSubContent(subContentList) {
        let elementsDetailItem = $('.content-detail-item');
        elementsDetailItem.each(function (index, element) {
            $(element).on('click', function () {
                let elementFile = $('#file');
                let elementContent = $('#content');

                let subImage = $(this).children()[0];
                let subContent = $(this).children()[1];

                elementFile.attr('src', $(subImage).attr('src'));
                tinymce.get("content").setContent($(subContent).text());
                subItemSelect = index;

                disabledAddSubcontent();
            })
        });
    }

    function disabledAddSubcontent(isDisabled = true) {
        if (!isDisabled) {

            $('#add-image').attr('disabled', false);
            $('#update-subcontent').attr('disabled', true);
        } else {
            $('#add-image').attr('disabled', true);
            $('#update-subcontent').attr('disabled', false);
        }

    }

    function addEventClickForButtonDelete() {
        let elementsButtonDelete = $('.btn-delete-sub-content-item');
        elementsButtonDelete.each(function (index, element) {
            $(element).on('click', function () {
                subContentList = subContentList.filter((val, i) => {
                    return index != i
                })
                renderImages(subContentList);
            })
        });
    };

    $('.btn-update-post').on('click', function (e) {
        const form = $("#post-form");
        let id = $('#post-id').val();
        console.log(subContentList);
        if (form.valid() && subContentList.length && id) {
            let title = $('#title').val();
            let contentTitle = $('#content_title').val();
            let imageTitleFile = $('#image_title').prop('files')[0];
            let category = $('#category').find(":selected").val();

            const data = new FormData();
            data.append('title', title);
            data.append('content_title', contentTitle);
            data.append('content', JSON.stringify(subContentList));
            data.append('category', category);

            if (imageTitleFile) {
                data.append('image_title', imageTitleFile);
            } else {
                data.append('image_title', $('#image_title').attr('value'));
            }
            e.preventDefault();
            $.ajax({
                url: `/admin/post/update/${id}`,
                type: 'POST',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    loadNotification(data)
                },
                error: function (xhr) {
                    loadNotification({ success: false, message: xhr.responseJSON.message })
                }
            })
        } else {
            loadNotification({ success: false, message: 'Please add sub content for post' })
        }

    })


    getListSubcontent();
    renderImages(subContentList);
})

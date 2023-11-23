$().ready(function () {
    tinymce.init({
        selector: '#content',
        skin: false,
        content_css: false,
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    });

    const subContentList = [];
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

        addEventClickForButtonDelete(renderImages, subContentList);
        addEventClickForItemSubContent(subContentList);
    }

    $('#add-image').on('click', function () {
        let elementFile = $('#file');
        let file = $(elementFile).prop('files')[0];
        let content = tinymce.get("content").getContent();

        elementFile.val('');
        tinymce.get("content").setContent("");
        if (file) {
            let reader = new FileReader();
            reader.onloadend = function () {
                let imagePath = this.result;

                let item = {
                    content: content,
                    'image': imagePath,
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
        let elementContent = $('#content');
        let file = $(elementFile).prop('files')[0];
        let content = tinymce.get("content").getContent();
        let item = {
            content: content,
            type: PUBLIC
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

    const loadNotification = function ({ success, message }) {
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

    $('.btn-update-post').on('click', function (e) {
        const form = $("#post-form");
        let id = $('#post-id').val();
        if (form.valid() && subContentList.length && id) {
            let title = $('#title').val();
            let contentTitle = $('#content_title').val();
            let imageTitleFile = $('#image_title').prop('files')[0];

            const data = new FormData();
            data.append('title', title);
            data.append('content_title', contentTitle);
            data.append('content', JSON.stringify(subContentList));

            if(imageTitleFile) {
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
                error: function (xhr, status, error) {
                    console.log(error);

                    loadNotification({ success: false, message: xhr.responseJSON.message })
                }
            })
        }

    })


    getListSubcontent();
    renderImages(subContentList);
})
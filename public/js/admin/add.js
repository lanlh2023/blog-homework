/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/admin/post/add.js ***!
  \****************************************/
$().ready(function () {
  var imageDetailList = [];
  var elementListImage = $('.list-image');
  $('#form-add-images').on('submit', function (e) {
    e.preventDefault();
    var file = $('#image')[0].files[0];
    var description = $('#description').val();
    imageDetailList.push({
      file: file,
      description: description
    });
    var formData = new FormData();
    formData.append('file', file);
    formData.append('description', description);
    $.ajax({
      url: "/admin/image/uploadTempImage",
      type: 'POST',
      data: formData,
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      processData: false,
      contentType: false,
      success: function success(data) {
        console.log(data);
      }
    });
  });
});
/******/ })()
;
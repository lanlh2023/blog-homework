/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/admin/post/add.js ***!
  \****************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
$().ready(function () {
  tinymce.init({
    selector: '#content',
    skin: false,
    content_css: false,
    toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });
  var subContentList = [];
  $('#add-image').on('click', function () {
    var elementFile = $('#file');
    var file = $(elementFile).prop('files')[0];
    var content = tinymce.get("content").getContent();
    elementFile.val('');
    tinymce.get("content").setContent("");
    if (content.length == 0) {
      loadNotification({
        success: false,
        message: 'Please enter sub content for post'
      });
      return;
    }
    if (file) {
      var reader = new FileReader();
      reader.onloadend = function () {
        var imagePath = this.result;
        var item = {
          content: content,
          'imagePath': imagePath
        };
        subContentList.push(item);
        renderImages(subContentList);
      };
      reader.readAsDataURL(file);
    }
    function renderImages(subContentList) {
      $('#content-detail-list').html('');
      var index = 0;
      var _iterator = _createForOfIteratorHelper(subContentList),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var item = _step.value;
          var div = $('<div>').attr('class', 'content-detail-item d-flex justify-content-between align-items-center border').append($('<img>').attr('class', 'rounded float-left object-fit-cover ml-2 img-sub-item').attr('src', item.imagePath)).append($('<div>').attr('class', 'content-detail-body w-50').append(item.content)).append($('<div>').attr('class', 'btn btn-secondary btn-delete-sub-content-item mr-2').attr('data-index', index).append('x'));
          index++;
          $('#content-detail-list').append(div);
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
      addEventClickForButtonDelete(renderImages, subContentList);
    }
  });
  function addEventClickForButtonDelete(callback, subContentList) {
    var elementsButtonDelete = $('.btn-delete-sub-content-item');
    elementsButtonDelete.each(function (index, element) {
      $(element).on('click', function () {
        subContentList = subContentList.filter(function (val, i) {
          return index != i;
        });
        callback(subContentList);
      });
    });
  }
  ;
  function resetAllForm() {
    $('#content-detail-list').html('');
    $('#post-form')[0].reset();
  }
  $('.btn-add-post').on('click', function (e) {
    var form = $("#post-form");
    if (form.valid() && subContentList.length) {
      var title = $('#title').val();
      var contentTitle = $('#content_title').val();
      var imageTitle = $('#image_title').prop('files')[0];
      var data = new FormData();
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
        success: function success(data) {
          if (data.success) {
            resetAllForm();
            window.loadNotification(data);
          }
        },
        error: function error(xhr, status, _error) {
          console.log(_error);
          loadNotification({
            success: false,
            message: xhr.responseJSON.message
          });
        }
      });
    } else {
      loadNotification({
        success: false,
        message: 'Please add sub content for post'
      });
    }
  });
});
/******/ })()
;
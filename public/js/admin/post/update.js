/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/admin/post/update.js ***!
  \*******************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
$().ready(function () {
  var subContentList = [];
  var PUBLIC = 'PUBLIC';
  var BASE64 = 'BASE64';
  var subItemSelect = null;
  var getListSubcontent = function getListSubcontent() {
    var _subContentList;
    var textAreaContentElement = $('#post-content');
    (_subContentList = subContentList).push.apply(_subContentList, _toConsumableArray(addTypePublicForImageGetFromDB(JSON.parse(textAreaContentElement.text()))));
  };
  var addTypePublicForImageGetFromDB = function addTypePublicForImageGetFromDB(subContentList) {
    return subContentList.map(function (element) {
      return _objectSpread(_objectSpread({}, element), {}, {
        type: PUBLIC
      });
    });
  };
  var renderImages = function renderImages(subContentList) {
    $('#content-detail-list').html('');
    var index = 0;
    var _iterator = _createForOfIteratorHelper(subContentList),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var item = _step.value;
        var div = $('<div>').attr('class', 'content-detail-item d-flex justify-content-between align-items-center border').append($('<img>').attr('class', 'rounded float-left object-fit-cover ml-2 img-sub-item').attr('src', item.image)).append($('<div>').attr('class', 'content-detail-body w-50').append(item.content)).append($('<div>').attr('class', 'btn btn-secondary btn-delete-sub-content-item mr-2').attr('data-index', index).append('x'));
        index++;
        $('#content-detail-list').append(div);
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    addEventClickForButtonDelete();
    addEventClickForItemSubContent(subContentList);
  };
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
        var image = this.result;
        var item = {
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
    var elementFile = $('#file');
    var file = $(elementFile).prop('files')[0];
    var content = tinymce.get("content").getContent();
    var item = {
      content: content,
      type: PUBLIC
    };
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
    disabledAddSubcontent(false);
  });
  function addEventClickForItemSubContent(subContentList) {
    var elementsDetailItem = $('.content-detail-item');
    elementsDetailItem.each(function (index, element) {
      $(element).on('click', function () {
        var elementFile = $('#file');
        var elementContent = $('#content');
        var subImage = $(this).children()[0];
        var subContent = $(this).children()[1];
        elementFile.attr('src', $(subImage).attr('src'));
        tinymce.get("content").setContent($(subContent).text());
        subItemSelect = index;
        disabledAddSubcontent();
      });
    });
  }
  function disabledAddSubcontent() {
    var isDisabled = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    if (!isDisabled) {
      $('#add-image').attr('disabled', false);
      $('#update-subcontent').attr('disabled', true);
    } else {
      $('#add-image').attr('disabled', true);
      $('#update-subcontent').attr('disabled', false);
    }
  }
  function addEventClickForButtonDelete() {
    var elementsButtonDelete = $('.btn-delete-sub-content-item');
    elementsButtonDelete.each(function (index, element) {
      $(element).on('click', function () {
        subContentList = subContentList.filter(function (val, i) {
          return index != i;
        });
        renderImages(subContentList);
      });
    });
  }
  ;
  $('.btn-update-post').on('click', function (e) {
    var form = $("#post-form");
    var id = $('#post-id').val();
    console.log(subContentList);
    if (form.valid() && subContentList.length && id) {
      var title = $('#title').val();
      var contentTitle = $('#content_title').val();
      var imageTitleFile = $('#image_title').prop('files')[0];
      var category = $('#category').find(":selected").val();
      var data = new FormData();
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
        url: "/admin/post/update/".concat(id),
        type: 'POST',
        method: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function success(data) {
          loadNotification(data);
        },
        error: function error(xhr) {
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
  getListSubcontent();
  renderImages(subContentList);
});
/******/ })()
;
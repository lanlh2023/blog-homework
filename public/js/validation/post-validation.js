/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/validation/add-edit-post-form.js ***!
  \*******************************************************/
$().ready(function () {
  $('#post-form').validate({
    onclick: false,
    rules: {
      'title': {
        required: true
      },
      'image_title': {
        required: true,
        extension: 'png|jpeg|jpg',
        filesize: '1MB'
      },
      'content_title': {
        required: true
      }
    },
    messages: {
      'title': {
        required: function required() {
          return jQuery.validator.messages.required('Ttile');
        }
      },
      'image_title': {
        required: function required() {
          return jQuery.validator.messages.required('Image title');
        },
        filesize: function filesize(size) {
          return jQuery.validator.messages.filesize(size);
        },
        extension: function extension(_extension) {
          return jQuery.validator.messages.extension('IMAGE/JPG');
        }
      },
      'content_title': {
        required: function required() {
          return jQuery.validator.messages.required('Content title');
        }
      }
    },
    errorPlacement: function errorPlacement(error, element) {
      error.addClass('text-danger');
      var errorDiv = $("div.error-div.error-".concat($(element).attr('name')));
      errorDiv.html(error);
    },
    onfocusin: function onfocusin(element) {
      $('div.alert').css('display', 'none');
    },
    onkeyup: function onkeyup(element) {
      $(element).valid();
    },
    onfocusout: function onfocusout(element) {
      $(element).valid();
    },
    submitHandler: function submitHandler(form) {
      if ($(form).data('is-submitted') === undefined) {
        $(form).data('is-submitted', true);
        form.submit();
      }
    }
  });
});
/******/ })()
;
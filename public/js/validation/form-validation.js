/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/js/validation/login-form.js ***!
  \***********************************************/
$().ready(function () {
  $('#login-form').validate({
    onclick: false,
    rules: {
      'email': {
        required: true,
        email: true
      },
      'password': {
        required: true
      }
    },
    messages: {
      'email': {
        required: function required() {
          return jQuery.validator.messages.required('Email');
        },
        email: function email() {
          return jQuery.validator.messages.email();
        }
      },
      'password': {
        required: function required() {
          return jQuery.validator.messages.required('Password');
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
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!**************************************************!*\
  !*** ./resources/js/validation/register-form.js ***!
  \**************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
$().ready(function () {
  var _$$validate;
  $('#register-form').validate((_$$validate = {
    onkeyup: false,
    onclick: false,
    rules: {
      'name': {
        required: true
      },
      'email': {
        required: true,
        email: true,
        maxlength: 255,
        remote: {
          url: "/checkDuplicateEmail",
          type: "post",
          data: {
            email: function email() {
              return $("input[name='email']").val();
            },
            _token: function (_token2) {
              function _token() {
                return _token2.apply(this, arguments);
              }
              _token.toString = function () {
                return _token2.toString();
              };
              return _token;
            }(function () {
              return _token = $("input[name='_token']").val();
            })
          },
          dataFilter: function dataFilter(data) {
            if (data == 'true') {
              return false;
            }
            return true;
          }
        }
      },
      'password': {
        required: true,
        stringValueRange: [8, 20]
      },
      'password_confirmation': {
        required: function required() {
          var passWord = $('#password').val();
          return Boolean(passWord.length);
        },
        stringValueRange: [8, 20],
        equalTo: "#password"
      }
    },
    messages: {
      'name': {
        required: function required(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.required(attributeName);
        }
      },
      'email': {
        maxlength: function maxlength(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          var length = Array.from($(element).val()).length;
          return jQuery.validator.messages.max(attributeName, param, length);
        },
        required: function required(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.required(attributeName);
        },
        remote: function remote() {
          return jQuery.validator.messages.existsEmail();
        }
      },
      'password': {
        required: function required(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.required(attributeName);
        },
        stringValueRange: function stringValueRange(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.stringValueRange(attributeName, param[0], param[1]);
        }
      },
      'password_confirmation': {
        required: function required(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.required(attributeName);
        },
        stringValueRange: function stringValueRange(param, element) {
          var attributeName = $(element).data('content').slice(0, -1);
          return jQuery.validator.messages.stringValueRange(attributeName, param[0], param[1]);
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
    }
  }, _defineProperty(_$$validate, "onkeyup", function onkeyup(element) {
    $(element).valid();
  }), _defineProperty(_$$validate, "onfocusout", function onfocusout(element) {
    $(element).valid();
  }), _defineProperty(_$$validate, "submitHandler", function submitHandler(form) {
    if ($(form).data('is-submitted') === undefined) {
      $(form).data('is-submitted', true);
      form.submit();
    }
  }), _$$validate));
});
})();

/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!******************************************************!*\
  !*** ./resources/js/custom-jquery/custom-message.js ***!
  \******************************************************/
$().ready(function () {
  jQuery.extend(jQuery.validator.messages, {
    required: jQuery.validator.format('{0} is required.'),
    email: jQuery.validator.format('Please enter your e-mail address correctly.'),
    max: jQuery.validator.format('Please enter {0} with less than "{1}" characters. (currently {2} characters).'),
    date: jQuery.validator.format('Enter the correct date for {0}.'),
    greaterStart: jQuery.validator.format('Please specify the contract end date as the scheduled cancellation date.'),
    equalTo: jQuery.validator.format('The confirmation password is incorrect.'),
    existsEmail: jQuery.validator.format('Your email address is already registered.'),
    extension: jQuery.validator.format('Incorrect file format. Please select {0}.'),
    filesize: jQuery.validator.format('File size limit {0} exceeded.'),
    stringValueRange: jQuery.validator.format('Enter the password in 8 to 20 characters.')
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*****************************************************!*\
  !*** ./resources/js/custom-jquery/custom-method.js ***!
  \*****************************************************/
$().ready(function () {
  $.validator.addMethod('filesize', function (value, element, param) {
    var size = param.split('MB')[0] * 1024 * 1024;
    return this.optional(element) || size !== NaN && element.files[0].size <= size;
  });
  $.validator.addMethod('extension', function (value, element, param) {
    param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g';
    return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
  });
  $.validator.addMethod('email', function (value, element) {
    var regexIfHasQuotes = /^["].+["]@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
    var regexForEmail = /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
    if (regexIfHasQuotes.test(value)) {
      return true;
    }
    return this.optional(element) || regexForEmail.test(value);
  });
  $.validator.addMethod('stringValueRange', function (value, element, param) {
    return this.optional(element) || param[0] <= value.length && value.length <= param[1];
  });
});
})();

/******/ })()
;
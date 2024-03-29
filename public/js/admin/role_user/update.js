/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/admin/role_user/update.js ***!
  \************************************************/
$().ready(function () {
  $('.btn-update-role').on('click', function () {
    var elementTr = $(this).closest('.item-user');
    var tdIncludeSelect = $(elementTr).children("td.role_user_td")[0];
    var select = $(tdIncludeSelect).children()[0];
    var roleId = $(select).val();
    var idUserElement = $(elementTr).children("td.user_id").children()[0];
    var userId = $(idUserElement).text();
    var data = new FormData();
    data.append('userId', userId);
    data.append('roleId', roleId);
    $.ajax({
      url: "/admin/role_user/store",
      type: 'POST',
      method: 'POST',
      data: data,
      processData: false,
      contentType: false,
      success: function success(data) {
        loadNotification(data);
      },
      error: function error(xhr, status, _error) {
        loadNotification({
          success: false,
          message: xhr.responseJSON.message
        });
      }
    });
  });
});
/******/ })()
;
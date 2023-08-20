/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/js/pages/change-record-status.js ***!
  \****************************************************/
window.changeStatus = function (changesStatusUrl) {
  var tableName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var redirectUrl = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  Swal.fire({
    title: "Are you sure that you want to change status of this record?",
    // text: "You will not be able to recover record!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28D094",
    confirmButtonText: "Yes, change it!",
    cancelButtonText: "No, cancel please!"
  }).then(function (result) {
    if (result.value) {
      Swal.fire("Status Changed!", "Your record has been changed.", "success");

      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function () {
        if (tableName) {
          $("#".concat(tableName)).DataTable().ajax.reload();
        } else {
          window.location.href = redirectUrl + '?n=' + new Date().getTime(); // Simulate an HTTP redirect:
        }
      };

      xmlhttp.open("GET", changesStatusUrl, true);
      xmlhttp.send();
    } else {
      Swal.fire("Cancelled", "Your record status change is cancelled :)", "error");
    }
  });
};
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/pages/delete-record.js ***!
  \*********************************************/
window.deleteRecord = function (deleteUrl) {
  var tableName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var redirectUrl = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  Swal.fire({
    title: "Are you sure that you want to delete this record?",
    text: "You will not be able to recover record!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28D094",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel please!"
  }).then(function (result) {
    console.log(tableName);

    if (result.value) {
      Swal.fire("Deleted!", "Your record has been deleted.", "success");

      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function () {
        if (tableName) {
          $("#".concat(tableName)).DataTable().ajax.reload();
        } else {
          window.location.href = redirectUrl;
        }
      };

      xmlhttp.open("GET", deleteUrl, true);
      xmlhttp.send();
    } else {
      Swal.fire("Cancelled", "Your record status is safe :)", "error");
    }
  });
};
/******/ })()
;
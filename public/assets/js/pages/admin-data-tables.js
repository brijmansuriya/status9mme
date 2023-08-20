/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/pages/admin-data-tables.js ***!
  \*************************************************/
$(document).ready(function () {
  var url = JSON.parse(document.getElementById("dataTableUrl").value);
  $("#adminDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [{
      data: "id",
      name: "id"
    }, {
      data: "image",
      name: "image",
      orderable: false,
      searchable: false
    }, {
      data: "name",
      name: "name"
    }, {
      data: "email",
      name: "email"
    }, {
      data: "created_at",
      name: "created_at",
      orderable: false,
      searchable: false
    }, {
      data: "action",
      name: "action",
      orderable: false,
      searchable: false
    }],
    order: [0, "desc"]
  });
});
/******/ })()
;
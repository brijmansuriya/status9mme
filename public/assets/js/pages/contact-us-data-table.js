/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/js/pages/contact-us-data-table.js ***!
  \*****************************************************/
$(document).ready(function () {
  $("#contactUsDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: JSON.parse(document.getElementById("dataTableUrl").value),
    columns: [{
      data: "id",
      name: "id"
    }, {
      data: "name",
      name: "name"
    }, {
      data: "email",
      name: "email"
    }, {
      data: "phone",
      name: "phone"
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
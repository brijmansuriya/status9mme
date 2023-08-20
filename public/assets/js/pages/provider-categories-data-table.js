/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./resources/js/pages/provider-categories-data-table.js ***!
  \**************************************************************/
$(document).ready(function () {
  $("#categoryDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: JSON.parse(document.getElementById("providerCategorydataTableUrl").value),
    columns: [{
      data: "id",
      name: "id"
    }, {
      data: "image",
      name: "image"
    }, {
      data: "name",
      name: "name"
    }, {
      data: "status",
      name: "status"
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
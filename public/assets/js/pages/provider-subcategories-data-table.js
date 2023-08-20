/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************************!*\
  !*** ./resources/js/pages/provider-subcategories-data-table.js ***!
  \*****************************************************************/
$(document).ready(function () {
  $("#subcategoryDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: JSON.parse(document.getElementById("providerSubCategorydataTableUrl").value),
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
      data: "kyc_status",
      name: "kyc_status"
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
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************************!*\
  !*** ./resources/js/pages/app-link-settings-data-table.js ***!
  \************************************************************/
$(document).ready(function () {
  var url = JSON.parse(document.getElementById("dataTableUrl").value);
  $("#appSettingsDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [{
      data: "show_name",
      name: "name"
    }, {
      data: "generated_link",
      name: "generated_link"
    }, {
      data: "updated_at",
      name: "updated_at"
    }, {
      data: "action",
      name: "action",
      orderable: false,
      searchable: false
    }],
    order: [2, "desc"]
  });
});
/******/ })()
;
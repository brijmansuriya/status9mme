/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/pages/app-settings-data-table.js ***!
  \*******************************************************/
$(document).ready(function () {
  var url = JSON.parse(document.getElementById("dataTableUrl").value);
  $("#appSettingsDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [// { data: "app_name", name: "app_name" },
    {
      data: "app_label",
      name: "app_label"
    }, {
      data: "app_version",
      name: "app_version"
    }, {
      data: "force_updates",
      name: "force_updates"
    }, {
      data: "maintenance_mode",
      name: "maintenance_mode"
    }, {
      data: "updated_at",
      name: "updated_at"
    }, {
      data: "action",
      name: "action",
      orderable: false,
      searchable: false
    }],
    order: [3, "desc"]
  });
});
/******/ })()
;
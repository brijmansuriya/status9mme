/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/pages/provider-job-data-table.js ***!
  \*******************************************************/
$(document).ready(function () {
  $("#providerJobDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: JSON.parse(document.getElementById("dataTableUrl").value),
    columns: [{
      data: "id",
      name: "id"
    }, // {
    //     data: "job_id",
    //     name: "job_id",
    // },
    {
      data: "provider_id",
      name: "provider_id"
    }, {
      data: "email",
      name: "email",
      orderable: false,
      searchable: false
    }, {
      data: "phone",
      name: "phone"
    }, {
      data: "y_tunnus_number",
      name: "y_tunnus_number",
      orderable: false,
      searchable: false
    }, {
      data: "created_at",
      name: "created_at"
    }],
    order: [0, "desc"]
  });
});
/******/ })()
;
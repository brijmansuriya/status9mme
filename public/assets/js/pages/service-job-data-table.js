/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/js/pages/service-job-data-table.js ***!
  \******************************************************/
$(document).ready(function () {
  $("#serviceJobDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: JSON.parse(document.getElementById("dataTableUrl").value),
    columns: [{
      data: "id",
      name: "id"
    }, // {
    //     data: "provider_id",
    //     name: "provider_id",
    // },
    // {
    //     data: "job_time_id",
    //     name: "job_time_id",
    // },
    {
      data: "description",
      name: "description"
    }, {
      data: "materials",
      name: "materials"
    }, {
      data: "status",
      name: "status"
    }, {
      data: "hourly_price",
      name: "hourly_price"
    }, {
      data: "as_draft",
      name: "as_draft"
    }, // {
    //     data: "total_payout_to_provider",
    //     name: "total_payout_to_provider",
    // },
    // {
    //     data: "accepted_at",
    //     name: "accepted_at",
    // },
    {
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
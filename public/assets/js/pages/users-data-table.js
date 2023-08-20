/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/pages/users-data-table.js ***!
  \************************************************/
$(document).ready(function () {
  var table = $("#customersDataTable").DataTable({
    processing: true,
    serverSide: true,
    // ajax: JSON.parse(document.getElementById("dataTableUrl").value),
    ajax: {
      url: JSON.parse(document.getElementById("dataTableUrl").value),
      data: function data(d) {
        d.range = $("#range-datepicker").val();
      }
    },
    columns: [{
      data: "id",
      name: "id"
    }, {
      data: "first_name",
      name: "first_name"
    }, {
      data: "last_name",
      name: "last_name"
    }, {
      data: "company_email",
      name: "company_email"
    }, {
      data: "phone",
      name: "phone"
    }, {
      data: "status",
      name: "status",
      orderable: false,
      searchable: false
    }, {
      data: "booth_number",
      name: "booth_number",
      orderable: false,
      searchable: false
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
  $("#searchrange").on("click", function () {
    table.draw();
    console.log($("#range-datepicker").val());
  });
});
/******/ })()
;
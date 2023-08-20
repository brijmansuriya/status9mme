/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/pages/visitor-data-table.js ***!
  \**************************************************/
$(document).ready(function () {
  var table = $("#providerDataTable").DataTable({
    processing: true,
    serverSide: true,
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
      data: "email",
      name: "email"
    }, {
      data: "phone",
      name: "phone"
    }, {
      data: "status",
      name: "status",
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

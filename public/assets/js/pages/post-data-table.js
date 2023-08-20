/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/pages/post-data-table.js ***!
  \***********************************************/
$(document).ready(function () {
  var url = JSON.parse(document.getElementById("dataTableUrl").value);
  $("#postsDataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [{
      data: "image",
      name: "image"
    }, {
      data: "title",
      name: "title"
    }, {
      data: "slug",
      name: "slug"
    }, {
      data: "status",
      name: "status"
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
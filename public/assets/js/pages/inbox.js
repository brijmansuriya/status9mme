/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/pages/inbox.js ***!
  \*************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Inbox init js
*/
$('input:checkbox').change(function () {
  if ($(this).is(":checked")) {
    $(this).parent().parent().parent().addClass("mail-selected");
  } else {
    $(this).parent().parent().parent().removeClass("mail-selected");
  }
});
/******/ })()
;
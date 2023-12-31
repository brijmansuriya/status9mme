/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/pages/coming-soon.init.js ***!
  \************************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Coming Soon init js
*/
$('[data-countdown]').each(function () {
  var $this = $(this),
      finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function (event) {
    $(this).html(event.strftime('' + '<div class="coming-box">%D <span>Days</span></div> ' + '<div class="coming-box">%H <span>Hours</span></div> ' + '<div class="coming-box">%M <span>Minutes</span></div> ' + '<div class="coming-box">%S <span>Seconds</span></div> '));
  });
});
/******/ })()
;
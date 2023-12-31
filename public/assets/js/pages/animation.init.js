/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/pages/animation.init.js ***!
  \**********************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Animation demo only
*/
function testAnim(x) {
  $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
    $(this).removeClass();
  });
}

;
$(document).ready(function () {
  $('.js--triggerAnimation').click(function (e) {
    e.preventDefault();
    var anim = $('.js--animations').val();
    testAnim(anim);
  });
  $('.js--animations').change(function () {
    var anim = $(this).val();
    testAnim(anim);
  });
});
/******/ })()
;
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/pages/widgets.init.js ***!
  \********************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Widgets init js
*/
$(document).ready(function () {
  var DrawSparkline = function DrawSparkline() {
    $('#sparkline1').sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 50,
      lineColor: '#00acc1',
      fillColor: 'rgba(0, 172, 193, 0.2)',
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#sparkline1').sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
      type: 'line',
      width: "100%",
      height: '165',
      chartRangeMax: 40,
      lineColor: '#f1556c',
      fillColor: 'rgba(229, 43, 76, 0.3)',
      composite: true,
      highlightLineColor: 'rgba(0,0,0,.1)',
      highlightSpotColor: 'rgba(0,0,0,.2)',
      maxSpotColor: false,
      minSpotColor: false,
      spotColor: false,
      lineWidth: 1
    });
    $('#sparkline2').sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
      type: 'bar',
      height: '165',
      barWidth: '10',
      barSpacing: '3',
      barColor: '#00acc1'
    });
    $('#sparkline3').sparkline([20, 40, 30, 10], {
      type: 'pie',
      width: '165',
      height: '165',
      sliceColors: ['#00acc1', '#4b88e4', '#e3eaef', '#fd7e14']
    });
  };

  DrawSparkline();
  var resizeChart;
  $(window).resize(function (e) {
    clearTimeout(resizeChart);
    resizeChart = setTimeout(function () {
      DrawSparkline();
      DrawMouseSpeed();
    }, 300);
  });
});
/******/ })()
;
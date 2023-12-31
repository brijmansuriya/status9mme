/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/pages/kanban.init.js ***!
  \*******************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Kanban Board init js
*/
!function ($) {
  "use strict";

  var KanbanBoard = function KanbanBoard() {
    this.$body = $("body");
  };

  $("#upcoming, #inprogress, #completed").sortable({
    connectWith: ".taskList",
    placeholder: 'task-placeholder',
    forcePlaceholderSize: true,
    update: function update(event, ui) {
      var todo = $("#todo").sortable("toArray");
      var inprogress = $("#inprogress").sortable("toArray");
      var completed = $("#completed").sortable("toArray");
    }
  }).disableSelection(); //initializing various charts and components

  KanbanBoard.prototype.init = function () {}, //init KanbanBoard
  $.KanbanBoard = new KanbanBoard(), $.KanbanBoard.Constructor = KanbanBoard;
}(window.jQuery), //initializing KanbanBoard
function ($) {
  "use strict";

  $.KanbanBoard.init();
}(window.jQuery);
/******/ })()
;
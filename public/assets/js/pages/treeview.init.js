/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/pages/treeview.init.js ***!
  \*********************************************/
/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Treeview init js
*/
$(document).ready(function () {
  // Basic
  $('#basicTree').jstree({
    'core': {
      'themes': {
        'responsive': false
      }
    },
    'types': {
      'default': {
        'icon': 'md md-folder'
      },
      'file': {
        'icon': 'md md-insert-drive-file'
      }
    },
    'plugins': ['types']
  }); // Checkbox

  $('#checkTree').jstree({
    'core': {
      'themes': {
        'responsive': false
      }
    },
    'types': {
      'default': {
        'icon': 'fa fa-folder'
      },
      'file': {
        'icon': 'fa fa-file'
      }
    },
    'plugins': ['types', 'checkbox']
  }); // Drag & Drop

  $('#dragTree').jstree({
    'core': {
      'check_callback': true,
      'themes': {
        'responsive': false
      }
    },
    'types': {
      'default': {
        'icon': 'fa fa-folder'
      },
      'file': {
        'icon': 'fa fa-file'
      }
    },
    'plugins': ['types', 'dnd']
  }); // Ajax

  $('#ajaxTree').jstree({
    'core': {
      'check_callback': true,
      'themes': {
        'responsive': false
      },
      'data': {
        'url': function url(node) {
          return node.id === '#' ? '../plugins/jstree/ajax_roots.json' : '../plugins/jstree/ajax_children.json';
        },
        'data': function data(node) {
          return {
            'id': node.id
          };
        }
      }
    },
    "types": {
      'default': {
        'icon': 'fa fa-folder'
      },
      'file': {
        'icon': 'fa fa-file'
      }
    },
    "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
  });
});
/******/ })()
;
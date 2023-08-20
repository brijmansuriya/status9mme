/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/pages/edit-app-settings.js ***!
  \*************************************************/
window.updateAppSettings = function (updateUrl, app_name, app_label, app_version, force_updates, maintenance_mode) {
  // document.getElementById("updateAppName").setAttribute("value", app_name);
  document.getElementById("updateAppLabel").setAttribute("value", app_label);
  document.getElementById("updateAppVersion").setAttribute("value", app_version); // document
  //     .getElementById("updateAppUpdates")
  //     .setAttribute("value", force_updates);

  if (force_updates == 1) {
    document.getElementById("updateAppUpdates").checked = true;
  } else {
    document.getElementById("updateAppUpdates").checked = false;
  } // document
  // .getElementById("updateAppMaintenanceMode")
  // .setAttribute("value", maintenance_mode);
  // check if maintenance mode is enabled


  if (maintenance_mode == 1) {
    document.getElementById("updateAppMaintenanceMode").checked = true;
  } else {
    document.getElementById("updateAppMaintenanceMode").checked = false;
  }

  document.getElementById("updateappSettings").action = updateUrl;
  $("#con-close-modal").modal("show");
};
/******/ })()
;
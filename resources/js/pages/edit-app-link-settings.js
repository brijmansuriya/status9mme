window.updateAppSettings = function(
    updateUrl,
    app_name,
    app_label,
    app_version,
    updates
) {
    // document.getElementById("updateAppName").setAttribute("value", app_name);
    document.getElementById("updateAppLabel").setAttribute("value", app_label);
    document
        .getElementById("updateAppVersion")
        .setAttribute("value", app_version);
    document.getElementById("updateAppUpdates").setAttribute("value", updates);
    document.getElementById("updateappSettings").action = updateUrl;
    $("#con-close-modal").modal("show");
};

window.updateAppVariablesSettings = function(updateUrl, name, key, value) {
    // document.getElementById("updateAppName").setAttribute("value", app_name);
    document.getElementById("updateName").setAttribute("value", name);
    document.getElementById("updateValue").setAttribute("value", value);
    // document.getElementById("updateKey").setAttribute("value", key);
    document.getElementById("updateAppVariableSettings").action = updateUrl;
    $("#con-close-modal").modal("show");
};

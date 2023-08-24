$(document).ready(function() {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#appVariableDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "name", name: "name" },
            { data: "value", name: "value" },
            { data: "updated_at", name: "updated_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ],
        order: [2, "desc"]
    });
});

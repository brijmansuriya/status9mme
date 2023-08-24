$(document).ready(function () {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#bulkUploadDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "id", name: "id" },
            { data: "path", name: "path" },
            { data: "type", name: "type" },
            {
                data: "created_at",
                name: "created_at",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        order: [0, "desc"],
    });
});

$(document).ready(function () {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#movieDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "id", name: "id" },
            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name" },
            { data: "runtime", name: "runtime"},
            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
            },
            { data: "video_status", name: "video_status" },
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

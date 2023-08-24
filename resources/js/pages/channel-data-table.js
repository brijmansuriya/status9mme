$(document).ready(function () {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#channelDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            {
                data: "id",
                name: "id",
                orderable: true,
                searchable: true,
            },
            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name" },
            {
                data: "status",
                name: "status",
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

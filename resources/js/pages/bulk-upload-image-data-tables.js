$(document).ready(function () {
    var url = JSON.parse(document.getElementById("dataTableImageUrl").value);
    $("#bulkUploadImageDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
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

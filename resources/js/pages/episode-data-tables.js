$(document).ready(function () {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#episodeDataTable").DataTable({
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
            {
                data: "title",
                name: "title",
            },
            {
                data: "runtime",
                name: "runtime",
            },
            {
                data: "number",
                name: "number",
            },
            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
            },
            { data: "video_status", name: "video_status" },
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

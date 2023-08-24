$(document).ready(() => {
    $("#songDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("artistSongdataTableUrl").value),
        columns: [
            { data: "id", name: "id" },
            {
                data: "image",
                name: "image",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "type",
                name: "type",
            },
            {
                data: "count",
                name: "count",
            },
            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
            },
            // {
            //     data: "created_at",
            //     name: "created_at",
            // },
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


$(document).ready(() => {
    $("#bannerDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "id", name: "id"},
            { 
                data: "image",
                name: "image",
                orderable: false,
                searchable: false,
            },
            { data: "title", name: "title" },
            { data: "bannerable_type", name: "bannerable_type" },
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

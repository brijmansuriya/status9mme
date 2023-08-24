$(document).ready(() => {
    $("#liveEventDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "id", name: "id" },
            {
                data: "name",
                name: "name",
            },
            {
                data: "description",
                name: "description",
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

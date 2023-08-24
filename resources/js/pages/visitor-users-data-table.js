$(document).ready(() => {
    $("#visitorExhibitorDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "id", name: "id"},
            { data: "first_name", name: "first_name" },
            { data: "last_name", name: "last_name" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
            },
            {
                data: "booth_number",
                name: "booth_number",
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

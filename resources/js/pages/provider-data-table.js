$(document).ready(() => {
    $("#providerDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "id", name: "id" },
            {
                data: "full_name",
                name: "full_name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "phone",
                name: "phone",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data:"y_tunnus_number",
                name:"y_tunnus_number",
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
        order: [0, "desc"]
    });
});

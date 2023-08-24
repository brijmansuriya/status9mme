$(document).ready(() => {
    $("#exhibitorMemberDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "DT_RowIndex", name: "id" },
            { data: "title", name: "title" },
            { data: "first_name", name: "first_name" },
            { data: "last_name", name: "last_name" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            { data: "batch", name: "batch" },
            // {
            //     data: "status",
            //     name: "status",
            //     orderable: false,
            //     searchable: false,
            // },
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

$(document).ready(function() {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    console.log(url);
    $("#notificationDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: JSON.parse(document.getElementById("dataTableUrl").value),
        columns: [
            { data: "notification_title", name: "notification_title" },
            { data: "notification_text", name: "notification_text" },
            { 
                data: "created_on",
                name: "created_on",
                orderable: false,
                searchable: false,
            },{
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }
        ],
        order: [2, "desc"]
    });
});

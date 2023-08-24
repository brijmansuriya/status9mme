

$(document).ready(function() {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#kycVerificationDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "id", name: "id" },
            { 
                data: "provider_id",
                name: "provider_id", 
                orderable: false,
                searchable: false,
            },
            { data: "category_id", name: "category_id" },
            { data: "sub_category_id", name: "sub_category_id" },
            { data:"kyc_verification_status",name:"kyc_verification_status"},
            { data:"created_at",name:"created_at"},
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ],
        order: [0, "desc"]
    });
});

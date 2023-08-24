window.deleteRecord = function (
    deleteUrl,
    tableName = null,
    redirectUrl = null
) {
    Swal.fire({
        title: "Are you sure that you want to delete this record?",

        text: "You will not be able to recover record!",

        icon: "warning",

        showCancelButton: true,

        confirmButtonColor: "#28D094",

        confirmButtonText: "Yes, delete it!",

        cancelButtonText: "No, cancel please!",
    }).then((result) => {
        console.log(tableName);
        if (result.value) {
            Swal.fire("Deleted!", "Your record has been deleted.", "success");

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (tableName) {
                    $(`#${tableName}`).DataTable().ajax.reload();
                } else {
                    window.location.href = redirectUrl;
                }
            };

            xmlhttp.open("GET", deleteUrl, true);

            xmlhttp.send();
        } else {
            Swal.fire("Cancelled", "Your record status is safe :)", "error");
        }
    });
};

window.changeStatus = function(
    changesStatusUrl,
    tableName = null,
    redirectUrl = null
) {
    Swal.fire({
        title: "Are you sure that you want to change status of this record?",

        // text: "You will not be able to recover record!",

        icon: "warning",

        showCancelButton: true,

        confirmButtonColor: "#28D094",

        confirmButtonText: "Yes, change it!",

        cancelButtonText: "No, cancel please!"
    }).then(result => {
        if (result.value) {
            Swal.fire(
                "Status Changed!",
                "Your record has been changed.",
                "success"
            );
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (tableName) {
                    $(`#${tableName}`)
                        .DataTable()
                        .ajax.reload();
                } else {
                    window.location.href = redirectUrl+ '?n=' + new Date().getTime();
                    // Simulate an HTTP redirect:
                }
            };

            xmlhttp.open("GET", changesStatusUrl, true);

            xmlhttp.send();
        } else {
            Swal.fire(
                "Cancelled",
                "Your record status change is cancelled :)",
                "error"
            );
        }
    });
};

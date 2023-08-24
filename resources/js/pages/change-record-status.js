window.changeStatus = function(changesStatusUrl, tableName = null, redirectUrl = null) {
    Swal.fire({
        // ...
    }).then(result => {
        if (result.value) {
            // ...
            let xmlhttp; // Declare the xmlhttp variable here

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4) {
                    if (xmlhttp.status === 200) {
                        try {
                            const response = JSON.parse(xmlhttp.responseText);
                            if (response.status === 'success') {
                                Swal.fire("Status Changed!", response.message, "success");
                            } else {
                                Swal.fire("Error", response.message, "error");
                            }
                        } catch (error) {
                            Swal.fire("Error", "An error occurred while processing the response.", "error");
                        }
                    } else {
                        Swal.fire("Error", "An error occurred during the request.", "error");
                    }
                    // ...
                }
            };
            // ...
        } else {
            Swal.fire("Cancelled", "Your record status change is cancelled :)", "error");
        }
    });
};

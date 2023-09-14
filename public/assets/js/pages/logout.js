$(document).ready(function () {
    $(".alert-success").fadeIn().delay(5000).fadeOut();
    $(".alert-danger").delay(5000).fadeOut();
});

$("#logout").click(function (e) {
    Swal.fire({
        title: "Are you sure you want to Logout?",
        showCancelButton: true,

        confirmButtonColor: "#28D094",

        confirmButtonText: "Yes",

        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: '/logout',
                type: "POST",
                success: function (data) {
                    // location.reload();
                },
                error: function (data) {
                    // location.reload();
                },
            });
        } else {
            Swal.fire("Cancelled", "", "error");
        }
    });
});

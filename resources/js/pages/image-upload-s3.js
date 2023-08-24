var imageQueueComplete = false;
var imageProcessing = false;

const presignedUrlRoute = JSON.parse(
    document.getElementById("presignedUrlRoute").value
);
Dropzone.autoDiscover = false;
var formData = new FormData();
const acceptedFiles = ["image/jpeg", "image/png", "image/jpg", "image/webp"];

let options = {
    // The URL will be changed for each new file being processing
    url: "/",
    acceptedFiles: acceptedFiles.toString(","),
    // Since we're going to do a `PUT` upload to S3 directly
    method: "put",

    // Hijack the xhr.send since Dropzone always upload file by using formData
    sending(file, xhr) {
        let _send = xhr.send;
        xhr.send = () => {
            _send.call(xhr, file);
        };
    },

    // Upload one file at a time since we're using the S3 pre-signed URL scenario
    // parallelUploads: 1,
    // uploadMultiple: false,
    maxFiles: 1,
    maxFilesize: 1024 * 5,

    // Content-Type should be included, otherwise you'll get a signature
    // mismatch error from S3. We're going to update this for each file.
    header: "",

    // We're going to process each file manually (see `accept` below)
    autoProcessQueue: false,
    addRemoveLinks: true,

    // Here we request a signed upload URL when a file being accepted
    accept(file, done) {
        getPresignedUrl({
            fileName: file.name,
            uploadPath: $("#type").val() + "/images",
        })
            .then((data) => {
                file.uploadURL = data.data.presignedUrl;
                file.showUrl = data.data.downloadUrl;
                file.uploadPath = data.data.key;
                file.fileUrl = data.data.fileUrl;
                done();
            })
            .catch((err) => {
                done("Failed to get an S3 signed upload URL", err);
            });
    },
    error: function () {
        this.on("error", function (file, message, xhr) {
            if (xhr == null) this.removeFile(file);
            $("#imageError").text("File type must be in jpeg, jpg, png, webp");
            return false;
        });
    },
};

// Instantiate Dropzone
const dropzoneImage = new Dropzone(
    document.getElementById("dropzoneFormImage"),
    options
);

dropzoneImage.on("addedfile", function (file) {
    imageProcessing = true;
    console.log("addedfile Image", file);
});

dropzoneImage.on("removedfile", function (file) {
    console.log("removedfile Image", file);
    removeOnclickFormSubmit();
    imageProcessing = false;
    enabledSubmit();
});

// Set signed upload URL for each file
dropzoneImage.on("processing", (file) => {
    imageQueueComplete = true;
    console.log("processing file", file.uploadURL);
    $("#imageUploadPath").val(file.fileUrl);
    dropzoneImage.options.url = file.uploadURL;
});

// Set signed upload URL for each file
dropzoneImage.on("queuecomplete", (file) => {
    console.log("completed all files upload");
    if (imageProcessing && imageQueueComplete) {
        ajaxSubmit();
    }
});

async function getPresignedUrl(data = {}) {
    // form action change javascript:void(0)
    $("#submit").attr("action", "javascript:void(0)");
    // submit-btn add onclick event add
    $(".submit-btn").attr("onclick", "submitForm()");
    // Default options are marked with *
    const response = await fetch(presignedUrlRoute, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        // mode: 'cors', // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        // credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

async function submitForm() {
    $("#submit").parsley();
    // if ($("#imageVal").val() == "") {
    //     $("#imageError").html("Please upload image");
    //     return false;
    // }
    if ($("#submit").parsley().isValid()) {
        disabledSubmit();
        dropzoneImage.processQueue();
    }
}

function disabledSubmit() {
    $(".submit-btn").attr("disabled", true);
    $(".spinner-border").removeClass("d-none");
    $(".btn-default").text("Loading...");
}

function enabledSubmit() {
    $(".submit-btn").attr("disabled", false);
    $(".spinner-border").addClass("d-none");
    $(".btn-default").text("Submit");
}

function removeOnclickFormSubmit() {
    $("#imageUploadPath").val("");
    $("#submit").attr("action", $("#ajaxUrl").val());
    $(".submit-btn").removeAttr("onclick");
}

// submit form
function ajaxSubmit() {
    // upload sucess and ajax request to save data to database
    $("#loader").show();
    $.ajax({
        url: $("#ajaxUrl").val(),
        type: "POST",
        data: $("#submit").serialize(),
        success: function (data) {
            $("#loader").hide();
            console.log(data);
            window.location.href = $("#ajaxSuccessUrl").val();
        },
        error: function (data) {
            $("#loader").hide();
            console.log("error", data);
            enabledSubmit();
        },
    });
}

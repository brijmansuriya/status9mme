var imageQueueComplete = false;
var videoQueueComplete = false;

var imageProcessing = false;
var videoProcessing = false;

const presignedUrlRoute = JSON.parse(
    document.getElementById("presignedUrlRoute").value
);
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

Dropzone.autoDiscover = false;
const acceptedFiles = ["video/mp4"];
let options = {
    // The URL will be changed for each new file being processing
    url: "/",
    // Since we're going to do a `PUT` upload to S3 directly
    acceptedFiles: acceptedFiles.toString(","),
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
    maxFilesize: 1024 * 50,

    // Content-Type should be included, otherwise you'll get a signature
    // mismatch error from S3. We're going to update this for each file.
    header: "",

    // We're going to process each file manually (see `accept` below)
    autoProcessQueue: false,
    addRemoveLinks: true,

    // Here we request a signed upload URL when a file being accepted
    accept(file, done) {
        var uploadType = "/videos";
        getPresignedUrl({
            fileName: file.name,
            uploadPath: $("#type").val() + uploadType,
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
        this.on("error", function (file, message) {
            $("#videoError").text("Please select mp4 video");
            this.removeFile(file);
            return false;
        });
    },
};

// second dropzone for video upload
const dropzoneVideo = new Dropzone(
    document.getElementById("dropzoneFormVideo"),
    options
);

dropzoneVideo.on("addedfile", function (file) {
    enabledSubmit();
    videoProcessing = true;
    console.log("addedfile Video", file);
});

dropzoneVideo.on("removedfile", function (file) {
    console.log("removedfile Video", file);
    videoProcessing = false;
    videoQueueComplete = false;
    enabledSubmit();
});

dropzoneVideo.on("processing", (file) => {
    console.log("processing file", file.uploadURL);
    $("#videoUploadPath").val(file.fileUrl);
    dropzoneVideo.options.url = file.uploadURL;
});

// Set signed upload URL for each file
dropzoneVideo.on("queuecomplete", (file) => {
    console.log("completed all video files upload");
    videoQueueComplete = true;
    ajaxSubmit();
});

async function submitForm() {
    $("#submit").parsley();
    if ($("#submit").parsley().isValid()) {
        disabledSubmit();
        // upload files to S3
        dropzoneVideo.processQueue();
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

// submit form
function ajaxSubmit() {
    $("#loader").show();
    // upload sucess and ajax request to save data to database
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

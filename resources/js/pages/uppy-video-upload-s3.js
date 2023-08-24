$(".submit-btn").attr("disabled", true);
var baseUrl = $("#base_url").val();

window.addEventListener("DOMContentLoaded", function () {
    "use strict";
    var uppy = new Uppy.Core({
        debug: true,
        autoProceed: true,
        restrictions: {
            maxNumberOfFiles: 1,
            allowedFileTypes: ["video/mp4", "video/*"],
        },
        onBeforeFileAdded: (currentFile, files) => {
            const modifiedFile = {
                ...currentFile,
                name: Date.now(),
            };
            return modifiedFile + ".mp4";
        },
    });

    uppy.use(Uppy.FileInput, {
        target: ".UppyInput",
        pretty: false,
    }).use(Uppy.StatusBar, {
        target: ".UppyInput-Progress",
        hideUploadButton: true,
        hideAfterFinish: false,
    });

    uppy.use(Uppy.AwsS3Multipart, {
        limit: 1,
        companionUrl: baseUrl,
    });

    //uppy.use(Uppy.Tus, { endpoint: 'https://tusd.tusdemo.net/files/' });
    uppy.on("upload-success", function (file, response) {
        console.log("response", response);
        console.log("file", file);
        $("#file-upload-error-message").empty('');
        var url = response.uploadURL;
        var fileName = file.name;
        console.log("get aws name key", file.s3Multipart.key);
        $("#video_name").val(fileName);
        $("#video_upload_path").val(file.s3Multipart.key);
        $("#video_full_link").val(url);
        document.querySelector(".uploaded-files").innerHTML +=
            '<a href="' +
            url +
            '" target="_blank"><b>' +
            fileName +
            "</b> </a>video uploaded on AWS s3 bucket!";

        $(".submit-btn").attr("disabled", false);
        $(".spinner-border").addClass("d-none");
        $(".btn-default").text("Submit");
    });

    uppy.on("upload-error", (file, error, response) => {
        console.log("error with file:", file.id);
        console.log("error message:", error);
    });

    uppy.on("restriction-failed", (file, error) => {
        console.log("restriction error with file:", file.id);
        console.log("restriction error message:", error);
        $("#file-upload-error-message").empty('');
        $("#file-upload-error-message").append('<ul class="parsley-errors-list filled" aria-hidden="false"><li class="parsley-required">'+ error +'</li></ul>');
    });

    window.uppy = uppy;
});

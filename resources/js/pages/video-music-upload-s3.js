var imageQueueComplete = false;
var videoQueueComplete = false;

var imageProcessing = false;
var videoProcessing = false;

var dropzoneImageProcess = false;
var dropzoneVideoProcess = false;

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
const acceptedFilesImage = [
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/webp",
    // "video/mp4",
];
let optionsImage = {
    // The URL will be changed for each new file being processing
    url: "/",
    acceptedFiles: acceptedFilesImage.toString(","),
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
    maxFilesize: 1024 * 50,

    // Content-Type should be included, otherwise you'll get a signature
    // mismatch error from S3. We're going to update this for each file.
    header: "",

    // We're going to process each file manually (see `accept` below)
    autoProcessQueue: false,
    addRemoveLinks: true,

    // Here we request a signed upload URL when a file being accepted
    accept(file, done) {
        var uploadType = "/images";
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
        this.on("error", function (file, message, xhr) {
            if (xhr == null) this.removeFile(file);
            $("#imageError").text("File type must be in jpeg, jpg, png, webp");
            return false;
        });
    },
};

const acceptedFilesVideo = ["video/mp4"];
let optionsVideo = {
    // The URL will be changed for each new file being processing
    url: "/",
    acceptedFiles: acceptedFilesVideo.toString(","),
    // Since we're going to do a `PUT` upload to S3 directly
    method: "PUT",

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

    // chunking: true,
    // forceChunking: true,
    // chunkSize: 1000000 * 1, // 10 MB (for testing, you can use up to 5 GB at the moment)
    // parallelChunkUploads: true,
    // retryChunks: true,
    // retryChunksLimit: 3,
    // params: (files, xhr, chunk) => {
    //     if (chunk) {
    //         return {
    //             UploadId: chunk.file.upload.uuid,
    //             PartNumber: chunk.index,
    //             TotalFileSize: chunk.file.size,
    //             CurrentChunkSize: chunk.dataBlock.data.size,
    //             TotalChunkCount: chunk.file.upload.totalChunkCount,
    //             // ChunkByteOffset: chunk.index * this.options.chunkSize,
    //             // ChunkSize: this.options.chunkSize,
    //             Filename: chunk.file.name,
    //         };
    //     }
    // },
    // defaultHeaders: false,
    // binaryBody: true,

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

// second dropzone for image upload
// Instantiate Dropzone
const dropzoneImage = new Dropzone(
    document.getElementById("dropzoneFormImage"),
    optionsImage
);

dropzoneImage.on("addedfile", function (file) {
    imageProcessing = true;
    console.log("addedfile Image", file);
});

dropzoneImage.on("removedfile", function (file) {
    console.log("removedfile Image", file);
    imageProcessing = false;
    imageQueueComplete = false;
    $("#imageUploadPath").val("");
    removeOnclickFormSubmit();
    enabledSubmit();
});

// Set signed upload URL for each file
dropzoneImage.on("processing", (file) => {
    imageProcessing = true;
    dropzoneImageProcess = true;
    console.log("processing file", file.uploadURL);
    $("#imageUploadPath").val(file.fileUrl);
    dropzoneImage.options.url = file.uploadURL;
});

// Set signed upload URL for each file
dropzoneImage.on("queuecomplete", (file) => {
    console.log("completed all image files upload");
    imageQueueComplete = true;
    if (videoQueueComplete) {
        ajaxSubmit();
    }
});

// second dropzone for video upload
const dropzoneVideo = new Dropzone(
    document.getElementById("dropzoneFormVideo"),
    optionsVideo
);

dropzoneVideo.on("addedfile", function (file) {
    videoProcessing = true;
    console.log("addedfile Video", file);
});

dropzoneVideo.on("removedfile", function (file) {
    console.log("removedfile Video", file);
    removeOnclickFormSubmit();
    $("#videoUploadPath").val("");
    videoProcessing = false;
    videoQueueComplete = false;
    enabledSubmit();
});

// dropzoneVideo.on("success", function (file, response) {
//     // console.log("success Video", file);
//     var data = {
//         UploadId:
//             "See step above with Create Multipart Upload and remember upload id",
//         MultipartUpload: {
//             Parts: file.upload.chunks.map((chunk) => ({
//                 PartNumber: chunk.index + 1,
//                 // ETag: chunk.responseHeaders.match(/ETag: "([^"]+)"/i)[1],
//             })),
//         },
//     };
//     // console.log("data", data);
// });

dropzoneVideo.on("processing", (file) => {
    videoProcessing = true;
    dropzoneVideoProcess = true;
    console.log("processing file", file.uploadURL);
    $("#videoUploadPath").val(file.fileUrl);
    dropzoneVideo.options.url = file.uploadURL;
    // chunkCount = 1;
    // const partCount = Math.ceil(file.size / dropzoneVideo.options.chunkSize);
    // console.log("partCount", partCount);
    /** CreateMultipartUpload */
    // http.post / jQuery.post / AWS.S3.CreateMultipartUpload

    // /** Prepare all the chunks which we want to upload */
    // const promises = [];
    // for (let x = 1; x <= partCount; x++) {
    //     promises.push;
    // http.post / jQuery.post / AWS.S3.UploadPart <- Promise!!
    // new Promise(function (resolve) {
    //     UploadId: "See step above with Create Multipart Upload and remember upload id";
    //     PartNumber: x;
    //     //  resolve then with the upload url!
    // }).then(function (uploadUrl) {
    //     partData[x] = data;
    // });
    // }
    // Promise.all(promises).then(function () {
    //     dropzoneVideo.processFile(file);
    // });
});

// Set signed upload URL for each file
dropzoneVideo.on("queuecomplete", (file) => {
    console.log("completed all video files upload");
    videoQueueComplete = true;
    if (imageQueueComplete) {
        ajaxSubmit();
    }
});

async function submitForm() {
    $("#submit").parsley();
    if (dropzoneImage.files.length == 0 && dropzoneVideo.files.length == 0) {
        $("#imageError").text("Please select image");
        $("#videoError").text("Please select video");
        return false;
    }

    if (dropzoneImage.files.length == 0) {
        // imageError error validation message add
        $("#imageError").text("Please select image");
        return false;
    }

    if (dropzoneVideo.files.length == 0) {
        // imageError error validation message add
        $("#videoError").text("Please select video");
        return false;
    }

    if ($("#submit").parsley().isValid()) {
        if (imageQueueComplete && videoQueueComplete) {
            ajaxSubmit();
            return false;
        }
        disabledSubmit();
        dropzoneImage.processQueue();
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

function removeOnclickFormSubmit() {
    if (imageProcessing && videoProcessing) {
        $("#submit").attr("action", $("#ajaxUrl").val());
        $(".submit-btn").removeAttr("onclick");
    }
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
            // $("#loader").hide();
            window.location.href = $("#ajaxSuccessUrl").val();
        },
        error: function (data, textStatus, errorThrown) {
            $("#loader").hide();
            console.log("error", data);
            enabledSubmit();
            // stromg tag add error message
            $("#errorMessage").text(data.responseJSON.message);
            $("#errorMessage").show();
        },
    });
}

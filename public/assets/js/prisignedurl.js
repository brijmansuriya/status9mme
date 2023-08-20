// import { formatUrl } from "@aws-sdk/util-format-url";

$(document).ready(function () {
    $("#banner-fileinput").on("change", function () {
        console.log("change");
        var file = this.files[0];
        var fileName = file.name;
        var fileSize = file.size;
        var fileType = file.type;
        var formData = new FormData();
        formData.append("file", file);
        formData.append("fileName", fileName);
        formData.append("fileSize", fileSize);
        formData.append("fileType", fileType);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
            url: '{{ route("banner.getpresignedurl") }}',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    var presignedUrl = JSON.stringify(
                        response.data.presignedUrl
                    );
                    var presignedUrl = presignedUrl.replace(/\"/g, "");

                    var fileName = JSON.stringify(response.data.fileName);
                    var fileName = fileName.replace(/\"/g, "");

                    var fileSize = JSON.stringify(response.data.fileSize);
                    var fileSize = fileSize.replace(/\"/g, "");

                    var fileType = JSON.stringify(response.data.fileType);
                    var fileType = fileType.replace(/\"/g, "");

                    // var splitPresignedUrl = presignedUrl.split('?');
                    // var splitPresignedUrl = splitPresignedUrl[1];
                    // var splitPresignedUrl = splitPresignedUrl.replace(/\"/g, "");

                    $("#banner-fileinput").val("");
                    $("#image-url").val(fileName);
                    $("#banner-fileinput").attr(
                        "response-presignedurl",
                        presignedUrl
                    );
                    $("#banner-fileinput").attr("response-filename", fileName);
                    $("#banner-fileinput").attr("response-filesize", fileSize);
                    $("#banner-fileinput").attr("response-filetype", fileType);

                    const s3Response = fetch(formatUrl(presignedUrl), {
                        method: "PUT",
                        body: file,
                    });

                    console.log(s3Response);
                }
            },
        });
    });
});

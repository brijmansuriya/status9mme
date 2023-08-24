$(document).ready(function() {
    var url = JSON.parse(document.getElementById("dataTableUrl").value);
    $("#albumTrackDataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "album_name", name: "album_name" },
            { data: "song_name", name: "song_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            }
        ],
        order: [0, "asc"]
    });
});

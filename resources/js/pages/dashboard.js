
document.getElementById("type").addEventListener("change", function() {
    window.location =
        JSON.parse(document.getElementById("customerListUrl").value) +
        "?type=" +
        document.getElementById("type").value  +
        "&year=" +
        document.getElementById("year").value +
        "&month=" +
        document.getElementById("month").value +
        "&start_date=" +
        document.getElementById("startDate").value +
        "&end_date=" +
        document.getElementById("endDate").value;
});
document.getElementById("year").addEventListener("change", function() {
    window.location =
        JSON.parse(document.getElementById("customerListUrl").value) +
        "?type=" +
        document.getElementById("type").value  +
        "&year=" +
        document.getElementById("year").value +
        "&month=" +
        document.getElementById("month").value +
        "&start_date=" +
        document.getElementById("startDate").value +
        "&end_date=" +
        document.getElementById("endDate").value;
});
document.getElementById("month").addEventListener("change", function() {
    window.location =
        JSON.parse(document.getElementById("customerListUrl").value) +
        "?type=" +
        document.getElementById("type").value  +
        "&year=" +
        document.getElementById("year").value +
        "&month=" +
        document.getElementById("month").value +
        "&start_date=" +
        document.getElementById("startDate").value +
        "&end_date=" +
        document.getElementById("endDate").value;
});
document.getElementById("startDate").addEventListener("change", function() {
    window.location =
        JSON.parse(document.getElementById("customerListUrl").value) +
        "?type=" +
        document.getElementById("type").value  +
        "&year=" +
        document.getElementById("year").value +
        "&month=" +
        document.getElementById("month").value +
        "&start_date=" +
        document.getElementById("startDate").value +
        "&end_date=" +
        document.getElementById("endDate").value;
});
document.getElementById("endDate").addEventListener("change", function() {
    window.location =
        JSON.parse(document.getElementById("customerListUrl").value) +
        "?type=" +
        document.getElementById("type").value  +
        "&year=" +
        document.getElementById("year").value +
        "&month=" +
        document.getElementById("month").value +
        "&start_date=" +
        document.getElementById("startDate").value +
        "&end_date=" +
        document.getElementById("endDate").value;
});

import { applyFilter, deleteThing, loadPagination } from "./master";

$(document).ready(function () {
    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#resultBody", "/admin/results", 7);
    });

    // post and category filter work in master.js

    $(document).on("click", "#applyFilter", function () {
        $("#resultBody").html(
            `<option value="" colspan=100>Loading..</option>`,
        );
        applyFilter(1, "/admin/results", "#resultBody");
    });

    deleteThing(
        "click",
        ".result_delete",
        "/admin/result/delete/",
        ".result-delete-alert",
    );
});

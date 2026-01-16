import { deleteThing, loadPagination, showAlert } from "./master";

$(document).ready(function () {
    $(document).on("keyup", "#searchInput", function () {
        loadPagination(1, "#questionBody", "/admin/questions");
    });

    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#questionBody", "/admin/questions");
    });

    $(document).on("click", ".close i.bx-x", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    deleteThing("click", ".question_delete", "/admin/questions/delete/", ".question-delete-alert");
});
import { deleteThing, loadPagination, showAlert } from "./master";

$(document).ready(function () {
    $(document).on("keyup", "#searchInput", function () {
        loadPagination(1, "#postBody", "/admin/posts");
    });

    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#postBody", "/admin/posts");
    });

    $(document).on("click", ".close i.bx-x", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    deleteThing("click", ".post_delete", "/admin/posts/delete/", ".post-delete-alert");
});
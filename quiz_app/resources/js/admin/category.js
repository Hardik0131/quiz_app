import { deleteThing, showAlert } from "./master";
import { loadPagination } from "./master";

$(document).ready(function () {
    $(document).on("keyup", "#searchInput", function () {
        loadPagination(1, "#categoryBody", "/admin/category");
    });

    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#categoryBody", "/admin/category");
    });

    $(document).on("click", ".close i.bx-x", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    // delete Category

    deleteThing("click", ".category_delete", "/admin/category/delete/", ".category-delete-alert");
});
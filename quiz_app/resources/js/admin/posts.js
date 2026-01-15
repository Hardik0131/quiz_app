import { loadPagination, showAlert } from "./master";

$(document).ready(function () {
    $(document).on("keyup", '#searchInput', function(){
        loadPagination(1, "#postBody", "/admin/posts");
    })

    $(document).on("click", ".custom-pagination a", function(e){
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#postBody", "/admin/posts");
    })


});
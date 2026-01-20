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

    deleteThing(
        "click",
        ".question_delete",
        "/admin/questions/delete/",
        ".question-delete-alert"
    );

    $(document).on("change", "#category_id", function () {
        let categoryId = $(this).val();
        let postSelect = $("#post_id");
        let url = $(this).data("post-url");

        postSelect.html(`<option value="">Loading..</option>`);

        $.ajax({
            url: url,
            type: "GET",
            data: { category_id: categoryId },
            success: function (response) {
                postSelect.html(
                    `<option value="" disabled hidden selected>-- Select Post --</option>`
                );

                if (response.length === 0) {
                    postSelect.append(
                        `<option value="">Not Post Found</option>`
                    );
                }

                response.forEach((post) => {
                    postSelect.append(
                        `<option value="${post.id}">${post.post_name}</option>`
                    );
                });
            },
            error: function () {
                postSelect.html(`<option value="">Error to Loading</option>`);
            },
        });
    });
});

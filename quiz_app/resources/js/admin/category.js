$(document).on("click", 'a[href*="page="]', function (e) {
    e.preventDefault();

    const url = $(this).attr("href");

    $.get(url, function (response) {
        const html = $(response);

        $("#categoryBody").html(html.find("#categoryBody").html());
    });
});

$(document).ready(function () {
    $(document).on("click", ".close i.ri-close-line", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    function categoryShowAlert(type, message) {
        const alertClass =
            type === "success" ? "alert-success" : "alert-warning";

        $(".category-delete-alert")
            .html(
                `
                    <div class="alert ${alertClass}">
                        <div class="${alertClass}-message">
                            <strong>${
                                type === "success" ? "Success!" : "Error!"
                            }</strong> ${message}
                        </div>
                        <button class="close"><i class="bx bx-x"></i></button>
                    </div>
                `
            )
            .fadeIn(200);
    }

    function loadCategories(page = 1) {
        let search = $("#searchInput").val();

        $("#categoryBody").html(`
            <tr>
                <td colspan="4" style="text-align:center; padding:20px;">
                    Loading...
                </td>
            </tr>
        `);

        $.ajax({
            url: "/admin/category",
            data: {
                page: page,
                search: search,
            },
            success: function (html) {
                $("#categoryBody").html(html);
            },
        });
    }

    $(document).on("keyup", "#searchInput", function () {
        loadCategories(1);
    });

    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        loadCategories(page);
    });

    $(document).on("click", ".close i.bx-x", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    // delete Category

    $(document).on("click", ".delete-btn", function () {
        let categoryId = $(this).data("id");
        let row = $(this).closest("tr");

        if (!confirm("Are you sure to delete this rooms Item ?")) return;

        $.ajax({
            url: "/admin/category/delete/" + categoryId,
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status === "success") {
                    row.fadeOut(400, function () {
                        $(this).remove();
                    });
                    categoryShowAlert("success", response.message);
                } else {
                    categoryShowAlert("error", response.message);
                }
            },
            error: function () {
                console.log(categoryId);
                categoryShowAlert("error", "Something went wrong!");
            },
        });
    });
});

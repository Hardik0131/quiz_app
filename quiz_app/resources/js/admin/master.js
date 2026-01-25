export function showAlert(type, message, url) {
    const alertClass = type === "success" ? "alert-success" : "alert-warning";

    $(url)
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
            `,
        )
        .fadeIn(200);
}

export function loadPagination(page = 1, location, url, spancol = 4) {
    let search = $("#searchInput").val();

    $(location).html(`
            <tr>
                <td colspan="${spancol}" style="text-align:center; padding:20px;">
                    Loading...
                </td>
            </tr>
        `);

    $.ajax({
        url: url,
        data: {
            page: page,
            search: search,
        },
        success: function (html) {
            $(location).html(html);
        },
    });
}

export function deleteThing(event, eLocation, url, alertUrl) {
    $(document).on(event, eLocation, function () {
        let thingId = $(this).data("id");
        let row = $(this).closest("tr");

        if (!confirm("Are you sure to delete this rooms Item ?")) return;

        $.ajax({
            url: url + thingId,
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log("Hardik");
                if (response.status === "success") {
                    row.fadeOut(400, function () {
                        $(this).remove();
                    });
                    showAlert("success", response.message, alertUrl);
                } else {
                    console.log("Bhaliya");
                    showAlert("error", response.message, alertUrl);
                }
            },
            error: function () {
                console.log(thingId);
                showAlert("error", "Something went wrong!", alertUrl);
            },
        });
    });
}

// For a Filter Category and Post

export function applyFilter(page = 1, url, tableBody) {
    $.ajax({
        url: url,
        type: "GET",
        data: {
            category_id: $("#select_category").val(),
            search: $("#searchInput").val(),
            post_id: $("#select_post").val(),
            page: page,
        },
        success: function (response) {
            $(tableBody).html(response);
        },
    });
}

export function filterPostByCategory(event, idOrClass, postId = null) {
    $(document).on(event, idOrClass, function () {
        let categoryId = $(this).val();
        let postSelect = $(postId);
        let url = $(this).data("postUrl");

        if (!categoryId) {
            postSelect.html(`<option value="">-- Select Post --</option>`);
            return;
        }

        postSelect.html(`<option value="">Loading..</option>`);

        $.ajax({
            url: url,
            type: "GET",
            data: { category_id: categoryId },
            success: function (response) {
                postSelect.html(`<option value="">-- Select Post --</option>`);

                if (response.length === 0) {
                    postSelect.append(
                        `<option value="" disabled>Not Post Found</option>`,
                    );
                }

                response.forEach((post) => {
                    postSelect.append(
                        `<option value="${post.id}">${post.post_name}</option>`,
                    );
                });
            },
            error: function () {
                postSelect.html(`<option value="">Error to Loading</option>`);
            },
        });
    });
}

$(document).ready(function () {
    // Search Code

    $("category-content .search-box input").click(function () {
        $(this).css("border", "none");
    });

    $("#searchInput").on("keyup", function () {
        loadSearch();
    });

    // for a addQuestion
    filterPostByCategory("change", "#category_id", "#post_id", "post-url");

    // for a filter question on table
    filterPostByCategory(
        "change",
        "#select_category",
        "#select_post",
    );

    // function loadSearch() {
    //     console.log("Loaded");
    //     let query = $("#searchInput").val().trim();

    //     if (query === "") {
    //         window.location.reload(); // restore pagination
    //         return;
    //     }

    //     $.ajax({
    //         url: "/v1/category/search",
    //         method: "GET",
    //         data: { query: query },

    //         success: function (response) {
    //             let rows = "";

    //             if (response.data.length > 0) {
    //                 $.each(response.data, function (index, category) {
    //                     rows += `
    //                          <tr>
    //                             <td>${category.name}</td>
    //                             <td>${category.short_desc}</td>
    //                             <td>${category.long_desc}</td>
    //                             <td class="action">
    //                                 <div class="action-buttons">
    //                                     <div class="delete-btn" data-id="${category.id}">
    //                                         <i class="bx bx-trash"></i>
    //                                     </div>
    //                                     <div class="edit-btn">
    //                                         <i class="bx bx-edit"></i>
    //                                     </div>
    //                                 </div>
    //                             </td>
    //                         </tr>
    //                     `;
    //                 });
    //             } else {
    //                 rows = `
    //                     <tr>
    //                         <td colspan='5' style="text-align: center; padding: 20px;">
    //                             No Project Found.
    //                         </td>
    //                     </tr>
    //                 `;
    //             }
    //             $("#categoryBody").html(rows);
    //         },
    //         error: function (xhr, status, error) {
    //             console.error("Ajax error : ", status, error);
    //         },
    //     });
    // }
    // loadSearch();
});

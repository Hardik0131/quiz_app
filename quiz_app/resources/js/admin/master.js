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
            `
        )
        .fadeIn(200);
}

export function loadPagination(page = 1, location, url) {
    let search = $("#searchInput").val();

    $(location).html(`
            <tr>
                <td colspan="4" style="text-align:center; padding:20px;">
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
                console.log('Hardik');
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

$(document).ready(function () {
    $(".profile-icon").click(function (event) {
        event.stopPropagation();

        $(".profile-detail").toggleClass("active");

        if ($(".profile-detail").hasClass("active")) {
            $(".profile-icon i").removeClass("bx-user").addClass("bxs-user");
        } else {
            $(".profile-icon i").removeClass("bxs-user").addClass("bx-user");
        }
    });

    // Search Code

    $("category-content .search-box input").click(function () {
        $(this).css("border", "none");
    });

    $("#searchInput").on("keyup", function () {
        loadSearch();
    });

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

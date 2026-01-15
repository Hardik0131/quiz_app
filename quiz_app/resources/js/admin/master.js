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

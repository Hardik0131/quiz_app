import {
    applyFilter,
    deleteThing,
    filterPostByCategory,
    loadPagination,
    showAlert,
} from "./master";

// function filterQuestionByCategoryOrPost(
//     event,
//     idOrClass,
//     questionId = "",
//     questionUrl = "",
// ) {
//     $(document).on(event, idOrClass, function () {
//         let categoryId = $(this).val();
//         let questionSelect = $(questionId);
//         let url = $(this).data(questionUrl);

//         questionSelect.html(`<option value="">Loading..</option>`);

//         $.ajax({
//             url: url,
//             type: "GET",
//             data: { category_id: categoryId },
//             success: function (response) {
//                 questionSelect.html(
//                     `<option value="">-- Select Question --</option>`,
//                 );

//                 if (response.length === 0) {
//                     questionSelect.append(
//                         `<option value="" disabled>Not Question Found</option>`,
//                     );
//                 }

//                 response.forEach((post) => {
//                     questionSelect.append(
//                         `<option value="${post.id}">${post.question}</option>`,
//                     );
//                 });
//             },
//             error: function () {
//                 questionSelect.html(
//                     `<option value="">Error to Loading</option>`,
//                 );
//             },
//         });
//     });
// }

$(document).ready(function () {
    $(document).on("click", ".custom-pagination a", function (e) {
        e.preventDefault();

        let page = $(this).attr("href").split("page=")[1];
        loadPagination(page, "#questionBody", "/admin/questions", 6);
    });

    $(document).on("click", ".close i.bx-x", function () {
        $(this).closest(".alert").fadeOut(200);
    });

    deleteThing(
        "click",
        ".question_delete",
        "/admin/questions/delete/",
        ".question-delete-alert",
    );

    // for a question by category and post

    // filterQuestionByCategoryOrPost(
    //     "change",
    //     "#select_category",
    //     "#select_question",
    //     "question-url",
    // );
    // filterQuestionByCategoryOrPost(
    //     "change",
    //     "#select_post",
    //     "#select_question",
    //     "question-url",
    // );

    // filter the data of table
    $(document).on("click", "#applyFilter", function () {
        $("#questionBody").html(`<option value="" colspan=100>Loading..</option>`);

        applyFilter(1, "/admin/questions", "#questionBody");
    });
});

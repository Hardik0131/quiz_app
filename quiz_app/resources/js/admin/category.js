$(document).on('click', 'a[href*="page="]', function (e) {
    e.preventDefault();

    const url = $(this).attr("href");

    $.get(url, function (response) {
        const html = $(response);

        $("#categoryBody").html(html.find("#categoryBody").html());
    });
});

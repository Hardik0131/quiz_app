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
});

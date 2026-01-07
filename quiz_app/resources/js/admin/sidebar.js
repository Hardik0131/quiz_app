$(document).ready(function () {
    // Sidebar toggle

    $("#btn").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        $("html").toggleClass("sidebar-open");

        if ($("html").hasClass("sidebar-open")) {
            $(".logo-details i")
                .removeClass("bx-menu")
                .addClass("bx-arrow-back");
            console.log("Hardik");
            console.log("Hardik");
        } else {
            $(".logo-details i")
                .removeClass("bx-arrow-back")
                .addClass("bx-menu");
            sessionStorage.setItem("sidebarState", "close");
        }
    });

    $(".profile-icon").click(function (event) {
        event.stopPropagation();

        $(".profile-detail").toggleClass("active");

        if ($(".profile-detail").hasClass("active")) {
            $(".profile-icon i").removeClass("bx-user").addClass("bxs-user");
        } else {
            $(".profile-icon i").removeClass("bxs-user").addClass("bx-user");
        }
    });

    $(document).click(function () {
        $(".profile-detail").removeClass("active");
        $(".profile-icon i").removeClass("bxs-user").addClass("bx-user");
    });

    $(".profile-detail").click(function (event) {
        event.stopPropagation();
    });

    $("projects .projects-search-box input").click(function () {
        $(this).css("border", "none");
    });
});

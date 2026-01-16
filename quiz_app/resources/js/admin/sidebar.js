$(document).ready(function () {
    // Sidebar toggle

    function updateActiveSidebar() {
        let currentPath = window.location.pathname;

        $(".sidebar-link").removeClass("active");

        $(".sidebar-link").each(function () {
            let linkPath = new URL($(this).data("url"), window.location.origin)
                .pathname;

            if (currentPath === linkPath) {
                $(this).addClass("active");
            }
        });
    }

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

    $(document).on("click", "i.bx-x", function () {
        $(this).closest(".error").fadeOut(200);
    });
    $(document).on("click", "i.bx-x", function () {
        $(this).closest(".success").fadeOut(200);
    });

    $(document).on("click", ".sidebar-link", function (e) {
        e.preventDefault();

        let url = $(this).data("url");

        $(".sidebar-link").removeClass("active");
        $(this).addClass("active");

        // $(".main-content").load(url);

        // history.pushState(null, "", url);

        $(".main-content").load(url, function () {
            history.pushState(null, "", url);
            updateActiveSidebar();
        });
    });

    function loadPage(event, iden) {
        $(document).on(event, iden, function (e) {
            e.preventDefault();

            let url = $(this).data("url");
            $(".main-content").load(url);
            history.pushState(null, "", url);
        });
    }

    loadPage("click", ".add-category");
    loadPage("click", ".category-edit");
    loadPage("click", ".back_to_category");

    loadPage("click", ".add-post");
    loadPage("click", ".edit-purchase");
    loadPage("click", ".back_to_post");

    loadPage("click", ".add-sells");
    loadPage("click", ".return-sells");
    loadPage("click", ".edit-sells");

    loadPage("click", ".invoice");

    window.onpopstate = function () {
        $(".main-content").load(location.pathname, function () {
            updateActiveSidebar();
        });
    };
});

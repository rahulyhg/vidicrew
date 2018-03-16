(function($) {
    // This will fire when document is ready:
    $(document).ready(function() {
        $("table.views-table").addClass("u-full-width");
        $(window).resize(function() {
            // This will fire each time the window is resized:
            if ($(window).width() <= 649) {
                $(".breadcrumb").prev('.navbar').remove();
                // Removing Menu Skeleton For Mobile
                $(".navbar").removeClass("navbar")
                $('nav#navigation').removeAttr('id');
                $(".navbar-list").removeClass("navbar-list")
                $(".navbar-item").removeClass("navbar-item")
                $(".navbar-link").removeClass("navbar-link")
            }
            if ($(window).width() >= 650) {
                // Adding Skeleton Menu
                $('nav').attr('id', 'navigation');
                $("nav#navigation.replaceme").addClass("navbar");
                $("ul#menu").addClass("navbar-list");
                $("ul.navbar-list li").addClass("navbar-item");
                $("li.navbar-item a").addClass("navbar-link");
                // Removing Mobile Menu
                $("ul#menu").prev('label.show-menu').remove();
                $("ul#menu").prev('input#show-menu').remove();
            }
        }).resize(); // This will simulate a resize to trigger the initial run.
    })
})(jQuery);

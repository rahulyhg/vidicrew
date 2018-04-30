jQuery(document).foundation();
/*
These functions make sure WordPress
and Foundation play nice together.
*/
jQuery(document).ready(function(){// Remove empty P tags created by WP inside of Accordion and Orbit
jQuery('.accordion p:empty, .orbit p:empty').remove();// Adds Flex Video to YouTube and Vimeo Embeds
jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function(){if(jQuery(this).innerWidth()/jQuery(this).innerHeight()>1.5){jQuery(this).wrap("<div class='widescreen responsive-embed'/>");}else{jQuery(this).wrap("<div class='responsive-embed'/>");}});});

/*
Insert Custom JS Below
*/

/*

New scripts by J.R. - move into separate files?

*/

jQuery(document).ready(function() {
	jQuery(".tab_content_login").hide();
	jQuery("ul.tabs_login li:first").addClass("active_login").show();
	jQuery(".tab_content_login:first").show();
	jQuery("ul.tabs_login li").click(function() {
		jQuery("ul.tabs_login li").removeClass("active_login");
		jQuery(this).addClass("active_login");
		jQuery(".tab_content_login").hide();
		var activeTab = jQuery(this).find("a").attr("href");
		if (jQuery.browser.msie) {jQuery(activeTab).show();}
		else {jQuery(activeTab).show();}
		return false;
	});
});


/* CREW buttons move to nav on scroll */

jQuery(window).scroll(function() {
    if(jQuery(this).scrollTop() > 450) {
		jQuery("#start-top").fadeIn();
		jQuery("#join-top").fadeIn();
		jQuery("#start").fadeOut();
		jQuery("#join").fadeOut();
    } else {
		jQuery("#start-top").fadeOut();
		jQuery("#join-top").fadeOut();
		jQuery("#start").fadeIn();
		jQuery("#join").fadeIn();
    }
});

/* nav fade on scroll 

jQuery(function() {
	var header = $(".top-bar, .top-bar ul");

	jQuery(window).scroll(function() {    
			var scroll = jQuery(window).scrollTop();
			if (scroll >= 50) {
					header.addClass("scrolled");
			} else {
					header.removeClass("scrolled");
			}
	});

}); */

jQuery(window).scroll(function() {
	if (jQuery(this).scrollTop() >100) {
		jQuery(".top-bar").addClass("scrolled");
	} else {
		jQuery(".top-bar").removeClass("scrolled");
	}
}); 
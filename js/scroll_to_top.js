jQuery(document).ready(function(){	
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 20) {
			jQuery('#back-top').stop(true).css({"display":"block"}).animate({"opacity": 1}, 400);
		} else {
			jQuery('#back-top').stop(true).animate({"opacity": 0}, 400, function(){jQuery(this).css({"display":"none"})});
		}
	});
	jQuery('#back-top').click(function () {
		jQuery('body, html').stop(true).animate({scrollTop: 0}, 600);
		return false;
	});
})
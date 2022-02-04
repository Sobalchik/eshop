$(window).on('scroll', function() {
	var $nav = $('.header'),
		scroll = $(this).scrollTop();

	if (scroll > 10) {
		$nav.addClass('asdsss');
	} else {
		$nav.removeClass('asdsss');
	}
});
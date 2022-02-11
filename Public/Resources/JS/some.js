$(document).ready(function () {
	$('.mobile-nav-button').on('click', function() {
		$( ".mobile-nav-button .mobile-nav-button__line:nth-of-type(1)" ).toggleClass( "mobile-nav-button__line--1");
		$( ".mobile-nav-button .mobile-nav-button__line:nth-of-type(2)" ).toggleClass( "mobile-nav-button__line--2");
		$( ".mobile-nav-button .mobile-nav-button__line:nth-of-type(3)" ).toggleClass( "mobile-nav-button__line--3");
		$('.mobile-menu').toggleClass('mobile-menu--open');
		$('.mobile-menu-2').toggleClass('mobile-menu--open-2');
		$('body').toggleClass('mobile-menu--open');
		return false;
	});
});


$(window).on('scroll', function() {
	var $nav = $('.header'),
		scroll = $(this).scrollTop();

	if (scroll > 10) {
		$nav.fadeOut( "fast" );
	} else {
		$nav.fadeIn( "fast" );
	}

	var $nav_list = $('.mobile-nav-button-block'),
		scrolling= $(this).scrollTop();

	if (scrolling > 10) {
		$nav_list.fadeIn();
	} else {
		$nav_list.fadeOut( "fast" );
	}

});




$("#pay").click(function() {
	$("#pay-45").fadeIn();
})
$("#pil2").click(function() {
	$("#pay-45").fadeOut();
})




$('.mobile-nav-button').on('change', function() {
	$('body').css('overflow', $(this).prop('checked') === true ? 'hidden' : '');
});

$( ".pading-1" ).hover(function(){
	$( ".none-1" ).fadeIn().toggleClass('mobile-menu-2-block');е
}, function(){
	$( ".none-1" ).fadeOut( "fast" );
});

$( ".pading-2" ).hover(function(){
	$( ".none-2" ).fadeIn().toggleClass('mobile-menu-2-block');
}, function(){
	$( ".none-2" ).fadeOut( "fast" );
});

$( ".pading-3" ).hover(function(){
	$( ".none-3" ).fadeIn().toggleClass('mobile-menu-2-block');
}, function(){
	$( ".none-3" ).fadeOut( "fast" );
});


var progressPath = document.querySelector('.progress-wrap path');
var pathLength = progressPath.getTotalLength();
progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
progressPath.style.strokeDashoffset = pathLength;
progressPath.getBoundingClientRect();
progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
var updateProgress = function () {
	var scroll = $(window).scrollTop();
	var height = $(document).height() - $(window).height();
	var progress = pathLength - (scroll * pathLength / height);
	progressPath.style.strokeDashoffset = progress;
}
updateProgress();
$(window).scroll(updateProgress);
var offset = 50;
var duration = 550;
jQuery(window).on('scroll', function() {
	if (jQuery(this).scrollTop() > offset) {
		jQuery('.progress-wrap').addClass('active-progress');
	} else {
		jQuery('.progress-wrap').removeClass('active-progress');
	}
});
jQuery('.progress-wrap').on('click', function(event) {
	event.preventDefault();
	jQuery('html, body').animate({scrollTop: 0}, duration);
	return false;
});





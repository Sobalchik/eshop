

let toggleHeader = function(){
	$('.mobile-nav-button .mobile-nav-button__line:nth-of-type(1)').toggleClass('mobile-nav-button__line--1');
	$('.mobile-nav-button .mobile-nav-button__line:nth-of-type(2)').toggleClass('mobile-nav-button__line--2');
	$('.mobile-nav-button .mobile-nav-button__line:nth-of-type(3)').toggleClass('mobile-nav-button__line--3');
	$('.mobile-menu').toggleClass('mobile-menu--open');
	$('.mobile-menu-2').toggleClass('mobile-menu--open-2');
	$('body').toggleClass('mobile-menu--open');
}



$(document).ready(function() {
	if ($(window).scrollTop()>10)
	{
		$('.header').hide()
	}
	$('.mobile-nav-button').on('click', function() {
		toggleHeader()
		return false;
	});
});

$(window).on('scroll', function() {
	var $nav = $('.header'),
		scroll = $(this).scrollTop();

	if (scroll > 10)
	{
		$nav.fadeOut('fast');
	}
	else
	{
		$nav.fadeIn('fast');
	}
});

$('#pay').click(function() {
	$('#pay-45').fadeIn();
});
$('#pil2').click(function() {
	$('#pay-45').fadeOut();
});
$('#pay-12').click(function() {
	$('#pay-45').fadeOut();
	$('#pay-46').fadeIn();
});



$('.mobile-nav-button').on('change', function() {
	$('body').css('overflow', $(this).prop('checked') === true ? 'hidden' : '');
});



$('.pading-1').hover(function() {
	$('.none-1').show()
	$('.mobile-menu-2.mobile-menu--open-2>div:not(.none-1)').hide();
});
$('.pading-2').hover(function() {
	$('.none-2').show()
	$('.mobile-menu-2.mobile-menu--open-2>div:not(.none-2)').hide();
});
$('.pading-3').hover(function() {
	$('.none-3').show()
	$('.mobile-menu-2.mobile-menu--open-2>div:not(.none-3)').hide();
});
$('.pading-4').hover(function() {
	$('.none-4').show()
	$('.mobile-menu-2.mobile-menu--open-2>div:not(.none-4)').hide();
});
$('.pading-5').hover(function() {
	$('.none-5').show()
	$('.mobile-menu-2.mobile-menu--open-2>div:not(.none-5)').hide();
});

$(document).ready(function() {
	$('.map-img-a').hover(function() {
		$('.map-img-secondary-'+$(this).attr('data-map')).stop().fadeIn('fast');
	}, function() {
		$('.map-img-secondary-'+$(this).attr('data-map')).stop().fadeOut('fast');
	});
});


let loadPage = function(url, isToggleHeader) {
	let allowed =
		{
			'/': true,
			'/allExcursions': true,
			'/excursion': true
		};
	if(!url.startsWith("http") && allowed["/"+url.split("/")[1]]) {
		$('#page-content').load(url + ' #page-content', isToggleHeader ? toggleHeader: function(){});
		return true;
	}
	let element=document.createElement("a");
	element.href=url;
	element.style["position"]="absolute";
	element.style["left"]="-9999px";
	element.style["top"]="-9999px";
	element.style["opacity"]="0";
	document.documentElement.appendChild(element);
	element.click();
	document.documentElement.removeChild(element);
}

let handleLinkClick = function(elem, isToggleHeader) {
	let page;
	window.event.preventDefault();
	page = elem.attr('href');
	loadPage(page, isToggleHeader)
	//window.history.pushState({page: "another"}, "another page", page);
	window.history.pushState({}, '', page)
	window.scrollTo(0, 0);
}

$(document).ready(function (e) {
	$('a').not('.mobile-menu-bloc2 li a').click(function () {
		handleLinkClick($(this));
	});
	$('.mobile-menu-bloc2 li a').click(function () {
		handleLinkClick($(this), true);
	});
});




$(document).ready(function() {
	var progressPath = document.querySelector('.progress-wrap path');
	var pathLength = progressPath.getTotalLength();
	progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
	progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
	progressPath.style.strokeDashoffset = pathLength;
	progressPath.getBoundingClientRect();
	progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
	var updateProgress = function() {
		var scroll = $(window).scrollTop();
		var height = $(document).height() - $(window).height();
		var progress = pathLength - (scroll * pathLength / height);
		progressPath.style.strokeDashoffset = progress;
	};
	updateProgress();
	$(window).scroll(updateProgress);
	var offset = 50;
	var duration = 550;
	jQuery(window).on('scroll', function() {
		if (jQuery(this).scrollTop() > offset)
		{
			jQuery('.progress-wrap').addClass('active-progress');
		}
		else
		{
			jQuery('.progress-wrap').removeClass('active-progress');
		}
	});
	jQuery('.progress-wrap').on('click', function(event) {
		event.preventDefault();
		jQuery('html, body').animate({ scrollTop: 0 }, duration);
		return false;
	});
});




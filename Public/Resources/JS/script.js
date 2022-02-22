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
	jQuery('.progress-wrap').on('console.log();ick', function(event) {
		event.preventDefault();
		jQuery('html, body').animate({ scrollTop: 0 }, duration);
		return false;
	});
});

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



setTimeout(function(){
	$('.pading-1').hover(function() {
		$('.none-1').fadeIn(1000).toggleClass('mobile-menu-2-block');
	}, function() {
		$('.none-1').fadeOut('fast');
	});
},2000);
$('.pading-2').hover(function() {
	$('.none-2').fadeIn(1000).toggleClass('mobile-menu-2-block');
}, function() {
	$('.none-2').fadeOut('fast');
});
$('.pading-3').hover(function() {
	$('.none-3').fadeIn(1000).toggleClass('mobile-menu-2-block');
}, function() {
	$('.none-3').fadeOut('fast');
});
$('.pading-4').hover(function() {
	$('.none-4').fadeIn(1000).toggleClass('mobile-menu-2-block');
}, function() {
	$('.none-4').fadeOut('fast');
});
$('.pading-5').hover(function() {
	$('.none-5').fadeIn(1000).toggleClass('mobile-menu-2-block');
}, function() {
	$('.none-5').fadeOut('fast');
});



$(document).ready(function() {
	$('.map-position-a-1').hover(function() {
		$('.map-img-secondary').fadeIn('fast');
	}, function() {
		$('.map-img-secondary').fadeOut('fast');
	});
	$('.map-position-a-2').hover(function() {
		$('.map-img-secondary-2').fadeIn('fast');
	}, function() {
		$('.map-img-secondary-2').fadeOut('fast');
	});
	$('.map-position-a-3').hover(function() {
		$('.map-img-secondary-3').fadeIn('fast');
	}, function() {
		$('.map-img-secondary-3').fadeOut('fast');
	});
	$('.map-position-a-4').hover(function() {
		$('.map-img-secondary-4').fadeIn('fast');
	}, function() {
		$('.map-img-secondary-4').fadeOut('fast');
	});
	$('.map-position-a-5').hover(function() {
		$('.map-img-secondary-5').fadeIn('fast');
	}, function() {
		$('.map-img-secondary-5').fadeOut('fast');
	});
	$('.map-position-a-6').hover(function() {
		$('.map-img-secondary-6').fadeIn('fast');
	}, function() {
		$('.map-img-secondary-6').fadeOut('fast');
	});
});



let handleLinkClick = function(elem, toggleheader) {
	let allowed =
		{
			'/': true,
			'/allExcursions': true,
			'/excursion': true
		}
	let page;
	window.event.preventDefault();
	page = elem.attr('href');
	window.history.pushState({page: "another"}, "another page", page);
	window.scrollTo(0, 0);
	if(!page.startsWith("http") && allowed["/"+page.split("/")[1]]) {
		$('#page-content').load(page + ' #page-content', toggleheader ? toggleHeader: function(){});
		return true;
	}
	let element=document.createElement("a");
	element.href=page;
	element.style["position"]="absolute";
	element.style["left"]="-9999px";
	element.style["top"]="-9999px";
	element.style["opacity"]="0";
	document.documentElement.appendChild(element);
	element.click();
	document.documentElement.removeChild(element);
}

$(document).ready(function (e) {
	$('a').not('.mobile-menu-bloc2 li a').click(function () {
		handleLinkClick($(this));
	});
	$('.mobile-menu-bloc2 li a').click(function () {
		handleLinkClick($(this), true);
	});
});
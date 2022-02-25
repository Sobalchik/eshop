function sort(type){

	$.ajax({
		url: "http://eshop/sort",
		type: "POST",
		data: {"sortType": type },
		success: function(data) {
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			paginate();
		}
	});
}

function find(){


	$.ajax({
		url: "http://eshop/sort",
		type: "POST",
		data: {"name": name },
		success: function(data) {
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			paginate();
		}
	});
}

function sortByTag(){

	var checked = [];
	$('input:checkbox:checked').each(function() {
		checked.push($(this).val());
	});

	console.log(checked);
	// document.querySelectorAll('input.checkbox:checked');
	//  var selectedCheckBoxes = document.querySelectorAll('input.checkbox:checked');
	//  var checkedValues = Array.from(selectedCheckBoxes).map(cb => cb.value);
	//  console.log(checkedValues);

	$.ajax({
		url: "http://eshop/sortByTag",
		type: "POST",
		data: { "tagList":checked },
		success: function(data) {
			console.log(data);
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			paginate();
		}
	});
}

(function($) {
	function setChecked(target) {
		var checked = $(target).find("input[type='checkbox']:checked").length;
		if (checked) {
			$(target).find('select option:first').html('Выбрано: ' + checked);
		} else {
			$(target).find('select option:first').html('Выберите из списка');
		}
	}

	$.fn.checkselect = function() {
		this.wrapInner('<div class="checkselect-popup"></div>');
		this.prepend(
			'<div class="checkselect-control">' +
			'<select class="form-control"><option></option></select>' +
			'<div class="checkselect-over"></div>' +
			'</div>'
		);

		this.each(function(){
			setChecked(this);
		});
		this.find('input[type="checkbox"]').click(function(){
			setChecked($(this).parents('.checkselect'));
		});

		this.parent().find('.checkselect-control').on('click', function(){
			$popup = $(this).next();
			$('.checkselect-popup').not($popup).css('display', 'none');
			if ($popup.is(':hidden')) {
				$popup.css('display', 'block');
				$(this).find('select').focus();
			} else {
				$popup.css('display', 'none');
			}
		});

		$('html, body').on('click', function(e){
			if ($(e.target).closest('.checkselect').length == 0){
				$('.checkselect-popup').css('display', 'none');
			}
		});
	};
})(jQuery);

$('.checkselect').checkselect();
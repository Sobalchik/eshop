

function sort(type){
	console.log('sorted')
	$.ajax({
		url: "http://eshop/sort",
		type: "POST",
		data: {"sortType": type },
		success: function(data) {
			console.log(data);
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			$.getScript( "pagination.js" ).done(function () {// Number of items and limits the number of items per page
				var numberOfItems = $("#content .block").length;
				let pathname = document.location.pathname;
				var limitPerPage = 5;
				switch (pathname){
					case "/admin/excursions":
						limitPerPage = 7;
						break;
					case "/admin/orders":
						limitPerPage = 5;
						break;
				}


				// Total pages rounded upwards
				var totalPages = Math.ceil(numberOfItems / limitPerPage);
				// Number of buttons at the top, not counting prev/next,
				// but including the dotted buttons.
				// Must be at least 5:
				var paginationSize = 7;
				var currentPage;

				function showPage(whichPage) {
					if (whichPage < 1 || whichPage > totalPages) return false;
					currentPage = whichPage;
					$("#content .block").hide()
						.slice((currentPage-1) * limitPerPage,
							currentPage * limitPerPage).show();
					// Replace the navigation items (not prev/next):
					$(".pagination li").slice(1, -1).remove();
					getPageList(totalPages, currentPage, paginationSize).forEach( item => {
						$("<li>").addClass("page-item")
							.addClass(item ? "current-page" : "disabled")
							.toggleClass("active", item === currentPage).append(
							$("<a>").addClass("page-link").attr({
								href: "javascript:void(0)"}).text(item || "...")
						).insertBefore("#next-page");
					});
					// Disable prev/next when at first/last page:
					$("#previous-page").toggleClass("disabled", currentPage === 1);
					$("#next-page").toggleClass("disabled", currentPage === totalPages);
					return true;
				}

				// Include the prev/next buttons:
				$(".pagination").append(
					$("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
						$("<a>").addClass("page-link").attr({
							href: "javascript:void(0)"}).text("Prev")
					),
					$("<li>").addClass("page-item").attr({ id: "next-page" }).append(
						$("<a>").addClass("page-link").attr({
							href: "javascript:void(0)"}).text("Next")
					)
				);
				// Show the page links
				$("#content").show();
				showPage(1);

				// Use event delegation, as these items are recreated later
				$(document).on("click", ".pagination li.current-page:not(.active)", function () {
					return showPage(+$(this).text());
				});
				$("#next-page").on("click", function () {
					return showPage(currentPage+1);
				});

				$("#previous-page").on("click", function () {
					return showPage(currentPage-1);
				});});
		}
	});

}

var btn = document.querySelector('button');
btn.addEventListener('click', function() {
	btn.style.filter ='brightness(1)';
});
btn.removeEventListener('click', function() {
	btn.style.filter = 'brightness(0)';
})
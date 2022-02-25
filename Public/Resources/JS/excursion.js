function dateDeleteAjax(dateId, dateName)
{
	$('#'+dateName).hide();
	console.log(dateId);
	$.ajax({
		url: "/admin/excursions/deleteDate",
		type: "POST",
		data: {"dateId": dateId },
		success: function(data) {
			$('#'+dateName).empty();
		}
	});
}
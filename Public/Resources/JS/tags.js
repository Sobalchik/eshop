function tagDeleteAjax(tagId)
{
	$.ajax({
		url: "/admin/tag/deleted?id="+tagId,
		type: "POST",
		data: {"tagId": tagId },
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	});
}
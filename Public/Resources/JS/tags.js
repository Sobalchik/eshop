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

function tagEditAjax(tagId, tagName,tagNameLink)
{
	console.log(tagName);
	$('#'+tagName).removeAttr('disabled');
	$('#'+tagNameLink).text('Save');
	$('#'+tagNameLink).attr('onclick', 'tagSaveAjax("'+tagId+'","'+tagName+'")');
}

function tagSaveAjax(tagId, tagName)
{
	tagNameValue = $('#'+tagName).val();
	$.ajax({
		url: "/admin/tag/saved",
		type: "POST",
		data: {"tagId": tagId, "tagName": tagNameValue},
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	})
}
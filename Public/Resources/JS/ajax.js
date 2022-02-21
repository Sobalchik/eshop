function ajax_save_order(order)
{
	$.ajax({
		url: "http://eshop/admin/orders",
		type: "POST",
		data: {"order": order },
		success: function(data) {
			console.log(data);
			$('#ajax').empty();
			document.getElementById('admin-orders').innerHTML = data;
			updateURL(order)
		}
	});
}
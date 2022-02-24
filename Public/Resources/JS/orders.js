function saveOrder(idOrder,fioOrder,emailOrder,phoneOrder,statusOrder)
{

	$.ajax({
		url: "/admin/orders/saved",
		type: "POST",
		data: {"idOrder": idOrder, "fioOrder" : fioOrder,
		"emailOrder" : emailOrder, "phoneOrder" : phoneOrder,
		"statusOrder" : statusOrder},
		success: function(data) {
			console.log(data);
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
			paginate();
		}
	});
}

function deleteOrder(idOrder)
{

	$.ajax({
		url: "/admin/orders/deleted",
		type: "POST",
		data: {"idOrder": idOrder},
		success: function(data) {
			console.log(data);
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
			paginate();
		}
	});
}
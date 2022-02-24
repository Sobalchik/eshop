function saveOrder(idOrder,fioOrder,emailOrder,phoneOrder,statusOrder)
{
	orderFioValue = $('#'+fioOrder).val();
	orderEmailValue = $('#'+emailOrder).val();
	orderPhoneValue = $('#'+phoneOrder).val();
	orderstatusValue = $('#'+statusOrder).val();
	$.ajax({
		url: "/admin/orders/saved",
		type: "POST",
		data: {"idOrder": idOrder, "fioOrder" : orderFioValue,
		"emailOrder" : orderEmailValue, "phoneOrder" : orderPhoneValue,
		"statusOrder" : orderstatusValue},
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
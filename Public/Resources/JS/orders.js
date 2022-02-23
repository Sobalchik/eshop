function saveOrder(id,fio,email,phone,status)
{

	$.ajax({
		url: "/admin/orders/saved",
		type: "POST",
		data: {"id": id, "fio" : fio,
		"email" : email, "phone" : phone,
		"status" : status},
		success: function(data) {
			console.log(data);
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
		}
	});
}
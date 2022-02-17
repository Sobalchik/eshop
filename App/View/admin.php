<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0.8, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Title</title>
	<link rel="stylesheet" type="text/css" href="/Resources/CSS/Reset.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">




	<link rel="stylesheet" type="text/css" href="/Resources/CSS/custom.css">

</head>
<body style="background-color: #1e1e2e">


<nav class="asd navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a style="color: white" class="navbar-brand" href="#">Navbar</a>
			<form class="d-flex" method="post">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Поиск</button>
			</form>
	</div>
</nav>

<div class="container-s">
	<div class="navbar-s">
		<div class="bloc1-navbar">
			<img class="logo-navbar" src="/Resources/Images/logo_template14%201.png">
			<div class="bloc1-navbar-a">
				<button type="button" class="btn btn-primary btn-lg">Экскурсии</button>
				<button type="button" class="btn btn-secondary btn-lg">Заказы</button>
			</div>
		</div>
	</div>





	<div class="bloc2">
		<div class="bloc2-cont">


				<div style="padding: 3px 0; display: flex; align-items: center;">
					<p class="accordion-item-bloc2-text-help">№1</p>
					<div id="accordionPanelsStayOpenExample">
						<div style="border: none" class="accordion-item">
							<form method="post">
								<div class="accordion-item-bloc1">
									<div style="background-color: #3698f8" class="accordion-item-bloc2">
										<p class="accordion-item-bloc2-text">Название -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<p class="accordion-item-bloc2-text">Стоимость -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<p class="accordion-item-bloc2-text">Необ.кол-во -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<button style="border: none;background-color: #3698f8;">Edit</button>
									</div>
									<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse1" aria-expanded="false" aria-controls="panelsStayOpen-collapse1">+</button>
								</div>
								<div id="panelsStayOpen-collapse1" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading1">
									<div  style="background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
										<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Дата -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<p style="margin-right: 39px;" class="accordion-item-bloc2-text">Требуется -></p>
										<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
										<button style="border: none;background-color: #3698f8;">Delete</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>



			<div style="padding: 3px 0; display: flex; align-items: center;">
				<p class="accordion-item-bloc2-text-help">№1</p>
				<div id="accordionPanelsStayOpenExample">
					<div style="border: none" class="accordion-item">
						<form method="post">
							<div class="accordion-item-bloc1">
								<div style="background-color: #3698f8" class="accordion-item-bloc2">
									<p class="accordion-item-bloc2-text">Название -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<p class="accordion-item-bloc2-text">Стоимость -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<p class="accordion-item-bloc2-text">Необ.кол-во -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<button style="border: none;background-color: #3698f8;">Edit</button>
								</div>
								<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2" aria-expanded="false" aria-controls="panelsStayOpen-collapse2">+</button>
							</div>
							<div id="panelsStayOpen-collapse2" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading2">
								<div  style="background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
									<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Дата -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<p style="margin-right: 39px;" class="accordion-item-bloc2-text">Требуется -></p>
									<input style="background-color: #000000; border: none; color: white; margin-right: 10px" type="text" value="123">
									<button style="border: none;background-color: #3698f8;">Delete</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>



</div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript"></script>

</body>
</html>
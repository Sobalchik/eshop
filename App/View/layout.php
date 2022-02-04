<?php
/** @var string $content */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0.8, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Title</title>

	<link rel="stylesheet" type="text/css" href="../../Public/Resources/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="../../Public/Resources/CSS/Reset.css">
</head>
<body>
<div class="header">
	<div class="menu">
		<div class="bloc-logo">
			<img class="header-logo" src="../../Public/Resources/Images/logo_template14%201.png">
		</div>
		<div class="bloc-menu">
			<a href="/Public/placeholder" class="menu-button">Экскурсии</a>
			<a class="menu-button">Клиентам</a>
			<a class="menu-button">Блог</a>
			<a class="menu-button">Отзывы</a>
			<a class="menu-button">О нас</a>
		</div>
		<div class="exit-log">
			<a class="exit-button"><img src="../../Public/Resources/Images/1.png"> Личный кабинет</a>
		</div>
	</div>
</div>
<div class="content">

	<div class="bloc1">
		<div class="main-bloc">
			<div class="main-bloc-fix">
				<div class="main-bloc-img">
					<img src="../../Public/Resources/Images/1442912%201.png">
				</div>
				<div class="main-bloc-text">
					<p class="main-bloc-h1">ВОЗМОЖНОСТИ ДЛЯ НАСТРОЙКИ</p>
					<p class="main-bloc-p">Создайте индивидуальную поездку за меньшее время</p>
				</div>
			</div>

			<div class="main-bloc-fix">
				<div class="main-bloc-img">
					<img src="../../Public/Resources/Images/1442912%201.png">
				</div>
				<div class="main-bloc-text">
					<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ОПЫТА</p>
					<p class="main-bloc-p"  style="margin-top: 10px">Раздвиньте свои границы и испытайте приключение</p>
				</div>
			</div>

			<div class="main-bloc-fix">
				<div class="main-bloc-img">
					<img src="../../Public/Resources/Images/1442912%201.png">
				</div>
				<div class="main-bloc-text" style="width: 260px">
					<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ УСЛУГ</p>
					<p class="main-bloc-p"  style="margin-top: 10px">Чувствовать себя в безопасности и получать поддержку во время путешествия</p>
				</div>
			</div>

			<div class="main-bloc-fix">
				<div class="main-bloc-img">
					<img src="../../Public/Resources/Images/1442912%201.png">
				</div>
				<div class="main-bloc-text" style="width: 240px">
					<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ДОВЕРИЯ</p>
					<p class="main-bloc-p"  style="margin-top: 10px">Получите открытую и честную консультацию. Всегда!</p>
				</div>
			</div>
		</div>
	</div>
	<div class="bloc2">
		<p class="bloc-2-text-top">Топ Экскурсий</p>
		<div class="bloc-2-contener">

			<?= $content?>
		</div>
	</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" async src="../../Public/Resources/JS/some.js"></script>
</body>
</html>

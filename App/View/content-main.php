<?php
/** @var array $excursions */
use App\Lib\Render;
?>



<div class="bloc1">
	<div class="main-bloc">
		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="./Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1">ВОЗМОЖНОСТИ ДЛЯ НАСТРОЙКИ</p>
				<p class="main-bloc-p">Создайте индивидуальную поездку за меньшее время</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="./Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ОПЫТА</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Раздвиньте свои границы и испытайте приключение</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="./Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text" style="width: 260px">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ УСЛУГ</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Чувствовать себя в безопасности и получать поддержку во время путешествия</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="./Resources/Images/1442912%201.png">
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
		<?= Render::render("content-card",['excursions'=>$excursions])?>
	</div>
</div>

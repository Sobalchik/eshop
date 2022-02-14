<?php
/** @var array $excursions */
use App\Lib\Render;
?>



<div class="bloc1">
	<div class="main-bloc">
		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1">ВОЗМОЖНОСТИ ДЛЯ НАСТРОЙКИ</p>
				<p class="main-bloc-p">Создайте индивидуальную поездку за меньшее время</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ОПЫТА</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Раздвиньте свои границы и испытайте приключение</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text" style="width: 260px">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ УСЛУГ</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Чувствовать себя в безопасности и получать поддержку во время путешествия</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
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
		<?= Render:: renderContent("content-card",['excursions'=>$excursions])?>
	</div>
</div>
<div class="bloc3-difference">
	<div style="display: flex;justify-content: flex-end;">
		<img style="" src="/Resources/Images/happy-retired-couple-enjoying-nature-in-the-californian-forest 3.png">
	</div>
	<div class="difference-text">
		<p class="difference-text-main">Что отличает эти поездки от других?</p>
		<p class="difference-text-secondary">Мы считаем, что отпуск должен быть чем-то большим, чем номер в отеле, перелет и прокат автомобиля. Оно должно быть больше, чем сумма его частей. Мы также верим, что вызов может помочь вам расти, а поездка может всколыхнуть душу. Мы создаем путешествия, которые стоит совершить - для путешественника, для принимающей стороны и для всего мира.</p>
	</div>
</div>
<div class="bloc4-map">
	<div>
		<img src="/Resources/Images/карта бэг 1.png">
	</div>
	<div class="bloc4-map-text">
		<p class="map-text-main">КУДА МОЖНО ОТПРАВИТЬСЯ?</p>
		<p class="map-text-secondary">Откройте для себя мир!</p>
		<p class="map-text-secondary-2"> Начать приключение просто — выбери интересное направление и отправь заявку организатору. Цена указана за одного человека. Приятного отдыха и ярких впечатлений!</p>
		<a>Посмотреть экскурсии</a>
	</div>
</div>

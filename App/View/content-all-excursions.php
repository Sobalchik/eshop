<?php
/** @var array $excursions */
/** @var int $page */
/** @var int $pageCount */
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
	<div class="bloc-2-contener">
		<?= Render:: renderContent("content-card",['excursions'=>$excursions])?>
		<div style="display: flex;justify-content: space-between;">

			<?php if($page > 1){ ?>
			<a class="cta" href="http://eshop/allExcursions/<?= ($page-1) > 1 ?($page-1): 1 ?>">
				<img src="/Resources/Images/icons8-стрелка,-указывающая-влево-30.png">
				<span>назад</span>
			</a>
			<?php } ?>

			<?php if($page < $pageCount){ ?>
				'<a class="cta" href="http://eshop/allExcursions/<?= ($page+1) < $pageCount ?($page+1): $pageCount ?>">
				<img src="/Resources/Images/icons8-длинная-стрелка-вправо-30.png">
				<span>вперед</span>
				</a>'
			<?php } ?>

		</div>
	</div>
</div>
<script>
	let cords = ['scrollX','scrollY'];
	// Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY
	window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]));
	// Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)
	window.scroll(...cords.map(cord => localStorage[cord]));</script>
<?php
/** @var array $excursions */
/** @var int $page */
/** @var int $pageCount */
use App\Lib\Render;
?>


<div class="bloc1-asdas">
	<div class="main-bloc">
	</div>
</div>
<div class="bloc2">
	<div class="bloc-2-contener">
		<div id ="content"> <?= Render:: renderContent("content-card",['excursions'=>$excursions])?></div>
		<div style="display: flex;justify-content: space-between;">
		</div>
	</div>
	<div class="pagination">

</div>
<script>
	let cords = ['scrollX','scrollY'];
	// Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY
	window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]));
	// Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)
	window.scroll(...cords.map(cord => localStorage[cord]));</script>

	<script type="text/javascript" async src="/Resources/JS/pagination.js"></script>


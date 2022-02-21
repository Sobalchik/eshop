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
		<?= Render:: renderContent("content-card",['excursions'=>$excursions])?>
		<div style="display: flex;justify-content: space-between;">

			<?php if($page > 1){ ?>
			<a class="cta" href="/allExcursions/<?= ($page-1) > 1 ?($page-1): 1 ?>">
				<img src="/Resources/Images/icons8-стрелка,-указывающая-влево-30.png">
				<span>назад</span>
			</a>
			<?php } ?>

			<?php if($page < $pageCount){ ?>
				<a class="cta" href="/allExcursions/<?= ($page+1) < $pageCount ?($page+1): $pageCount ?>">
				<img src="/Resources/Images/icons8-длинная-стрелка-вправо-30.png">
				<span>вперед</span>
				</a>
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
<?php
/** @var array $excursions **/
/** @var array $continentTags **/
/** @var array $countryTags **/
/** @var array $familyTags **/
use App\Lib\Render;
?>


<div class="bloc1-all-main-excurs">
	<div class="main-bloc">
	</div>
</div>
<div class="bloc2">
	<div class="bloc-2-contener-poisk">
		<input class="form-control-poisk" type="search" placeholder="Search" aria-label="Search" name="search-excursions">
		<button class="btn-outline-posik" type="submit">Поиск</button>
	</div>
	<div class="bloc-2-contener-tegi-list">
		<div class="checkselect">
			<?php foreach ($continentTags as $continentTag ):?>
				<label><input class="custom-checkbox"  type="checkbox" name="brands[]" value="<?= $continentTag->getId()?>"> <?= $continentTag->getName()?></label>
			<?php endforeach?>
		</div>

		<div class="checkselect">
			<?php foreach ($countryTags as $countryTag ):?>
				<label><input  type="checkbox" name="brands[]" value="<?= $countryTag->getId()?>"> <?= $countryTag->getName()?></label>
			<?php endforeach?>
		</div>

		<div class="checkselect">
			<?php foreach ($familyTags as $familyTag ):?>
				<label><input  type="checkbox" name="brands[]" value="<?= $familyTag->getId()?>"> <?= $familyTag->getName()?></label>
			<?php endforeach?>
		</div>

		<button class="glow-button" onclick="sortByTag()"> показать </button>
	</div>


	<div  class="bloc-2-contener-tegi-renting">
		<button class="glow-button" onclick="sort(1)">price-asc</button>
		<button class="glow-button" onclick="sort(2)">price-desc</button>
		<button class="glow-button" onclick="sort(3)">rating-desc</button>
	</div>


	<div class="bloc-2-contener">
		<div class="content" id ="content"> <?= Render:: renderContent("content-card",['excursions'=>$excursions])?></div>
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

	<script type="text/javascript" defer src="/Resources/JS/pagination.js"></script>
	<script type="text/javascript" defer src="/Resources/JS/sort.js"></script>



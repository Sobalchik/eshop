<?php
/** @var array $excursions */
$i=0;
?>

<?php foreach ($excursions as $excursion): ?>
<div class="bloc-2-box">
	<div class="asd">
		<div class="box-date">
			<p class="box-date-num">05</p>
			<p class="box-date-text">Марта</p>
		</div>
		<div class="box-h1">
			<p class="box-h1-1"><?= $excursion->getNameCity()?></p>
			<p class="box-h1-2"><?= $excursion->getNameCountry()?></p>
		</div>
		<div class="box-bottom">
			<img src="../../Public/Resources/Images/солнечно%201.png">
			<p class="box-bottom-weather">24°C</p>
			<p class="box-bottom-many">₽ <?= $excursion->getPrice()?></p>
		</div>
	</div>
	<div class="overlay">
		<div class="overlay-like">
			<a><img src="../../Public/Resources/Images/2961957%201.svg"></a>
		</div>
		<div class="loc">
			<p class="overlay-progress-text">asd</p>
			<div class="progress">
				<div class="progress-value" style="width: 30%;"></div>
			</div>
		</div>
		<div class="overlay-detailed">
			<a>Подробнее<img src="../../Public/Resources/Images/2989988%201.svg"></a>
		</div>
	</div>
</div>
	<?php $i++;
	if ($i==8)break;?>
<?php endforeach; ?>

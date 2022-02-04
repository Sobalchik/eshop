<?php
/** @var array $excursions */

$i = 0;

$helper = App\Helper\Helper::getInstance();

?>

<?php
foreach ($excursions as $excursion): ?>
	<div class="bloc-2-box">
		<div class="asd">
			<div class="box-date">
				<p class="box-date-num"><?= $helper::conversionDateToNumber($excursion->getDateTravel()) ?></p>
				<p class="box-date-text"><?= $helper::conversionDateToMonth($excursion->getDateTravel()) ?></p>
			</div>
			<div class="box-h1">
				<p class="box-h1-1"><?= $excursion->getNameCity() ?></p>
				<p class="box-h1-2"><?= $excursion->getNameCountry() ?></p>
			</div>
			<div class="box-bottom">
				<img src="../../Public/Resources/Images/солнечно%201.png">
				<p class="box-bottom-weather"><?= $excursion->getDegrees()?>°C</p>
				<p class="box-bottom-many">₽ <?= $excursion->getPrice() ?></p>
			</div>
		</div>
		<div class="overlay">
			<div class="overlay-like">
				<a><img src="../../Public/Resources/Images/2961957%201.svg"></a>
			</div>
			<div class="loc">
				<p class="overlay-progress-text"><?= $excursion->getInternetRating() ?></p>
				<div class="progress">
					<div class="progress-value" style="width: <?= $excursion->getInternetRating() * 10 ?>%;"></div>
				</div>
			</div>
			<div class="overlay-detailed">
				<a>Подробнее<img src="../../Public/Resources/Images/2989988%201.svg"></a>
			</div>
		</div>
	</div>
	<?php
	$i++;
	if ($i == 8)
	{
		break;
	} ?>
<?php
endforeach; ?>

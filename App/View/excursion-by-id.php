<?php
/** @var array $excursions */
$helper = App\Helper\Helper::getInstance();
//print_r($excursions)
?>


<div class="detailed-page"></div>
<div class="detailed-page-bloc-card">
	<img class="img-bloc-card" src="../../Public/Resources/Images/прага%202.png">
	<div class="bloc-card-center">
		<div>
			<img src="../../Public/Resources/Images/2prague-3540898_960_720%202.png">
		</div>
		<div class="bloc-card-center-text-block">
			<p class="detailed-page-text-1">Экскурсия</p>
			<p class="detailed-page-text-2">“<?= $excursions->getNameCity() // тут должно быть название экскурсии нет в бд такой инфы ?>”</p>
			<p class="detailed-page-text-3"><?= $excursions->getFullDescription() ?></p>
			<p class="detailed-page-text-4">Что вас ожидает</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="../../Public/Resources/Images/image%201.png">Мини группа, автобусно-пешеходная
			</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="../../Public/Resources/Images/image%202.png"> Продолжительность <?= $helper::conversionDateToTime($excursions->getDateTravel()) ?>
			</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="../../Public/Resources/Images/image%203.png">Размер группы до 10 человек
			</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="../../Public/Resources/Images/image%204.png">Можно с детьми
			</p>
			<p class="detailed-page-text-7">Вы увидите</p>
			<div class="detailed-page-text-bloc-8">
				<div>
					<p class="detailed-page-text-9">
						<img src="../../Public/Resources/Images/image%205.png">Вацлавскую площадь</p>
					<p class="detailed-page-text-9">
						<img src="../../Public/Resources/Images/image%205.png">Карлову площадь </p>
					<p class="detailed-page-text-9">
						<img src="../../Public/Resources/Images/image%205.png">Пражский град </p>
				</div>
				<div style="padding-left: 80px">
					<p class="detailed-page-text-9">
						<img src="../../Public/Resources/Images/image%205.png">Cобор Святого Вита </p>
					<p class="detailed-page-text-9">
						<img src="../../Public/Resources/Images/image%205.png">Карлов мост</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="detailed-page-bloc-img">

</div>
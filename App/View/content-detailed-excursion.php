<?php
/** @var string $excursions */
$helper = App\Lib\Helper::getInstance();
?>


<div class="detailed-page"></div>
<div class="detailed-page-bloc-card">
	<img class="img-bloc-card" src="/Resources/Images/прага%202.png">
	<div class="bloc-card-center">
		<div>
			<img src="<?= $excursions->getImageList() ?>">
		</div>
		<div class="bloc-card-center-text-block">
			<p class="detailed-page-text-1">Экскурсия</p>
			<p class="detailed-page-text-2">“<?= $excursions->getNameCity() ?>”</p>
			<p class="detailed-page-text-3"><?=$excursions->getFullDescription() ?></p>
			<p class="detailed-page-text-4">Что вас ожидает</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%201.png">Мини группа, автобусно-пешеходная
			</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%202.png"><?=$helper::conversionDateToTime($excursions->getDateTravel()) ?></p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%203.png">Размер группы до 10 человек
			</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%204.png">Можно с детьми
			</p>
			<p class="detailed-page-text-7">Вы увидите</p>
			<div class="detailed-page-text-bloc-8">
				<div>
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png">Вацлавскую площадь</p>
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png">Карлову площадь </p>
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png">Пражский град </p>
				</div>
				<div style="padding-left: 80px">
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png">Cобор Святого Вита </p>
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png">Карлов мост</p>
				</div>
			</div>
			<div>
				<button id="pay" class="detailed-page-button">Заказать  экскурсию</button>
			</div>
		</div>
	</div>
</div>
<div class="detailed-page-bloc-img">
	<div class="page-bloc-img">
		<img src="/Resources/Images/прага-1 1.png">
		<img src="/Resources/Images/image 6.png">
	</div>
</div>


<div class="detailed-page-bloc-pop-up" id="pay-45">
	<div class="dm-table">
		<div class="dm-cell">
			<div class="bloc-dm-modal">
				<div class="modal-header-detailed-page">
					<button class="close-detailed-page" id="pil2">X</button>
				</div>
				<div class="detailed-page-bloc-pop-up-cont">
					<div>
						<p class="detailed-page-application-text1">Оставьте заявку</p>
						<p class="detailed-page-application-text2">и мы с вами свяжемся в удобное для вас время</p>
					</div>
					<form action="/createOrder" method="post">
						<input class="form-application-input" style="display: none" type="hidden" name="product_id" value="<?=$excursions->getId()?>">
						<input class="form-application-input" style="display: none" type="hidden" name="status_id" value="1">
						<input class="form-application-input" style="display: none" type="hidden" name="csrf_token" value="<?=$helper::generateFormCsrfToken()?>">
						<p class="form-application-text">Укажите ваше имя</p>
						<input class="form-application-input" type="text" name="name" required="required" placeholder="     Имя...">
						<p class="form-application-text">Укажите ваш телефон</p>
						<input class="form-application-input" type="tel" name="telephone"  pattern="\+7[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required placeholder="     +79118550378">
						<p class="form-application-text">Укажите ваш email</p>
						<input class="form-application-input" type="text" name="email" placeholder="     Email...">
						<p class="form-application-text">Укажите ваш комментарий</p>
						<input class="form-application-input" type="text" name="comment" required="required" placeholder="     Комментарий...">
						<div style="text-align: center; padding-top: 40px">
							<input class="form-application-input-submit" type="submit" value="Отправить">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

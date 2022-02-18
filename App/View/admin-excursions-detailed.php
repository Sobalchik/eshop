<?php
/** @var \App\Entity\Excursion $excursion */
?>

<div style="color: white" class="admin-excursions-detaild">
	<form>
		<div style="display: flex">
			<div class="admin-excursions-detaild-bloc1">
				<h1>Вид карты</h1>
				<div>
					<p>дата</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getDateTravel(); ?>">
					<p>страна</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getNameCountry();?>">
					<p>погода</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="Солнечно">
					<p>цена</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getPrice();?>">
				</div>
				<div>
					<p>Интернет</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="Есть">
					<p>Развлечения</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="Вхуу">
					<p>Обслуживание</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="Есть">
					<p>Оценка</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getRating();?>">
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc2">
				<h1>Общие данные</h1>
				<div>
					<p>название города</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getNameCity();?>">
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc3">
				<h1>Детальная страница</h1>
				<div>
					<p>Теги</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= implode(",",$excursion->getTagList());?>">
					<p>Время</p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getTagList();?>">
					<p>размер группы </p>
					<input type="text" class="inpit-me form-control" id="inlineFormInputName" value="<?= $excursion->getCountPersons();?>">
					<p>описание экскурсии</p>
					<textarea class="form-control" id="exampleFormControlTextarea1"><?= $excursion->getFullDescription();?></textarea>
				</div>
			</div>
		</div>
		<div class="admin-excursions-detaild-bloc4">
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-1" type="submit" value="<-back">
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="save">
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-3" type="submit" value="delete">
		</div>
	</form>
</div>

<?php
/** @var \App\Entity\Excursion $excursion */
/** @var array $typeTags */
$helper = App\Lib\Helper::getInstance();
?>
<div style="color: white" class="admin-excursions-detaild">
	<form action="/admin/excursions/saved" method="post">
		<div style="display: flex">
			<div class="admin-excursions-detaild-bloc1">
				<h1>Вид карты</h1>
				<div>
					<input style="display: none " type="text" class="input-me form-control" id="inlineFormInputName" name="id" value="<?= $excursion->getId() ?>">
					<p>страна</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="country" value="<?= $excursion->getNameCountry();?>">
					<p>температура</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="degrees" value="<?= $excursion->getDegrees();?>">
					<p>цена</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="price" value="<?= $excursion->getPrice();?>">
				</div>
				<div>
					<p>Интернет</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="iRating" value="<?= $excursion->getInternetRating();?>">
					<p>Развлечения</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="eRating" value="<?= $excursion->getEntertainmentRating();?>">
					<p>Обслуживание</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="sRating" value="<?= $excursion->getServiceRating();?>">
					<p>Оценка</p>
					<input type="text" disabled class="input-me form-control" id="inlineFormInputName" name="Rating" value="<?=$helper::calculationRating($excursion->getInternetRating(),$excursion->getEntertainmentRating(),$excursion->getServiceRating());?>">
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc2">
				<h1>Общие данные</h1>
				<div>
					<p>Название города</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="city" value="<?= $excursion->getNameCity();?>">
					<div class="form-row">
						<label>Изображения:</label>
						<div class="img-list" id="fileImageList"></div>
						<input id="fileImage" type="file" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif">
					</div>
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc3">
				<h1>Детальная страница</h1>
				<div>
					<p>Теги</p>
					<?php foreach ($typeTags as $typeTag):?>
						<p><select size="3" multiple  name="select_typeTag_<?=$typeTag->getId()?>[]">
								<option disabled><?=$typeTag->getName()?></option>
								<?php foreach ($typeTag->getTagsBelong() as $tagsBelong): ?>
								<? if (in_array($tagsBelong->getName(),$excursion->getTagList())){?>
										<option selected value="<?=$tagsBelong->getId()?>"><?=$tagsBelong->getName()?></option>
									<?} else {?>
										<option value="<?=$tagsBelong->getId()?>"><?=$tagsBelong->getName()?></option>
									<? }?>
								<?endforeach;?>
							</select></p>
					<?endforeach;?>
					<p>Время</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="duration" value="<?= $excursion->getDuration();?>">
					<p>Размер группы </p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="person" value="<?= $excursion->getCountPersons();?>">
					<p>Описание экскурсии</p>
					<textarea class="form-control" id="exampleFormControlTextarea1" name = 'description'><?= $excursion->getFullDescription();?></textarea>
				</div>
			</div>
		</div>
		<div class="admin-excursions-detaild-bloc4">
			<a href="/admin/excursions" class="admin-navbar-list-a">Назад</a>
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="Сохранить">
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-3" type="submit" value="Удалить">
		</div>
	</form>
</div>

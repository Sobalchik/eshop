<?php

/** @var \App\Entity\Excursion $excursion */

?>


<div style="color: white" class="admin-excursions-detaild">
	<form action="/admin/excursion/create" method="post">
		<div style="display: flex">
			<div class="admin-excursions-detaild-bloc1">
				<h1>Вид карты</h1>
				<div>
					<input style="display: none " type="text" class="input-me form-control" id="inlineFormInputName" name="id" value="">
					<p>Дата</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="date" value="">
					<p>Страна</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="country" value="">
					<p>Температура</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="degrees" value="">
					<p>Цена</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="price" value="">
				</div>
				<div>
					<p>Интернет</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="iRating" value="">
					<p>Развлечения</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="eRating" value="">
					<p>Обслуживание</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="sRating" value="">
					<p>Оценка</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="Rating" value="">
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc2">
				<h1>Общие данные</h1>
				<div>
					<p>Название города</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="city" value="">
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc3">
				<h1>Детальная страница</h1>
				<div>
					<p>Теги</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="tagList" value="">
					<p>Время</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="duration" value="">
					<p>Размер группы </p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="person" value="">
					<p>Описание экскурсии</p>
					<textarea class="form-control" id="exampleFormControlTextarea1" name = 'description'></textarea>
				</div>
			</div>
		</div>
		<div class="admin-excursions-detaild-bloc4">
			<a href="/admin/excursions" class="admin-navbar-list-a">Назад</a>
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="Сохранить">
		</div>
	</form>
</div>

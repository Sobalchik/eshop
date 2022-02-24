<?php /** @var array $excursions */ ?>

<div class="bloc2" id="content">
	<form style="margin-right: 40px" class="d-flex" action="/admin/excursion/found" method="post">
		<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-excursions">
		<button class="btn btn-outline-success" type="submit">Поиск</button>
	</form>
	<div class="bloc2-cont">
<?php
$counter = 1;

foreach ($excursions as $excursion):
?>
<div class="block">
<div style="padding: 3px 0; display: flex; align-items: center; ">
	<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
	<div id="accordionPanelsStayOpenExample">
		<div style="border: none; background-color:#3698f8 " class="accordion-item">
				<div  class="accordion-item-bloc1">
					<div style="background-color: #3698f8" class="accordion-item-bloc2">
						<p class="accordion-item-bloc2-text">Название</p>
						<p class="accordion-item-bloc2-text-2"><?= $excursion->getNameCity() ?></p>
						<p class="accordion-item-bloc2-text">Стоимость</p>
						<p class="accordion-item-bloc2-text-2"><?= $excursion->getPrice() ?></p>
						<p class="accordion-item-bloc2-text">Необ.кол-во</p>
						<p class="accordion-item-bloc2-text-2"><?= $excursion->getCountPersons() ?></p>
						<a href="/admin/detailed?id=<?=$excursion->getId();?>" class="admin-navbar-list-a">Изменить</a>
					</div>
					<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
				</div>
				<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">
					<?php
					foreach ($excursion->getExcursionOccupancyByDateTravel() as $datesPeople):
					?>
					<div  style="margin-top:10px;background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
						<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Дата</p>
						<p class="accordion-item-bloc2-text-2"><?= $datesPeople['dateTravel'] ?></p>
						<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано</p>
						<p class="accordion-item-bloc2-text-2"><?= $datesPeople['orderedExcursionsCount'] ?> / <?= $excursion->getCountPersons()?> </p>
						<form action="/admin/excursion/deleted" method="post">
							<input type="hidden" value="<?=$datesPeople['id'] ?>" name="id">
							<input type="submit" value="-" >
						</form>
					</div>
					<?php endforeach;?>
					<form action="/admin/excursions/addDate" method="post">
						<input type="hidden" value="<?= $excursion->getId()?>" name="id">
						<input class = "button-add-date" type="submit" value="Добавить дату">
						<input type="datetime-local" name="date">
					</form>


				</div>
		</div>
	</div>
</div>
</div>
	<?php $counter = $counter+1;
endforeach;?>
		<div  class="accordion-item-bloc1">
			<div style="background-color: #3698f8" class="accordion-item-bloc2">
				<a href="/admin/excursion/add" class="admin-navbar-list-a">Создать</a>
			</div>
		</div>
</div>
	<div class="pagination"></div>
</div>

<script type="text/javascript" async src="/Resources/JS/pagination.js"></script>

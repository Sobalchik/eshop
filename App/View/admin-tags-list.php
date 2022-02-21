<?php /** @var array $tags */ ?>

<div class="bloc2">
	<div class="bloc2-cont">
<?php
$counter = 1;
?>
<?
echo "<pre>";
var_dump($tags);
echo "</pre>";
?>
<?php foreach ($tags as $tag):?>
<div style="padding: 3px 0; display: flex; align-items: center;">
	<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
	<div id="accordionPanelsStayOpenExample">
		<div style="border: none" class="accordion-item">
			<form style="background-color:#3698f8 " method="post">
				<div class="accordion-item-bloc1">
					<div style="background-color: #3698f8" class="accordion-item-bloc2">
						<p class="accordion-item-bloc2-text">Название -></p>
						<p class="accordion-item-bloc2-text-2"><?=$tag?></p>
						<a href="/admin/detailed?id=" class="admin-navbar-list-a">Edit</a>
					</div>
					<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
				</div>
				<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">

					<div  style="margin-top:10px;background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
						<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Дата -></p>
						<p class="accordion-item-bloc2-text-2"></p>
						<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано -></p>
						<p class="accordion-item-bloc2-text-2"></p>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
<?php $counter = $counter+1;
endforeach;?>
</div>
</div>
<?php /** @var array $excursions */ ?>


<?php
$counter = 1;

foreach ($excursions as $excursion):
	#Видимость работы
	$excursion->setCountPersons(rand(3,10)); ?>
<div style="padding: 3px 0; display: flex; align-items: center;">
					<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
					<div id="accordionPanelsStayOpenExample">
						<div style="border: none" class="accordion-item">
							<form method="post">
								<div class="accordion-item-bloc1">
									<div style="background-color: #3698f8" class="accordion-item-bloc2">
										<p class="accordion-item-bloc2-text">Название -></p>
										<p class="accordion-item-bloc2-text-2"><?= $excursion->getNameCity() ?></p>
										<p class="accordion-item-bloc2-text">Стоимость -></p>
										<p class="accordion-item-bloc2-text-2"><?= $excursion->getPrice() ?></p>
										<p class="accordion-item-bloc2-text">Необ.кол-во -></p>
										<p class="accordion-item-bloc2-text-2"><?= $excursion->getCountPersons() ?></p>
										<button style="border: none;background-color: #3698f8;">Edit</button>
									</div>
									<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
								</div>
								<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">
									<div  style="background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
										<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Дата -></p>
										<p class="accordion-item-bloc2-text-2"><?= $excursion->getDateTravel() ?></p>
										<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано -></p>
										<p class="accordion-item-bloc2-text-2">3 / <?= $excursion->getCountPersons() - 3 ?></p>
										<button style="border: none;background-color: #3698f8; margin-left: 318px;">Delete</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php $counter = $counter+1;
endforeach;?>

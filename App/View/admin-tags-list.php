<?php /** @var array $typeTags */ ?>

<div class="bloc2" id="tagsList">
	<div class="bloc2-cont">
		<?php
		$counter = 1;
		?>
		<?php foreach ($typeTags as $typeTag):?>
			<div style="padding: 3px 0; display: flex; align-items: center;">
				<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
				<div id="accordionPanelsStayOpenExample">
					<div style="border: none" class="accordion-item">
						<form style="background-color:#3698f8 " method="post">
							<div class="accordion-item-bloc1">
								<div style="background-color: #3698f8" class="accordion-item-bloc2">
									<p class="accordion-item-bloc2-text">Название -></p>
									<input class="inpit-me-order form-control" id="typeTagName_<?=$typeTag->getId()?>" value="<?=$typeTag->getName()?> " disabled>
									<a href="/admin/detailed?id=" class="admin-navbar-list-a">Edit</a>
									<? if ($typeTag->getTypeTagBindTag()==0){?>
										<a href="/admin/detailed?id=" class="admin-navbar-list-a ">Delete</a>
									<?} else {?>
										<a href="javascript:void(0)" onclick="alert('Удалить нельзя! У данного типа есть тэги');" class="admin-navbar-list-a ">Delete</a>
									<? } ?>
								</div>
								<button style="border: none;background-color: #3698f8;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
							</div>
							<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">
								<?php
								foreach ($typeTag->getTagsBelong() as $tagsBelong):
									?>
									<div  style="margin-top:10px;background-color: #3698f8;display: flex"  class="accordion-item-bloc3">
										<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Значение тэга -></p>
										<input class="inpit-me-order form-control" id="tagName_<?=$tagsBelong->getId()?>" value="<?=$tagsBelong->getName()?> " disabled>
										<a href="javascript:void(0)" onclick="tagEditAjax('<?=$tagsBelong->getId()?>','tagName_<?=$tagsBelong->getId()?>','tagNameLink_<?=$tagsBelong->getId()?>')" class="admin-navbar-list-a" id="tagNameLink_<?=$tagsBelong->getId()?>">Edit</a>
										<? if ($tagsBelong->getTagBindProduct()==0){?>
											<a href="javascript:void(0)" onclick="tagDeleteAjax('<?=$tagsBelong->getId()?>')" class="admin-navbar-list-a ">Delete</a>
										<?} else {?>
											<a href="javascript:void(0)" onclick="alert('Удалить нельзя! Тэг привязан к эскурсиям');" class="admin-navbar-list-a ">Delete</a>
										<? } ?>
									</div>
								<?php endforeach;?>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php $counter = $counter+1;
		endforeach;?>
	</div>
</div>
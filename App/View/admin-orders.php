<?php
/**@var array $orders */
/**@var array $statuses */
$helper = App\Lib\Helper::getInstance();
?>
<div class="bloc2">
	<input id="showText" class="admin-excursions-detaild-bloc4-input admin-input-color-1"  type="checkbox" checked>
	<div class="bloc2-cont">
		<?php
		foreach ($orders as $order): ?>
			<form action="/admin/orders/saved?id=<?=$order->getId() ?>" method="post">
				<div class="admin-orders">
					<label style="margin-right: 20px" class="admin-orders-text" >№<?= $order->getId() ?></label>
					<div class="admin-orders-bloc1">
						<form method="post">
							<div class="admin-orders-bloc1-form">
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">ФИО</p>
										<input  class="inpit-me-order form-control" id="inlineFormInputName" name="fio" value="<?= $order->getFio() ?> " disabled>
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Номер</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="phone" value="<?= $order->getPhone() ?> " disabled>
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
											<p class="admin-orders-text">Почта</p>
											<input class="inpit-me-order form-control" id="inlineFormInputName" name="email" value="<?= $order->getEmail() ?> " disabled>
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Статус</p>
										<select class="inpit-me-order form-control va" id="inlineFormInputName" name="status">
											<?php
											foreach ($statuses as $status): ?>
												<option <?= $helper::noRepeatStatus($order->getStatus(),
													$status["name"]) ?>
													value="<?= $status["id"] ?>"><?= $status["name"] ?></option>
											<?php
											endforeach; ?>
										</select>
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Название.экс</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="nameExcursion" value="<?= $order->getExcursionName() ?> " disabled>
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Дата</p>
										<input id="inlineFormInputName" class="inpit-me-order form-control"  name="date" value="<?= $order->getDateTravel() ?> " disabled>
									</div>
								</div>
								<div class="admin-orders-bloc1-clom2">
									<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="save">
									<input class="admin-excursions-detaild-bloc4-input admin-input-color-3" type="submit" value="delete">

								</div>
							</div>
					</div>
				</div>
			</form>
		<?php
		endforeach; ?>
	</div>
</div>

<script type="text/javascript">
	$('#showText').click(function(){
		if ($('#showText').is(':checked')){
			$('.inpit-me-order').prop('disabled', true);
		} else {
			$('.inpit-me-order').prop('disabled', false);
		}
	});
</script>

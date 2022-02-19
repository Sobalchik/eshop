<?php
/**@var array $orders */
/**@var array $statuses */
$helper = App\Lib\Helper::getInstance();
?>
<div class="bloc2">
	<div class="bloc2-cont">
		<?php
		foreach ($orders as $order): ?>
			<form action="/admin/orders/saved/<?=$order->getId() ?>" method="post">
				<div class="admin-orders">
					<label style="margin-right: 20px" class="admin-orders-text" >№<?= $order->getId() ?></label>
					<div class="admin-orders-bloc1">
						<form method="post">
							<div class="admin-orders-bloc1-form">
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">ФИО</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="fio" value="<?= $order->getFio() ?>">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Номер</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="phone" value="<?= $order->getPhone() ?>">
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Почта</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="email" value="<?= $order->getEmail() ?>">
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
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="nameExcursion" value="<?= $order->getExcursionName() ?>">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Дата</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="date" value="<?= $order->getDateTravel() ?>">
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
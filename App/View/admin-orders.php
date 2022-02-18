<?php
/** @var array $orders */
?>
<div class="bloc2">
	<div class="bloc2-cont">
		<?php foreach ($orders as $order): ?>
		<div class="admin-orders">
			<p style="margin-right: 20px" class="admin-orders-text">№<?=$order->getId()?></p>
			<div class="admin-orders-bloc1">
				<form method="post">
					<div class="admin-orders-bloc1-form">
						<div class="admin-orders-bloc1-clom1">
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">ФИО</p>
								<p class="inpit-me-order form-control"><?=$order->getFio()?></p>
							</div>
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">Номер</p>
								<p class="inpit-me-order form-control"><?=$order->getPhone()?></p>
							</div>
						</div>
						<div class="admin-orders-bloc1-clom1">
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">Почта</p>
								<p class="inpit-me-order form-control"><?=$order->getEmail()?></p>
							</div>
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">Статус</p>
								<p class="inpit-me-order form-control"><?=$order->getStatus()?></p>
							</div>
						</div>
						<div class="admin-orders-bloc1-clom1">
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">Название.экс</p>
								<p class="inpit-me-order form-control"><?=$order->getExcursionName()?></p>
							</div>
							<div style="display: flex;flex-direction: column;align-items: center;">
								<p class="admin-orders-text">Дата</p>
								<p class="inpit-me-order form-control"><?=$order->getDateTravel()?></p>
							</div>
						</div>
						<div class="admin-orders-bloc1-clom2">
							<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="save">
							<input class="admin-excursions-detaild-bloc4-input admin-input-color-3" type="submit" value="delete">
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php endforeach;?>
	</div>
</div>
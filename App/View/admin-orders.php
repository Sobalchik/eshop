<?php
/**@var array $orders */
/**@var array $statuses */
$helper = App\Lib\Helper::getInstance();
?>
<div id='order'>
	<div class="bloc2" id="content">
		<div class="bloc2-cont">
			<?php foreach ($orders as $order): ?>
			<div class="block">
				<form method="post">
					<div class="admin-orders">
						<label style="margin-right: 20px" class="admin-orders-text">№<?= $order->getId() ?></label>
						<div class="admin-orders-bloc1">
							<div class="admin-orders-bloc1-form">
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">ФИО</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="fio" value="<?= $order->getFio() ?> ">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Номер</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="phone" value="<?= $order->getPhone() ?> ">
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Почта</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="email" value="<?= $order->getEmail() ?> ">
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
										<input class="inpit-me-order form-control" id="inlineFormInputName" name="nameExcursion" value="<?= $order->getExcursionName() ?> ">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Дата</p>
										<input id="inlineFormInputName" class="inpit-me-order form-control" name="date" value="<?= $order->getDateTravel() ?> ">
									</div>
								</div>
								<div class="admin-orders-bloc1-clom2">
									<a href="javascript:void(0)" onclick="saveOrder('<?= $order->getId() ?>', '<?= $order->getFio() ?>', '<?= $order->getEmail() ?>', '<?= $order->getPhone() ?>', '<?= $order->getStatusId() ?>')" class="admin-navbar-list-a">save</a>
									<!-- TODO: Почему-то через пост запрос прилетают страрые значения? -->
									<a href="javascript:void(0)" onclick="deleteOrder('<?= $order->getId() ?>')" class="admin-navbar-list-a">delete</a>
								</div>
							</div>
				</form>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<div class="pagination"></div>
<script type="text/javascript" async src="/Resources/JS/pagination.js"></script>
</div>
</div>





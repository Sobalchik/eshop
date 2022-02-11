<?php

namespace App\Service;

use App\Entity\Order;
use mysqli;

class OrderService
{

	public static function createOrder(mysqli $db, array $paramsOrder)
	{
		$createDateOrder = new \DateTime('now');
		$validateParamsOrder = array(
			'fio'=>mysqli_real_escape_string($db, $paramsOrder['fio']),
			'email'=>mysqli_real_escape_string($db, $paramsOrder['email']),
			'phone'=>mysqli_real_escape_string($db, $paramsOrder['phone']),
			'date_order'=> $createDateOrder->format("Y-m-d H:i:s"),
			'comment'=>mysqli_real_escape_string($db, $paramsOrder['comment']),
			'status_id'=>mysqli_real_escape_string($db, $paramsOrder['status_id']),
			'product_id'=>mysqli_real_escape_string($db, $paramsOrder['product_id']),
			'date_create'=>$createDateOrder->format("Y-m-d H:i:s"),
			'date_update'=>$createDateOrder->format("Y-m-d H:i:s")
		);

		$query = "INSERT INTO `up_order`(`FIO`, `EMAIL`, `PHONE`, `DATE_ORDER`, `COMMENT`, `STATUS_ID`, `PRODUCT_ID`, `DATE_CREATE`, `DATE_UPDATE`)
 		VALUES ('{$validateParamsOrder['fio']}','{$validateParamsOrder['email']}','{$validateParamsOrder['phone']}',
 		        '{$validateParamsOrder['date_order']}','{$validateParamsOrder['comment']}','{$validateParamsOrder['status_id']}',
 		        '{$validateParamsOrder['product_id']}','{$validateParamsOrder['date_create']}','{$validateParamsOrder['date_update']}') ";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}


}
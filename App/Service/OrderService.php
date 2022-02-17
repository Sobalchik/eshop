<?php

namespace App\Service;

use App\Entity\Order;
use App\Lib\DBQuery;
use mysqli;

class OrderService
{

	public static function createOrder(mysqli $db, array $paramsOrder)
	{
		$createDateOrder = new \DateTime('now');
		$validateParamsOrder = array(
			'fio'=>mysqli_real_escape_string($db, $paramsOrder['name']),
			'email'=>mysqli_real_escape_string($db, $paramsOrder['email']),
			'phone'=>mysqli_real_escape_string($db, $paramsOrder['telephone']),
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

	public static function parseOrdersForAdminPage(\mysqli_result $result) : array
	{
		$orders = [];

		while($order = mysqli_fetch_assoc($result))
		{
			$orders[] = new Order(
				$order['id'],
				$order['fio'],
				$order['email'],
				$order['phone'],
				$order['dateOrder'],
				$order['comment'],
				$order['statusId'],
				$order['productId'],
				'',
				''
			);
			$order[count($order)-1]->setStatus($order['status']);
			$order[count($order)-1]->setExcursionName($order['status']);
			$order[count($order)-1]->setDateTravel($order['dateTravel']);
		}

		return $orders;
	}

	public static function sortOrders(mysqli $db, int $sortType) : array
	{
		$ini = parse_ini_file('config.ini');

		$query = DBQuery::getOrdersForAdminPage();
		switch ($sortType)
		{
			case $ini['order_orders_by_date_create_desc']:
				$query = DBQuery::sortOrdersByDateCreateDesc();
				break;
			case $ini['order_orders_by_status']:
				$query = DBQuery::sortOrdersByStatusCreatedProgressedCompleted();
				break;
		}

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}

	public static function findOrdersByClientName(mysqli $db, string $clientName) : array
	{
		$query = DBQuery::findOrderByClientName();

		$searchString = mysqli_real_escape_string($db, $clientName);

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"s",$searchString);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}

	public static function getOrdersForAdminPage(mysqli $db) : array
	{
		$query = DBQuery::getOrdersForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}


}
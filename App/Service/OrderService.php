<?php

namespace App\Service;

use App\Entity\Order;
use App\Lib\DBQuery;
use mysqli;

class OrderService
{

	public static function createOrder(mysqli $db, array $orderData)
	{
		$createDateOrder = new \DateTime('now');
		$orderData['date'] = $createDateOrder->format("Y-m-d H:i:s");

		$query = DBQuery::insertOrderInDBQuery($orderData);

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
				$order['orderDate'],
				$order['comment'],
				$order['statusId'],
				$order['productId'],
				'',
				''
			);
			$orders[count($orders)-1]->setStatus($order['status']);
			$orders[count($orders)-1]->setExcursionName($order['status']);
			$orders[count($orders)-1]->setDateTravel($order['dateTravel']);
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

	public static function editOrderStatusById(mysqli $db, int $id, int $newStatusId) : void
	{
		$query = DBQuery::editOrderStatus();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii", $newStatusId, $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}


}
<?php

namespace App\Service;

use App\Entity\Order;
use App\Lib\OrderDBQuery;
use mysqli;

/**
 * Класс содержит методы получения/изменения информации в БД об экскурсиях
 *
 * Методы сервиса названы в соответствие с запросами к БД:
 *
 * SELECT - get,
 * INSERT - add,
 * UPDATE - edit,
 * DELETE - delete
 */

class OrderService
{

	public static function createOrder(mysqli $db, array $orderData): void
	{
		$createDateOrder = new \DateTime('now');
		$orderData['date'] = $createDateOrder->format("Y-m-d H:i:s");

		$query = OrderDBQuery::insertOrderInDBQuery();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssssis",
								$orderData['name'],
								$orderData['email'],
								$orderData['telephone'],
								$orderData['date'],
								$orderData['comment'],
								$orderData['status_id'],
								$orderData['dateTravel']
		);
		$result = mysqli_stmt_execute($stmt);

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
				0,
				'',
				''
			);
			$orders[count($orders)-1]->setStatus($order['status']);
			$orders[count($orders)-1]->setExcursionName($order['excursionName']);
			$orders[count($orders)-1]->setDateTravel($order['dateTravel']);
		}

		return $orders;
	}

	public static function findOrdersByClientName(mysqli $db, string $clientName) : array
	{
		$query = OrderDBQuery::findOrderByClientName();

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
		$query = OrderDBQuery::getOrdersForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}

	public static function editOrderById(mysqli $db,
			int $id, string $fio, string $email, string $phone, int $status, string $comment) : void
	{
		$query = OrderDBQuery::editOrder();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssssi", $fio, $email, $phone, $comment, $status, $id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function deleteOrderById(mysqli $db, int $id) : void
	{
		$query = OrderDBQuery::deleteOrderById();
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function getAllStatuses(mysqli $db) : array
	{
		$query = OrderDBQuery::getAllStatuses();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$statuses = [];

		while ($status = mysqli_fetch_assoc($result))
		{
			$statuses[] = [
				'id' => $status['id'],
				'name' => $status['name']
			];
		}

		return $statuses;
	}


}
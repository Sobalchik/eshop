<?php

namespace App\Controller;

use App\Config\Database;
use App\Entity\Order;
use App\Lib\Render;
use App\Lib\Helper;
use App\Logger\Logger;
use App\Service\ExcursionService;
use App\Service\OrderService;

class OrderController
{
	public static function createOrder(): string
	{
		session_start();
		$validateData = Helper::validateFields($_POST);
		if ( isset( $_SESSION['csrf_token'] ) && $_SESSION['csrf_token'] === $validateData['csrf_token'] )
		{
			OrderService::createOrder(Database::getDatabase(),$validateData);
			$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
			return Render::render("content-top-excursions", ['excursions' => $excursions]);
		}
		else
		{
			$excursion = ExcursionService::getExcursionById(Database::getDatabase(),$validateData['product_id']);
			return Render::render("content-more-excursion", ['excursion' => $excursion]);
		}
	}

	public static function showAdminOrders(): string
	{
		if(UserController::isAuthorized()){
			$orders = OrderService::getOrdersForAdminPage(Database::getDatabase());
			$statuses = OrderService::getAllStatuses(Database::getDatabase());
			$content = Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function editOrder(): string
	{
		$logger = new Logger();
		$logger->info($_POST['id']);
		OrderService::editOrderById(Database::getDatabase(),
									$_POST['id'],
									$_POST['fio'],
									$_POST['email'],
									$_POST['phone'],
									$_POST['status']
		);
		$orders = OrderService::getOrdersForAdminPage(Database::getDatabase());
		$statuses = OrderService::getAllStatuses(Database::getDatabase());
		$content = Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
		return $content;
	}

	public static function deleteOrder(): string
	{
		$logger = new Logger();
		$logger->info($_POST['id']);
		OrderService::deleteOrderById(Database::getDatabase(),$_POST['id']);
		return  self::showAdminOrders();
	}
}
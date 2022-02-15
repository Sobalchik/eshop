<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Render;
use App\Service\ExcursionService;
use App\Service\OrderService;

class OrderController
{
	public static function createOrder(): string
	{
		OrderService::createOrder(Database::getDatabase(),$_POST);
		return ExcursionController::showTopExcursions();

		/*if ( isset( $_SESSION['csrf_token'] ) && $_SESSION['csrf_token'] == @$_POST['csrf_token'] )
		{
			$order = OrderService::createOrder(Database::getInstance()->connect(),$_POST);
			$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
			return Render::render("content-main", ['excursions' => $excursions]);
		}
		else
		{
			$excursion = ExcursionService::getExcursionById(Database::getInstance()->connect(),$_POST['product_id']);
			return Render::render("content-more-excursion", ['excursion' => $excursion]);
		}*/
	}

}
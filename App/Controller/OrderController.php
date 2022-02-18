<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Render;
use App\Lib\Helper;
use App\Service\ExcursionService;
use App\Service\OrderService;

class OrderController
{
	public static function createOrder(): string
	{
		session_start();
		$validateData = Helper::validateFields($_POST);
		if ( isset( $_SESSION['csrf_token'] ) && $_SESSION['csrf_token'] == $validateData['csrf_token'] )
		{
			$order = OrderService::createOrder(Database::getDatabase(),$validateData);
			$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
			return Render::render("content-main", ['excursions' => $excursions]);
		}
		else
		{
			$excursion = ExcursionService::getExcursionById(Database::getDatabase(),$validateData['product_id']);
			return Render::render("content-more-excursion", ['excursion' => $excursion]);
		}
	}

}
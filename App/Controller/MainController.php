<?php

namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;
use App\Config\Database;

class MainController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("content-main", ['excursions' => $excursions]);
	}

	public static function showPlaceHolder(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("placeholder", ['excursions' => $excursions]);
	}

	public static function createOrder(): string
	{
		$order = OrderService::createOrder(Database::getInstance()->connect(),$_POST);
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("content-main", ['excursions' => $excursions]);

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
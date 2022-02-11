<?php

namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;
use App\Service\OrderService;
use App\Config\Database;

class MainController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);
	}

	public static function showExcursionById($id): string
	{
		$excursions = ExcursionService::getExcursionById(Database::getInstance()->connect(), $id);
		return Render::render("content-detailed-excursion", ['excursions' => $excursions]);
	}

	public static function showAllExcursions(int $page): string
	{
		$excursions = ExcursionService::getAllExcursionsByPage(Database::getInstance()->connect(),$page);
		return Render::render("content-all-excursions", ['excursions' => $excursions,'page' => $page]);
	}


	public static function createOrder(): string
	{
		$order = OrderService::createOrder(Database::getInstance()->connect(),$_POST);
		$excursions = ExcursionService::getTopExcursions(Database::getInstance()->connect());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);

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
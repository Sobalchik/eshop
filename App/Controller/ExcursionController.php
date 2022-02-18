<?php

namespace App\Controller;

use App\Lib\Helper;
use App\Lib\Render;
use App\Service\ExcursionService;
use App\Config\Database;
use App\Service\OrderService;

class ExcursionController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);
	}

	public static function showExcursionById($id): string
	{
		$excursion = ExcursionService::getExcursionById(Database::getDatabase(), $id);
		return Render::render("content-detailed-excursion", ['excursion' => $excursion]);
	}

	public static function showAllExcursions(int $page): string
	{
		$pageCount = Helper::getInstance()->getPagesCount();

		$excursions = ExcursionService::getAllExcursionsByPage(Database::getDatabase(),$page);
		return Render::render("content-all-excursions", ['excursions' => $excursions,'page' => $page,'pageCount' => $pageCount]);
	}

	public static function showAdminExcursionById(): string
	{
		if(UserController::isAuthorized()){

			$excursion = ExcursionService::getExcursionById(Database::getDatabase(), 1);
			$content = Render::renderContent("admin-excursions-detailed", ["excursion" => $excursion]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function showAdminOrders(): string
	{
		if(UserController::isAuthorized()){
			$orders = OrderService::getAllOrders(Database::getDatabase());
			$content = Render::renderContent("admin-orders", ["orders" => $orders]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}


	}

}
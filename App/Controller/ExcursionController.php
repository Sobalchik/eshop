<?php

namespace App\Controller;

use App\Lib\Helper;
use App\Lib\Render;
use App\Logger\Logger;
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
			$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(), $_GET['id']);
			$content = Render::renderContent("admin-excursions-detailed", ["excursion" => $excursion]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function showAdminExcursionList(): string
	{
		# Переделать метод получения экскурсий
		if(UserController::isAuthorized()){
			$excursions = ExcursionService::getExcursionsForAdminHomePage(Database::getDatabase());
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function editExcursion(): string
	{
		$logger = new Logger();

		$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(),$_POST['id']);
		$excursion->setNameCity($_POST['city']);
		$excursion->setNameCountry($_POST['country']);
		$excursion->setPrice($_POST['price']);
		$excursion->setInternetRating($_POST['iRating']);
		$excursion->setEntertainmentRating($_POST['eRating']);
		$excursion->setServiceRating($_POST['sRating']);
		$excursion->setRating($_POST['Rating']);
		$excursion->setTagList(explode(',',$_POST['TagList']));
		$excursion->setCountPersons($_POST['person']);
		$excursion->setFullDescription($_POST['description']);
		ExcursionService::editExcursionById(Database::getDatabase(),$excursion);

		return self::showAdminExcursionList();


	}

}
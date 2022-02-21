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
			$content = Render::renderContent("admin-excursions-detailed-edit", ["excursion" => $excursion]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function showAdminExcursionList(): string
	{
		if(UserController::isAuthorized()){
			$excursions = ExcursionService::getExcursionsForAdminHomePage(Database::getDatabase());
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}
	}

	public static function addExcursionDate()
	{
		$date = str_replace("T"," ",$_POST['date']);
		ExcursionService::addDateToExcursionById(Database::getDatabase(),$_POST['id'],$date);
		header('Location: http://eshop/admin/excursions');
		return self::showAdminExcursionList();

	}

	public static function editExcursion(): string
	{
		$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(),$_POST['id']);
		$excursion->setNameCity($_POST['city']);
		$excursion->setNameCountry($_POST['country']);
		$excursion->setPrice($_POST['price']);
		$excursion->setInternetRating((float)$_POST['iRating']);
		$excursion->setEntertainmentRating((float)$_POST['eRating']);
		$excursion->setServiceRating((float)$_POST['sRating']);
		$excursion->setDuration((int)$_POST['duration']);
		$excursion->setDegrees((float)$_POST['degrees']);
		$excursion->setTagList(explode(',',$_POST['tagList']));
		$excursion->setCountPersons($_POST['person']);
		$excursion->setFullDescription($_POST['description']);
		$rating = round(((float)$_POST['iRating'] +(float)$_POST['eRating'] +(float)$_POST['sRating']) / 3,1); //нужна функция-хелпер!
		$excursion->setRating($rating);
		ExcursionService::editExcursionById(Database::getDatabase(),$excursion);

		return self::showAdminExcursionList();


	}

}
<?php

namespace App\Controller;

use App\Entity\Excursion;
use App\Lib\Helper;
use App\Lib\Render;
use App\Logger\Logger;
use App\Service\ExcursionService;
use App\Config\Database;
use App\Service\OrderService;
use App\Service\TagService;

class ExcursionController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);
	}

	public static function showAbout(): string
	{
		return Render::render("about");
	}
	public static function showClient(): string
	{
		return Render::render("client");
	}
	public static function getBlog(): string
	{
		return Render::render("blog");
	}

	public static function showExcursionById($id): string
	{
		$excursion = ExcursionService::getExcursionById(Database::getDatabase(), $id);
		return Render::render("content-detailed-excursion", ['excursion' => $excursion]);
	}

	public static function showAllExcursions(): string
	{
		$countryTags = TagService::getTagsByTypeCountry(Database::getDatabase());
		$continentTags = TagService::getTagsByTypeContinent(Database::getDatabase());
		$familyTags = TagService::getTagsByTypeFamilyFriendly(Database::getDatabase());

		$excursions = ExcursionService::getAllExcursionsByPage(Database::getDatabase());
		return Render::render("content-all-excursions", [
			'excursions' => $excursions,
			'continentTags' => $continentTags,
			'countryTags' => $countryTags,
			'familyTags' =>$familyTags
		]);
	}

	public static function showAdminExcursionById(): string
	{
		if(UserController::isAuthorized()){
			$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(), $_GET['id']);
			$content = Render::renderContent("admin-excursions-detailed-edit", ["excursion" => $excursion]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: ".Helper::getUrl()."/login");
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
			header("Location: ".Helper::getUrl()."/login");
			return '';
		}
	}

	public static function showAdminExcursionListBySearch() : string
	{
		if(UserController::isAuthorized()){
			$excursions = ExcursionService::findExcursionsForAdminPageByName(Database::getDatabase(), $_POST['search-excursions']);
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: ".Helper::getUrl()."/login");
			return '';
		}
	}

	public static function addExcursionDate() : string
	{
		$date = str_replace("T"," ",$_POST['date']);
		ExcursionService::addDateToExcursionById(Database::getDatabase(),$_POST['id'],$date);
		header("Location: ".Helper::getUrl()."/admin/excursions");
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
	public static function  sortExcursions() : string
	{
		(int)$sortType = $_POST['sortType'];
		$ex = ExcursionService::getAllExcursionsByPage(Database::getDatabase());
		$excursions = ExcursionService::sortExcursions(Database::getDatabase(), $ex ,$sortType);
		return Render:: renderContent("content-card",['excursions'=>$excursions]);
	}

	public static function  sortExcursionsByTags() : string
	{
		//$tagsList = $_POST['tagList'];
		$excursions = ExcursionService::getExcursionsByTag(Database::getDatabase(),$_POST['tagList']);
		return Render:: renderContent("content-card",['excursions'=>$excursions]);
	}


	public static function addExcursion()
	{
		if(UserController::isAuthorized()){
			$content = Render::renderContent("admin-excursions-detailed-add");
			return Render::renderAdminMenu($content);
		}else{
			header("Location: ".Helper::getUrl()."/login");
			return '';
		}
	}

	public static function createExcursion()
	{
		$excursionDate = new \DateTime('now');
		if(UserController::isAuthorized()){
			$excursion = new Excursion(
				0,
				mysqli_real_escape_string(Database::getDatabase(), $_POST['city']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['country']),
				'null',
				mysqli_real_escape_string(Database::getDatabase(), $_POST['price']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['description']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['iRating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['eRating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['sRating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['Rating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['degrees']),
				1,
				'null',
				$excursionDate->format("Y-m-d H:i:s"),
				$excursionDate->format("Y-m-d H:i:s")
			);
			$excursion->setCountPersons(mysqli_real_escape_string(Database::getDatabase(), $_POST['person']));
			$excursion->setDuration(mysqli_real_escape_string(Database::getDatabase(), $_POST['duration']));
			ExcursionService::addExcursion(Database::getDatabase(), $excursion);
			return self::showAdminExcursionList();
		}else{
			header("Location: ".Helper::getUrl()."/login");
			return '';
		}
	}

	public static function deactivateDate(): string
	{
		$log = new Logger;
		$log->info('',['id'=>$_POST['id']]);
		ExcursionService::deactivateDate(Database::getDatabase(),$_POST['id']);
		header("Location: ".Helper::getUrl()."/admin/excursions" );
		return self::showAdminExcursionList();
	}

	public static function findExcursionByName(): string
	{
		$excursions = ExcursionService::findExcursionsForHomePageByName(Database::getDatabase(), $_POST['name']);
		return Render:: renderContent("content-card",['excursions'=>$excursions]);
	}

}
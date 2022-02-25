<?php

namespace App\Service;

use App\Config\Settings;
use App\Entity\Excursion;
use App\Lib\Helper;
use App\Logger\Logger;
use mysqli;
use App\Lib\DBQuery;

class ExcursionService
{
	public static function parseExcursionsForHomePage(\mysqli_result $excursionsFromDB) : array
	{
		$excursions = [];

		while ($excursion = mysqli_fetch_assoc($excursionsFromDB))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				Helper::replacementNullValueMysql($excursion['nameCity']),
				Helper::replacementNullValueMysql($excursion['nameCountry']),
				Helper::replacementNullValueMysql($excursion['dateTravel']),
				Helper::replacementNullValueMysql($excursion['price']),
				'',
				Helper::replacementNullValueMysql($excursion['internetRating']),
				Helper::replacementNullValueMysql($excursion['entertainmentRating']),
				Helper::replacementNullValueMysql($excursion['serviceRating']),
				Helper::replacementNullValueMysql($excursion['rating']),
				Helper::replacementNullValueMysql($excursion['degrees']),
				Helper::replacementNullValueMysql($excursion['active']),
				Helper::replacementNullValueMysql($excursion['imageList']),
				'',
				''
			);
		}

		return $excursions;
	}

	public static function parseExcursionsForAdminHomePage(mysqli $db,\mysqli_result $excursionsFromDB) : array
	{
		$excursions = [];

		while ($excursion = mysqli_fetch_assoc($excursionsFromDB))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				$excursion['nameCity'],
				'',
				'',
				$excursion['price'],
				'',
				0,
				0,
				0,
				0,
				0,
				1,
				0,
				'',
				''
			);
			$excursions[count($excursions)-1]->
			setExcursionOccupancyByDateTravel(self::getExcursionOccupancyListById($db, $excursion['id']));
			$excursions[count($excursions)-1]->setCountPersons($excursion['countPersons']);
		}

		return $excursions;
	}

	public static function parseExcursionsForDetailedPage(\mysqli_result $excursionFromDB) : Excursion
	{
		$excursion = mysqli_fetch_assoc($excursionFromDB);

		$result_excursion = new Excursion(
			$excursion['id'],
			Helper::replacementNullValueMysql($excursion['nameCity']),
			Helper::replacementNullValueMysql($excursion['nameCountry']),
			Helper::replacementNullValueMysql($excursion['dateTravel']),
			Helper::replacementNullValueMysql($excursion['price']),
			Helper::replacementNullValueMysql($excursion['full_description']),
			0,
			0,
			0,
			Helper::replacementNullValueMysql($excursion['rating']),
			0,
			Helper::replacementNullValueMysql($excursion['active']),
			Helper::replacementNullValueMysql($excursion['imageList']),
			'',
			''
		);

		$result_excursion->setTagList(explode(',', $excursion['tagList']));
		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setAllPossibleDatesTravel(explode(',', $excursion['allPossibleDatesTravel']));
		$result_excursion->setAttractionList(explode(',', $excursion['attractionList']));

		return $result_excursion;
	}

	public static function getExcursionsCount(mysqli $db) :array
	{
		$query = DBQuery::getAllExcursionsCountQuery();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_fetch_row($result);
	}

	public static function getAllTags(mysqli $db) : array
	{
		$query = DBQuery::getAllTagsQuery();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];

		while ($tag = mysqli_fetch_assoc($result))
		{
			$tags[] = [
				'id' => $tag['id'],
				'name' => $tag['name']
			];
		}

		return $tags;
	}

	public static function getTopExcursions(mysqli $db): array
	{
		$query = DBQuery::getTopExcursionsQuery();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForHomePage($result);
	}

	public static function getAllExcursionsByPage(mysqli $db, int $page = 1): array
	{
		$query = DBQuery::getAllExcursionsByPageQuery();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForHomePage($result);
	}

	public static function getExcursionById(mysqli $db, int $id) : Excursion
	{
		$query = DBQuery::getExcursionByIdQuery();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii", $id, $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForDetailedPage($result);
	}

	public static function getExcursionsForAdminHomePage(mysqli $db) : array
	{
		$query = DBQuery::getExcursionsForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForAdminHomePage($db, $result);
	}

	public static function getExcursionForAdminDetailedPage(mysqli $db, int $id) : Excursion
	{
		$query = DBQuery::getExcursionForAdminDetailedPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$excursion = mysqli_fetch_assoc($result);

		$result_excursion = new Excursion(
			$excursion['id'],
			$excursion['nameCity'],
			$excursion['nameCountry'],
			'',
			$excursion['price'],
			$excursion['fullDescription'],
			$excursion['internetRating'],
			$excursion['entertainmentRating'],
			$excursion['serviceRating'],
			$excursion['rating'],
			$excursion['degrees'],
			$excursion['active'],
			'',
			'',
			''
		);

		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setTagList(explode(',', $excursion['tagList']));

		return $result_excursion;
	}

	public static function findExcursionsForAdminPageByName(mysqli $db, string $name) : array
	{
		$query = DBQuery::findExcursionByNameForAdminPage();

		$name = mysqli_real_escape_string($db, $name);
		$name = "%" . $name . "%";
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ss", $name, $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseExcursionsForAdminHomePage($db, $result);
	}

	public static function findExcursionsForHomePageByName(mysqli $db, string $name) : array
	{
		$query = DBQuery::findExcursionByNameForHomePage();

		$name = mysqli_real_escape_string($db, $name);
		$name = "%" . $name . "%";
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ss", $name, $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseExcursionsForHomePage($result);
	}

	public static function sortExcursions(mysqli $db, array $excursions, int $sortType) : array
	{
		$ini = parse_ini_file(__DIR__ . '\../Config/config.ini');

		$idList = [];
		foreach($excursions as $excursion)
		{
			$idList[] = $excursion->getId();
		}

		$query = [];
		switch ($sortType)
		{
		case $ini['order_excursions_by_price_asc']:
			$query = DBQuery::sortExcursionsByPriceAscQuery($idList);
			break;
		case $ini['order_excursions_by_price_desc']:
			$query = DBQuery::sortExcursionsByPriceDescQuery($idList);
			break;
		case $ini['order_excursions_by_rating_desc']:
			$query = DBQuery::sortExcursionsByRatingDescQuery($idList);
			break;
		}

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForHomePage($result);
	}

	public static function getExcursionsByTag(mysqli $db, array $tagList): array
	{
		$query = DBQuery::orginizeTagIdLists($tagList);

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];
		while ($tag = mysqli_fetch_assoc($result))
		{
			$tags[] =
			[
				'tagType' => $tag['tagType'],
				'tagList' => explode(',', $tag['tagList'])
			];
		}

		$query = DBQuery::getExcursionsForHomePage();

		$tag = array_shift($tags);
		$query .= "where " . DBQuery::getExcursionsByTagQuery($tag['tagType'], $tag['tagList']);

		foreach ($tags as $tag)
		{
			$query .= " and " . DBQuery::getExcursionsByTagQuery($tag['tagType'], $tag['tagList']);
		}

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForHomePage($result);
	}

	public static function getExcursionOccupancyListById(mysqli $db, int $id) : array
	{
		$query = DBQuery::getExcursionCompletionByDateById();
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$occupancyList = [];
		while ($occupancy = mysqli_fetch_assoc($result))
		{
			$occupancyList[] =[
				'id' => $occupancy['id'],
				'dateTravel' => $occupancy['dateTravel'],
				'orderedExcursionsCount' => $occupancy['orderedExcursionsCount']
			];
		}

		return $occupancyList;
	}

	public static function getAllExcursionsForAdmin(mysqli $db) : array
	{
		$query = DBQuery::getExcursionsForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$excursions = [];

		while ($excursion = mysqli_fetch_assoc($result))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				$excursion['nameCity'],
				$excursion['nameCountry'],
				$excursion['dateTravel'],
				$excursion['price'],
				$excursion['fullDescription'],
				$excursion['internetRating'],
				$excursion['entertainmentRating'],
				$excursion['serviceRating'],
				$excursion['rating'],
				$excursion['degrees'],
				$excursion['active'],
				'',
				'',
				''
			);

			$occupancyList = self::getExcursionOccupancyListById($db, (int)$excursion['id']);
			$excursions[count($excursions) - 1]->setExcursionOccupancyByDateTravel($occupancyList);
		}

		return $excursions;
	}

	public static function addExcursion(mysqli $db, Excursion $excursion) : int
	{
		$query = "insert into up_product
			(NAME_CITY, NAME_COUNTRY, DURATION, COUNT_PERSONS, PRICE, FULL_DESCRIPTION, INTERNET_RATING, ENTERTAINMENT_RATING, SERVICE_RATING, RATING, DEGREES, ACTIVE, DATE_CREATE, DATE_UPDATE)
			values
			(
			'{$excursion->getNameCity()}',
			'{$excursion->getNameCountry()}',
			'{$excursion->getDuration()}',
			'{$excursion->getCountPersons()}',
			'{$excursion->getPrice()}',
			'{$excursion->getFullDescription()}',
			'{$excursion->getInternetRating()}',
			'{$excursion->getEntertainmentRating()}',
			'{$excursion->getServiceRating()}',
			'{$excursion->getRating()}',
			'{$excursion->getDegrees()}',
			'{$excursion->getActive()}', 
			 CURRENT_TIMESTAMP,
			 CURRENT_TIMESTAMP)";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	public static function addProductBelongTags(mysqli $db, Excursion $excursion): void
	{
		$query = "insert into up_product_tag (PRODUCT_ID, TAG_ID) values";

		foreach ($excursion->getTagList() as $tag)
		{
			$query .= "({$excursion->getId()},{$tag}), ";
		}

		$query = substr($query, 0, -2);

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function editExcursionById(mysqli $db, Excursion $excursion) : void
	{
		$query = DBQuery::updateExcursionById();

		$nameCity = mysqli_real_escape_string($db, $excursion->getNameCity());
		$nameCountry = mysqli_real_escape_string($db, $excursion->getNameCountry());
		$price = $excursion->getPrice();
		$duration = $excursion->getDuration();
		$id = $excursion->getId();
		$countPerson = $excursion->getCountPersons();
		$fullDescription = mysqli_real_escape_string($db, $excursion->getFullDescription());
		$internetRating = $excursion->getInternetRating();
		$entertainmentRating = $excursion->getEntertainmentRating();
		$serviceRating = $excursion->getServiceRating();
		$rating = $excursion->getRating();
		$degree = $excursion->getDegrees();
		$active = $excursion->getActive();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ssiddddiisiii",
								$nameCity,
								$nameCountry,
								$price,
								$internetRating,
								$entertainmentRating,
								$serviceRating,
								$rating,
								$degree,
								$active,
								$fullDescription,
								$duration,
								$countPerson,
								$id
		);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function deleteExcursionById(mysqli $db, int $id) : void
	{
		$query = DBQuery::deleteExcursionById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function getAllActiveDates(mysqli $db) : array
	{
		$query = DBQuery::getAllActiveDates();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$dates = [];

		while ($date = mysqli_fetch_assoc($result))
		{
			$dates =[
				'id' => $date['id'],
				'name' => $date['date']
			];
		}

		return $dates;
	}

	public static function addDateToExcursionById(mysqli $db, int $id, string $date) : void
	{
		self::addNewDate($db,$date);
		self::addNewDateRelation($db,$id);

	}

	private static function addNewDate($db,string $date)
	{
		$query = DBQuery::addNewDate();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"s",$date);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	private static function addNewDateRelation($db,int $id)
	{
		$query = DBQuery::addNewDateRelations();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function deactivateDate(mysqli $db, int $id){
		$query = DBQuery::deleteDateById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

	}

	public static function deleteProductBelongTags(mysqli $db, Excursion $excursion): void
	{
		$query = "delete from up_product_tag WHERE PRODUCT_ID=({$excursion->getId()})";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function deleteDateById(mysqli $db, int $id) : void
	{
		$query = "delete from up_product_date WHERE DATE_ID=({$id})";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$query = "delete from up_date WHERE ID=({$id})";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

}
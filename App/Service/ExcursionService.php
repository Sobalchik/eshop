<?php

namespace App\Service;

use App\Config\Settings;
use App\Entity\Excursion;
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
				$excursion['nameCity'],
				$excursion['nameCountry'],
				$excursion['dateTravel'],
				$excursion['price'],
				'',
				$excursion['internetRating'],
				$excursion['entertainmentRating'],
				$excursion['serviceRating'],
				$excursion['rating'],
				$excursion['degrees'],
				$excursion['active'],
				$excursion['imageList'],
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
			$excursion['nameCity'],
			$excursion['nameCountry'],
			$excursion['dateTravel'],
			$excursion['price'],
			$excursion['full_description'],
			0,
			0,
			0,
			$excursion['rating'],
			0,
			$excursion['active'],
			$excursion['imageList'],
			'',
			''
		);

		$result_excursion->setTagList(explode(' ', $excursion['tagList']));
		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setAllPossibleDatesTravel(explode(',', $excursion['allPossibleDatesTravel']));

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
		$settings = Settings::getInstance();
		$EXCURSIONS_ON_PAGE = $settings->getExcursionOnPage();
		$startLine = ($page * $EXCURSIONS_ON_PAGE) - $EXCURSIONS_ON_PAGE;

		$query = DBQuery::getAllExcursionsByPageQuery();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii", $startLine, $EXCURSIONS_ON_PAGE);
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
		mysqli_stmt_bind_param($stmt,"i", $id);
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

		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setTagList(explode(' ', $excursion['tagList']));

		return $result_excursion;
	}

	public static function sortExcursions(mysqli $db, array $idList, int $sortType) : array
	{
		$ini = parse_ini_file('config.ini');

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

	public static function getExcursionsByTag(mysqli $db, array $tagId): array
	{
		$query = DBQuery::getExcursionsByTagQuery($tagId);

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
		mysqli_stmt_bind_param($stmt,"sssiddddiisiii",
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

	public static function addDateToExcursionById(mysqli $db, int $id, string $date) : void
	{
		$query = DBQuery::addNewDate();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"si",$date, $id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function findExcursionByNameForAdminPage(mysqli $db, string $excursionName) : array
	{
		$query = DBQuery::findExcursionByNameForAdminPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"s",$excursionName);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForAdminHomePage($db, $result);
	}

	public static function deleteDateById(mysqli $db, int $dateId) : void
	{
		$query = DBQuery::deleteDateById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$dateId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	// РАБОТА С ИЗОБРАЖЕНИЯМИ!!!
	public static function addNewExcursion(mysqli $db, Excursion $excursion) : void
	{
		$query = DBQuery::addNewExcursion();

		$nameCity = mysqli_real_escape_string($db, $excursion->getNameCity());
		$nameCountry = mysqli_real_escape_string($db, $excursion->getNameCountry());
		$price = $excursion->getPrice();
		$duration = $excursion->getDuration();
		$countPerson = $excursion->getCountPersons();
		$fullDescription = mysqli_real_escape_string($db, $excursion->getFullDescription());
		$internetRating = $excursion->getInternetRating();
		$entertainmentRating = $excursion->getEntertainmentRating();
		$serviceRating = $excursion->getServiceRating();
		$rating = $excursion->getRating();
		$degree = $excursion->getDegrees();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ssiiisddddi",
										$nameCity,
										$nameCountry,
										$duration,
										$countPerson,
										$price,
										$fullDescription,
										$internetRating,
										$entertainmentRating,
										$serviceRating,
										$rating,
										$degree
		);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

}
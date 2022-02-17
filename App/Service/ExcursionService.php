<?php

namespace App\Service;

use App\Entity\Excursion;
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
				'',
				'',
				$excursion['imageList']
			);
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
			'',
			'',
			$excursion['imageList']
		);

		$result_excursion->setTagList(explode(' ', $excursion['tagList']));
		$result_excursion->setDuration($excursion['duration']);
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
		$EXCURSIONS_ON_PAGE = 9;
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

	public static function getExcursionById(mysqli $db, int $id) : object
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

	public static function addExcursion(mysqli $db, array $excursionData): void
	{
		$query = DBQuery::insertExcursionInDBQuery();

		$nameCity = mysqli_real_escape_string($db, $excursionData['nameCity']);
		$nameCountry = mysqli_real_escape_string($db, $excursionData['nameCountry']);
		$dateTravel = date_format($excursionData['dateTravel'], 'Y-m-d H:i:s');
		$fullDescription = mysqli_real_escape_string($db, $excursionData['full_description']);

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssdiisddddii",
								$nameCity,
								$nameCountry,
								$dateTravel,
								$excursionData['price'],
								$excursionData['duration'],
								$excursionData['countPersons'],
								$fullDescription,
								$excursionData['internetRating'],
								$excursionData['entertainmentRating'],
								$excursionData['serviceRating'],
								$excursionData['rating'],
								$excursionData['degrees'],
								$excursionData['active']
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
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
				'',
				$excursion['dateTravel'],
				$excursion['price'],
				'',
				0,
				0,
				0,
				0,
				0,
				1,
				'',
				'',
				''
			);

			$occupancyList = self::getExcursionOccupancyListById($db, (int)$excursion['id']);
			$excursions[count($excursions) - 1]->setExcursionOccupancyByDateTravel($occupancyList);
		}

		return $excursions;
	}

	public static function addDateByExcursionId(mysqli $db) : array
	{
		return [];
	}

	public static function editExcursionById(mysqli $db, int $id, array $data) : void
	{
		$query = DBQuery::updateExcursionById();

		$nameCity = mysqli_real_escape_string($db, $data['nameCity']);
		$nameCountry = mysqli_real_escape_string($db, $data['nameCountry']);
		$dateTravel = date_format($data['dateTravel'], 'Y-m-d H:i:s');
		$fullDescription = mysqli_real_escape_string($db, $data['full_description']);

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssdiisddddiii",
								$nameCity,
								$nameCountry,
								$dateTravel,
								$data['price'],
								$data['duration'],
								$data['countPersons'],
								$fullDescription,
								$data['internetRating'],
								$data['entertainmentRating'],
								$data['serviceRating'],
								$data['rating'],
								$data['degrees'],
								$data['active'],
								$id
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

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
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

}
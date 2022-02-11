<?php

namespace App\Service;

use App\Entity\Excursion;
use mysqli;

class ExcursionService
{
	const MAIN_PHOTO = '1';

	public static function getExcursionsCount(mysqli $db) : int
	{
		$query = "
			select
				count(ID)
			from up_product
		";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_fetch_row($result);
	}

	public static function getAllTags(mysqli $db) : array
	{
		$query = "
			select
				ID as 'id',
				NAME as 'name'
			from up_tag
		";

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
		$query = "
			select
			ID as 'id',
			NAME_CITY as 'nameCity',
			NAME_COUNTRY as 'nameCountry',
			DATE_TRAVEL as 'dateTravel',
			PRICE as 'price',
			INTERNET_RATING as 'internetRating',
			ENTERTAINMENT_RATING as 'entertainmentRating',
			SERVICE_RATING as 'serviceRating',
			RATING as 'rating',
			DEGREES as 'degrees',
			ACTIVE as 'active',
			(
				select
					up_image.PATH
				from up_product_image
				left join up_image on up_product_image.IMAGE_ID = up_image.ID
				where up_product_image.PRODUCT_ID = up_product.ID
				and up_image.MAIN = '1'
			) as 'imageList'
			from up_product
			limit 8;
		";

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

	public static function getAllExcursionsByPage(mysqli $db, int $page = 1): array
	{
		$EXCURSIONS_ON_PAGE = 9;
		$startLine = ($page * $EXCURSIONS_ON_PAGE) - $EXCURSIONS_ON_PAGE;

		$query = "
			select
			ID as 'id',
			NAME_CITY as 'nameCity',
			NAME_COUNTRY as 'nameCountry',
			DATE_TRAVEL as 'dateTravel',
			PRICE as 'price',
			INTERNET_RATING as 'internetRating',
			ENTERTAINMENT_RATING as 'entertainmentRating',
			SERVICE_RATING as 'serviceRating',
			RATING as 'rating',
			DEGREES as 'degrees',
			ACTIVE as 'active',
			(
				select
					up_image.PATH
				from up_product_image
				left join up_image on up_product_image.IMAGE_ID = up_image.ID
				where up_product_image.PRODUCT_ID = up_product.ID
				and up_image.MAIN = '1'
			) as 'imageList'
			from up_product
			LIMIT ?, ?
		";

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii", $startLine, $EXCURSIONS_ON_PAGE);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

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

	public static function getExcursionById(mysqli $db, int $id) : object
	{
		$query = "
			select
				ID as 'id',
				NAME_CITY as 'nameCity',
				NAME_COUNTRY as 'nameCountry',
				DATE_TRAVEL as 'dateTravel',
				PRICE as 'price',
				FULL_DESCRIPTION as 'full_description',
				RATING as 'rating',
				ACTIVE as 'active',
				(
					select
						up_image.PATH
					from up_product_image
							 left join up_image on up_product_image.IMAGE_ID = up_image.ID
					where up_product_image.PRODUCT_ID = up_product.ID
					  and up_image.MAIN = '0'
				) as 'imageList',
				(
					select
						up_tag.NAME
					from up_product_tag
							 left join up_tag on up_product_tag.TAG_ID = up_tag.ID
					where up_product_tag.PRODUCT_ID = up_product.ID
				) as 'tagList'
			from up_product
			where up_product.ID = ?;
		";

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

		return $result_excursion;
	}

	public static function sortExcursions(mysqli $db, array $idList, int $sortType) : array
	{
		$queryByPriceAsc = "
			select
				ID as 'id',
				NAME_CITY as 'nameCity',
				NAME_COUNTRY as 'nameCountry',
				DATE_TRAVEL as 'dateTravel',
				PRICE as 'price',
				INTERNET_RATING as 'internetRating',
				ENTERTAINMENT_RATING as 'entertainmentRating',
				SERVICE_RATING as 'serviceRating',
				RATING as 'rating',
				DEGREES as 'degrees',
				ACTIVE as 'active',
				(
					select
						up_image.PATH
					from up_product_image
							 left join up_image on up_product_image.IMAGE_ID = up_image.ID
					where up_product_image.PRODUCT_ID = up_product.ID
					  and up_image.MAIN = '1'
				) as 'imageList'
			from up_product 
			where up_product.ID in 
			      (" . implode(',', array_map('intval', $idList)) . ")
			order by up_product.PRICE;
		";

		$queryByPriceDesc = "
			select
				ID as 'id',
				NAME_CITY as 'nameCity',
				NAME_COUNTRY as 'nameCountry',
				DATE_TRAVEL as 'dateTravel',
				PRICE as 'price',
				INTERNET_RATING as 'internetRating',
				ENTERTAINMENT_RATING as 'entertainmentRating',
				SERVICE_RATING as 'serviceRating',
				RATING as 'rating',
				DEGREES as 'degrees',
				ACTIVE as 'active',
				(
					select
						up_image.PATH
					from up_product_image
							 left join up_image on up_product_image.IMAGE_ID = up_image.ID
					where up_product_image.PRODUCT_ID = up_product.ID
					  and up_image.MAIN = '1'
				) as 'imageList'
			from up_product 
			where up_product.ID in 
			      (" . implode(',', array_map('intval', $idList)) . ")
			order by up_product.PRICE DESC;
		";

		$queryByRatingDesc = "
			select
				ID as 'id',
				NAME_CITY as 'nameCity',
				NAME_COUNTRY as 'nameCountry',
				DATE_TRAVEL as 'dateTravel',
				PRICE as 'price',
				INTERNET_RATING as 'internetRating',
				ENTERTAINMENT_RATING as 'entertainmentRating',
				SERVICE_RATING as 'serviceRating',
				RATING as 'rating',
				DEGREES as 'degrees',
				ACTIVE as 'active',
				(
					select
						up_image.PATH
					from up_product_image
							 left join up_image on up_product_image.IMAGE_ID = up_image.ID
					where up_product_image.PRODUCT_ID = up_product.ID
					  and up_image.MAIN = '1'
				) as 'imageList'
			from up_product 
			where up_product.ID in 
			      (" . implode(',', array_map('intval', $idList)) . ")
			order by up_product.RATING DESC;
		";

		$query = '';

		switch ($sortType)
		{
		case 1:
			$query = $queryByPriceAsc;
			break;
		case 2:
			$query = $queryByPriceDesc;
			break;
		case 3:
			$query = $queryByRatingDesc;
			break;
		}

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

	public static function getExcursionsByTag(mysqli $db, array $tagId): array
	{
		$query = "SELECT DISTINCT
    up.ID as 'id',
    up.NAME_CITY as 'nameCity',
    up.NAME_COUNTRY as 'nameCountry',
    up.DATE_TRAVEL as 'dateTravel',
    up.PRICE as 'price',
    up.INTERNET_RATING as 'internetRating',
    up.ENTERTAINMENT_RATING as 'entertainmentRating',
    up.SERVICE_RATING as 'serviceRating',
    up.RATING as 'rating',
    up.DEGREES as 'degrees',
    up.ACTIVE as 'active',
    (
        SELECT
            up_image.PATH
        FROM up_product_image
                 LEFT JOIN up_image on up_product_image.IMAGE_ID = up_image.ID
        WHERE up_product_image.PRODUCT_ID = up.ID
          AND up_image.MAIN = '1'
    ) as 'imageList'
FROM up_product_tag as upt
INNER JOIN up_product up on upt.PRODUCT_ID = up.ID
WHERE upt.TAG_ID IN (".implode(",",$tagId).");";

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

	public static function addExcursion(): string
	{
		return "Excursion Added";
	}
}
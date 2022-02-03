<?php

namespace App\Service;

use App\Entity\Excursion;

class ExcursionService
{
	public static function getExcursions(\mysqli $db) : array
	{
		$query = "
			select
			ID as 'id',
			NAME_CITY as 'nameCity',
			NAME_COUNTRY as 'nameCountry',
			DATE_TRAVEL as 'dateTravel',
			PRICE as 'price',
			SHORT_DESCRIPTION as 'shortDescription',
			FULL_DESCRIPTION as 'longDescription',
			INTERNET_RATING as 'internetRating',
			ENTERTAINMENT_RATING as 'entertainmentRating',
			SERVICE_RATING as 'serviceRating',
			RATING as 'rating',
			ACTIVE as 'active',
			DATE_CREATE as 'dateCreate',
			DATE_UPDATE as 'dateUpdate',
			(
			select
				GROUP_CONCAT(up_product_image.IMAGE_ID)
			from up_product_image
			where up_product_image.PRODUCT_ID = up_product.ID
			) as 'imageList'
			from up_product
		";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$excursions = [];

		while($excursion = mysqli_fetch_assoc($result))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				$excursion['nameCity'],
				$excursion['nameCountry'],
				$excursion['dateTravel'],
				$excursion['price'],
				$excursion['shortDescription'],
				$excursion['longDescription'],
				$excursion['internetRating'],
				$excursion['entertainmentRating'],
				$excursion['serviceRating'],
				$excursion['rating'],
				$excursion['active'],
				$excursion['dateCreate'],
				$excursion['dateUpdate'],
				$excursion['imageList']
			);
		}

		return $excursions;
	}

	public static function getExcursionsByTag() : array
	{
		return [];
	}

	public static function addExcursion() : string
	{
		return "Excursion Added";
	}
}
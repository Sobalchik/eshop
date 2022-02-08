<?php

namespace App\Service;

use App\Entity\Excursion;
use mysqli;

class ExcursionService
{
	public static function getExcursions(mysqli $db): array
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

	public static function getExcursionById(mysqli $db, int $id)
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
					  and up_image.MAIN = '1'
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


	public static function getExcursionsByTag(): array
	{
		return [];
	}

	public static function addExcursion(): string
	{
		return "Excursion Added";
	}
}
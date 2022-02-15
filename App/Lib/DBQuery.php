<?php

namespace App\Lib;

class DBQuery
{
	public static function getExcursionsForHomePage() : string
	{
		return "
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
		";
	}

	public static function getExcursionByIdQuery() : string
	{
		return "
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
	}

	public static function getTopExcursionsQuery() : string
	{
		return self::getExcursionsForHomePage() . "limit 8";
	}

	public static function getAllExcursionsCountQuery() : string
	{
		return "
			select
				count(ID)
			from up_product
		";
	}

	public static function getAllTagsQuery() : string
	{
		return "
			select
				ID as 'id',
				NAME as 'name'
			from up_tag
		";
	}

	public static function getAllExcursionsByPageQuery() : string
	{
		return self::getExcursionsForHomePage() . "LIMIT ?, ?";
	}

	public static function getExcursionsFromIdList(array $idList) : string
	{
		return "where up_product.ID in 
			(" . implode(',', array_map('intval', $idList)) . ")";
	}

	public static function sortExcursionsByPriceAscQuery(array $idList) : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList($idList) .
			"order by up_product.PRICE;";
	}

	public static function sortExcursionsByPriceDescQuery(array $idList) : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList($idList) .
			"order by up_product.PRICE DESC;";
	}

	public static function sortExcursionsByRatingDescQuery(array $idList) : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList($idList) .
			"order by up_product.RATING DESC;";
	}

	public static function getExcursionsByTagQuery(array $tagId) : string
	{
		return
			self::getExcursionsForHomePage() .
			"INNER JOIN up_product_tag on up_product_tag.PRODUCT_ID = up_product.ID
			WHERE up_product_tag.TAG_ID IN (".implode(",",$tagId).")";
	}

}
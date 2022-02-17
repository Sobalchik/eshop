<?php

namespace App\Lib;

class DBQuery
{
	public static function getExcursionsForHomePage() : string
	{
		return "
			select
				up_product.ID as 'id',
				up_product.NAME_CITY as 'nameCity',
				up_product.NAME_COUNTRY as 'nameCountry',
				(
					select
						min(up_date.DATE_TRAVEL)
					from up_date
					left join up_product_date
					on up_date.ID = up_product_date.DATE_ID
					where up_product_date.PRODUCT_ID = up_product.ID
					) as 'dateTravel',
				up_product.PRICE as 'price',
				up_product.INTERNET_RATING as 'internetRating',
				up_product.ENTERTAINMENT_RATING as 'entertainmentRating',
				up_product.SERVICE_RATING as 'serviceRating',
				up_product.RATING as 'rating',
				up_product.DEGREES as 'degrees',
				up_product.ACTIVE as 'active',
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
				(
					select
						min(up_date.DATE_TRAVEL)
					from up_date
							 left join up_product_date
									   on up_date.ID = up_product_date.DATE_ID
					where up_product_date.PRODUCT_ID = up_product.ID
				) as 'dateTravel',
				(
					select
						group_concat(up_date.DATE_TRAVEL)
					from up_date
					left join up_product_date
						on up_date.ID = up_product_date.DATE_ID
					where up_product_date.PRODUCT_ID = up_product.ID
				) as 'allPossibleDatesTravel',
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
				) as 'tagList',
				DURATION as 'duration'
			from up_product
			where up_product.ID = ?
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

	public static function insertExcursionInDBQuery() : string
	{
		return "
			insert into up_product
			(
			 NAME_CITY, 
			 NAME_COUNTRY, 
			 DATE_TRAVEL, 
			 DURATION,
			 COUNT_PERSONS,
			 PRICE, 
			 FULL_DESCRIPTION, 
			 INTERNET_RATING, 
			 ENTERTAINMENT_RATING, 
			 SERVICE_RATING, 
			 RATING, 
			 DEGREES, 
			 ACTIVE
			 )
			values
			(
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?,
			 ?
			)
		";
	}

	public static function updateExcursionById() : string
	{
		return "
			update up_product
			set
				NAME_CITY = ?,
				NAME_COUNTRY = ?,
				DATE_TRAVEL = ?,
				PRICE = ?,
				INTERNET_RATING = ?,
				ENTERTAINMENT_RATING = ?,
				SERVICE_RATING = ?,
				RATING = ?,
				DEGREES = ?,
				ACTIVE = ?
			where ID = ?
		";
	}

	public static function findOrderByClientName() : string
	{
		return "
			select
				up_order.ID as 'id',
				up_order.FIO as 'fio',
				up_order.EMAIL as 'email',
				up_order.PHONE as 'phone',
				up_order.DATE_ORDER as 'orderDate',
				up_order.COMMENT as 'comment',
			    up_order.STATUS_ID as 'statusId',
				up_status_order.NAME as 'status',
			    up_order.PRODUCT_ID as 'productId',
				group_concat(up_product.NAME_CITY,
				    up_product.NAME_COUNTRY) as 'excursionName'
			from up_order
			left join up_product on up_product.ID = up_order.PRODUCT_ID
			left join up_status_order on up_status_order.ID = up_order.STATUS_ID
			where up_order.FIO like (?)
		";
	}

	public static function getExcursionsForAdminPage() : string
	{
		return "
			select
				up_product.ID as 'id',
				up_product.NAME_CITY as 'excursionName',
				up_product.PRICE as 'price',
				(
					select
						   count(up_order.ID)
					from up_order
					left join up_product_date on
						up_order.DATE_ID = up_product_date.DATE_ID
					left join up_date on
						up_order.DATE_ID = up_date.ID
					where up_date.DATE_TRAVEL = (
							select
								min(up_date.DATE_TRAVEL)
							from up_date
									 left join up_product_date
											   on up_date.ID = up_product_date.DATE_ID
							where up_product_date.PRODUCT_ID = up_product.ID
						) and up_order.PRODUCT_ID = up_product.ID
						and STATUS_ID = 2
				) as 'orderedExcursionsCount',
				up_product.COUNT_PERSONS,
				(
					select
						min(up_date.DATE_TRAVEL)
					from up_date
							 left join up_product_date
									   on up_date.ID = up_product_date.DATE_ID
					where up_product_date.PRODUCT_ID = up_product.ID
				) as 'dateTravel'
			from up_product
		";
	}

	public static function getExcursionCompletionByDateById() : string
	{
		return "
			select
				count(up_order.ID) as 'orderedExcursionsCount',
				up_date.DATE_TRAVEL as 'dateTravel'
			from up_order
			left join up_product_date on
			up_order.DATE_ID = up_product_date.DATE_ID
			left join up_date on
			up_order.DATE_ID = up_date.ID
			where STATUS_ID = 2 and up_order.PRODUCT_ID = ?
			group by up_date.DATE_TRAVEL
";
	}

	public static function deleteExcursionById() : string
	{
		return "
			delete from up_product
			where ID = ?
		";
	}

}
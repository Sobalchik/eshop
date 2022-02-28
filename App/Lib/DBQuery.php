<?php

namespace App\Lib;

class DBQuery
{
	public static function getExcursionsForHomePage() : string
	{
		return "
			select distinct 
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
				        and up_date.ACTIVE = 1
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
					  and up_date.ACTIVE = 1
				) as 'dateTravel',
				(
					select group_concat(up_date.DATE_TRAVEL)
					from up_date
					where up_date.DATE_TRAVEL in (
						select
							up_date.DATE_TRAVEL
						from up_date
								 left join up_product_date
										   on up_date.ID = up_product_date.DATE_ID
								 left join up_order on up_date.ID = up_order.DATE_ID
								 left join up_product on up_product_date.PRODUCT_ID = up_product.ID
						where up_product_date.PRODUCT_ID = ?
						  and up_date.ACTIVE = 1
						group by up_date.ID, up_product.COUNT_PERSONS
						having COUNT(up_order.ID) < up_product.COUNT_PERSONS
					)
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
						group_concat(up_tag.NAME)
					from up_product_tag
							 left join up_tag on up_product_tag.TAG_ID = up_tag.ID
					where up_product_tag.PRODUCT_ID = up_product.ID
				) as 'tagList',
				DURATION as 'duration',
				COUNT_PERSONS as 'countPersons',
				(
					select
						group_concat(up_attraction.NAME)
					from up_attraction
							 left join up_product_attraction
									   on up_attraction.ID = up_product_attraction.ATTRACTION_ID
					where up_product_attraction.PRODUCT_ID = up_product.ID
				) as 'attractionList'
			from up_product
			where up_product.ID = ?
			";
	}

	public static function getTopExcursionsQuery() : string
	{
		return
			self::getExcursionsForHomePage() .
			"order by up_product.RATING
			limit 8";
	}

	public static function getAllExcursionsCountQuery() : string
	{
		return "
			select
				count(ID)
			from up_product
		";
	}

	public static function getExcursionsFromIdList() : string
	{
		return "where find_in_set(ID, ?)";
	}

	public static function sortExcursionsByPriceAscQuery() : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList() .
			"order by up_product.PRICE;";
	}

	public static function sortExcursionsByPriceDescQuery() : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList() .
			"order by up_product.PRICE DESC;";
	}

	public static function sortExcursionsByRatingDescQuery() : string
	{
		return
			self::getExcursionsForHomePage() .
			self::getExcursionsFromIdList() .
			"order by up_product.RATING DESC;";
	}

	public static function organizeTagIdList() : string
	{
		return "
			select
			TYPE_ID as 'tagType',
			group_concat(TAG_ID) as 'tagList'
			from up_tag_type_tag
			where find_in_set(TAG_ID, ?)
			group by TYPE_ID
		";
	}

	public static function getExcursionsByTagHelpQuery() : string
	{
		return
			"up_product.ID in
			(
				select concat(up_product.ID)
				from up_product
				left join up_product_tag on up_product.ID = up_product_tag.PRODUCT_ID
				left join up_tag_type_tag on up_tag_type_tag.TAG_ID = up_product_tag.TAG_ID
				where up_tag_type_tag.TAG_ID in
				(
					select concat(up_tag_type_tag.TAG_ID)
					from up_tag_type_tag
					where find_in_set(up_tag_type_tag.TAG_ID, ?) and up_tag_type_tag.TYPE_ID = ?
					group by up_tag_type_tag.TYPE_ID
				)
			)
		";
	}

	public static function getExcursionsByTagFullQuery(int $count) : string
	{
		$query = self::getExcursionsForHomePage();

		$query .= "where ". self::getExcursionsByTagHelpQuery();

		for ($i = 1; $i < $count; $i++)
		{
			$query .= " and " . self::getExcursionsByTagHelpQuery();
		}

		return $query;
	}

	public static function updateExcursionById() : string
	{
		return "
			update up_product
			set
				NAME_CITY = ?,
				NAME_COUNTRY = ?,
				PRICE = ?,
				INTERNET_RATING = ?,
				ENTERTAINMENT_RATING = ?,
				SERVICE_RATING = ?,
				RATING = ?,
				DEGREES = ?,
				ACTIVE = ?,
			    FULL_DESCRIPTION = ?,
			    DURATION = ?,
			    COUNT_PERSONS = ?
			where ID = ?
		";
	}

	public static function findOrderByClientName() : string
	{
		return
			self::getOrdersForAdminPage() .
			"where up_order.FIO like (?)";
	}

	public static function findExcursionByNameForAdminPage() : string
	{
		return
			self::getExcursionsForAdminPage() .
			'where up_product.NAME_CITY like (?)
			or up_product.NAME_COUNTRY like (?)';
	}

	public static function findExcursionByNameForHomePage() : string
	{
		return
			self::getExcursionsForHomePage() .
			'where up_product.NAME_CITY like (?)
			or up_product.NAME_COUNTRY like (?)';
	}

	public static function getExcursionsForAdminPage() : string
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
				    and up_date.ACTIVE = 1
				) as 'dateTravel',
				up_product.COUNT_PERSONS as 'countPersons',
				up_product.PRICE as 'price'
			from up_product
		";
	}

	public static function getExcursionForAdminDetailedPage() : string
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
				        and up_date.ACTIVE = 1
				) as 'dateTravel',
				up_product.DURATION as 'duration',
				up_product.COUNT_PERSONS as 'countPersons',
				up_product.PRICE as 'price',
				up_product.FULL_DESCRIPTION as 'fullDescription',
				up_product.INTERNET_RATING as 'internetRating',
				up_product.ENTERTAINMENT_RATING as 'entertainmentRating',
				up_product.SERVICE_RATING as 'serviceRating',
				up_product.RATING as 'rating',
				up_product.DEGREES as 'degrees',
				up_product.ACTIVE as 'active',
				(
					select
						group_concat(up_tag.NAME)
					from up_product_tag
							 left join up_tag on up_product_tag.TAG_ID = up_tag.ID
					where up_product_tag.PRODUCT_ID = up_product.ID
				) as 'tagList'
			from up_product
			where ID = ?
		";
	}

	public static function getExcursionCompletionByDateById() : string
	{
		return "
			select
				COUNT(up_order.ID) as 'orderedExcursionsCount',
				up_date.DATE_TRAVEL as 'dateTravel',
				up_date.ACTIVE as 'active',
				up_date.ID as 'id'
			from up_product_date
			left join up_date on up_product_date.DATE_ID = up_date.ID
			left join up_order on up_date.ID = up_order.DATE_ID
			where up_product_date.PRODUCT_ID = ?
				and up_date.ACTIVE = 1
			group by up_date.ACTIVE, up_date.DATE_TRAVEL, up_date.ID
		";
	}

	public static function deleteExcursionById() : string
	{
		return "
			delete from up_product
			where ID = ?
		";
	}

	public static function deleteDateById() : string
	{
		return "
			delete from up_product_date 
			WHERE DATE_ID = ?;

			delete from up_date 
			WHERE ID = ?;
		";
	}

	public static function deleteOrderById() : string
	{
		return "
			delete from up_order
			where up_order.ID = ?
		";
	}

	public static function addNewDate() : string
	{
		return "
			insert into up_date
			(DATE_TRAVEL, ACTIVE, DATE_CREATE, DATE_UPDATE)
			values
			(?, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
		";
	}

	public static function addNewDateRelations() : string
	{
		return "
			insert into up_product_date
			(PRODUCT_ID, DATE_ID)
			values
			(
			    ?,
				(
					select 
						max(up_date.ID)
					from up_date)
			);
		";
	}

	public static function getOrdersForAdminPage() : string
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
			   (
					select concat(up_product.NAME_CITY, ', ',
								  up_product.NAME_COUNTRY)
					from up_product
					left join up_product_date
					on up_product.ID = up_product_date.PRODUCT_ID
					where up_product_date.DATE_ID = up_order.DATE_ID
				) as 'excursionName',
				up_date.DATE_TRAVEL as 'dateTravel'
			from up_order
			left join up_status_order on up_status_order.ID = up_order.STATUS_ID
			left join up_date on up_order.DATE_ID = up_date.ID
		";
	}

	public static function sortOrdersByDateCreateDesc() : string
	{
		return self::getOrdersForAdminPage() .
			"order by up_order.DATE_CREATE desc";
	}

	public static function sortOrdersByStatusCreatedProgressedCompleted() : string
	{
		return self::getOrdersForAdminPage() .
			"order by up_order.STATUS_ID desc";
	}

	public static function editOrder() : string
	{
		return "
			update up_order
			set
				up_order.FIO = ?,
				up_order.EMAIL = ?,
				up_order.PHONE = ?,
			    up_order.COMMENT = ?,
				up_order.STATUS_ID = ?
			where up_order.ID = ?
		";
	}

	public static function insertOrderInDBQuery(): string
	{
		return "
			insert into up_order
			(
			 FIO,
			 EMAIL,
			 PHONE,
			 DATE_ORDER,
			 COMMENT,
			 STATUS_ID,
			 DATE_ID,
			 DATE_CREATE,
			 DATE_UPDATE
			 )
			values
			(
			?,
			?,
			?,
			?,
			?,
			?,
			(
			select up_date.ID
			from up_date
			where up_date.DATE_TRAVEL = ?
			),
			CURRENT_TIMESTAMP,
			CURRENT_TIMESTAMP
			)
		";
	}

	public static function getAllStatuses() : string
	{
		return "
		select
			ID as 'id',
			NAME as 'name'
		from up_status_order
		";
	}

	public static function getAllActiveDates() : string
	{
		return "
			select
				up_date.ID as 'id',
				up_date.DATE_TRAVEL as 'date'
			from up_date
			where up_date.ACTIVE = 1
		";
	}

	public static function addNewExcursion() : string
	{
		return
			"insert into up_product
			(
				NAME_CITY,
				NAME_COUNTRY,
				DURATION,
				COUNT_PERSONS,
				PRICE,
				FULL_DESCRIPTION, 
				INTERNET_RATING, 
				ENTERTAINMENT_RATING, 
				SERVICE_RATING, 
				RATING, DEGREES, 
				ACTIVE, DATE_CREATE, 
				DATE_UPDATE
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
				 CURRENT_TIMESTAMP,
				 CURRENT_TIMESTAMP
			)
		";
	}

	public static function addProductBelongTags() : string
	{
		return "
			insert into up_product_tag 
			(PRODUCT_ID, TAG_ID) 
			values
			(?, ?)
		";
	}

	public static function deleteProductBelongTags() : string
	{
		return "
			delete from up_product_tag 
			WHERE PRODUCT_ID = ?
		";
	}

	public static function getTagsForAdminPage() : string
	{
		return "
			select
				ut.ID as tagId,
				ut.NAME as tagName,
				(
					SELECT 
						COUNT(PRODUCT_ID) 
					FROM up_product_tag 
					WHERE up_product_tag.TAG_ID = tagId
				) as tagBindProduct
			from up_tag as ut
				inner join up_tag_type_tag uttt on ut.ID = uttt.TAG_ID
			WHERE uttt.TYPE_ID = ?
			ORDER BY tagName;
		";
	}

	public static function getTypeTagsForAdminPage() : string
	{
		return "
			select 
				ID as id,
				NAME as name,
				(
					SELECT 
						COUNT(TAG_ID) 
					FROM up_tag_type_tag 
					WHERE TYPE_ID=id
				) as typeTagBindTag
			from up_type_tag
			";
	}

	public static function deleteFromTagTypeTag() : string
	{
		return "
			delete from up_tag_type_tag 
			where up_tag_type_tag.TAG_ID = ?;
		";
	}

	public static function deleteTag() : string
	{
		return "
			delete from up_tag_type_tag 
			where up_tag_type_tag.TAG_ID = ?;
		";
	}

	public static function deleteTypeTag() : string
	{
		return "
			DELETE FROM up_type_tag 
			WHERE ID = ?;
		";
	}

	public static function saveTag() : string
	{
		return "
			UPDATE up_tag 
			SET 
				NAME = ? 
			WHERE ID = ?;
		";
	}

	public static function saveTypeTag() : string
	{
		return "
			UPDATE up_type_tag 
			SET 
				NAME = ? 
			WHERE ID = ?
		";
	}

	public static function addTag() : string
	{
		return "
			INSERT INTO `up_tag`
			(`NAME`, `DATE_CREATE`, `DATE_UPDATE`)
			VALUES
			(?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
		";
	}

	public static function setTypeBelongTag() : string
	{
		return "
			INSERT INTO `up_tag_type_tag`
			(`TAG_ID`, `TYPE_ID`)
			VALUES
			(?, ?)
		";
	}

	public static function addTypeTag() : string
	{
		return "
			INSERT INTO `up_type_tag`
			(`NAME`, `DATE_CREATE`, `DATE_UPDATE`) 
			VALUES 
			(?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)
		";
	}

	public static function getUserByLogin() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE LOGIN = ?
			LIMIT 1
		";
	}

	public static function getUserById() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE ID = ? 
			LIMIT 1
		";
	}

	public static function getUserByHash() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE USER_HASH = ?
			LIMIT 1
		";
	}

	public static function setUserHash() : string
	{
		return "
			UPDATE up_user 
			SET 
				USER_HASH = ? 
			WHERE ID = ?;
		";
	}

	public static function setPassword() : string
	{
		return "
			UPDATE up_user 
			SET 
				PASSWORD = ?
			WHERE ID = ?;
		";
	}
}
<?php

namespace App\Lib;

class DBQuery
{
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
<?php

namespace App\Service;

use App\Entity\Tag;
use App\Entity\TypeTag;
use App\Lib\DBQuery;
use mysqli;

class TagService
{
	public static function getTagsForAdminPage(mysqli $db, int $typeTag) : array
	{
		$query = "select
    				ut.ID as tagId,
    				ut.NAME as tagName,
    				(SELECT COUNT(PRODUCT_ID) FROM up_product_tag WHERE up_product_tag.TAG_ID=tagId) as tagBindProduct
					from up_tag as ut
         				inner join up_tag_type_tag uttt on ut.ID = uttt.TAG_ID
					WHERE uttt.TYPE_ID={$typeTag}
					ORDER BY tagName;";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];
		while ($tag = mysqli_fetch_assoc($result))
		{
			$currentTag = new Tag(
				$tag['tagId'],
				$tag['tagName'],
				$typeTag,
				null,
				null
			);
			$currentTag->setTagBindProduct($tag['tagBindProduct']);
			$tags[] = $currentTag;
		}

		return $tags;
	}

	public static function getTypeTagsForAdminPage(mysqli $db) : array
	{
		$query = "select 
       				ID as id,
       				NAME as name,
       				(SELECT COUNT(TAG_ID) FROM up_tag_type_tag WHERE TYPE_ID=id) as typeTagBindTag
				from up_type_tag";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$typeTags = [];
		while ($typeTag = mysqli_fetch_assoc($result))
		{
			$currentTypeTags = new TypeTag(
				$typeTag['id'],
				$typeTag['name'],
				null,
				null,
				null
			);
			$currentTypeTags->setTypeTagBindTag($typeTag['typeTagBindTag']);
			$typeTags [] = $currentTypeTags;
		}

		return $typeTags;
	}


	public static function parseTagsByType(\mysqli_result $result) : array
	{
		$tags = [];
		while ($tag = mysqli_fetch_assoc($result))
		{
			$tags [] = new Tag(
				$tag['id'],
				$tag['name'],
				$tag['tagType'],
				null,
				null
			);
		}

		return $tags;
	}

	public static function getTagsByTypeCountry(mysqli $db) : array
	{
		$query = DBQuery::getTagsByTypeCountry();
		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseTagsByType($result);
	}

	public static function getTagsByTypeContinent(mysqli $db) : array
	{
		$query = DBQuery::getTagsByTypeContinent();
		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseTagsByType($result);
	}

	public static function getTagsByTypeFamilyFriendly(mysqli $db) : array
	{
		$query = DBQuery::getTagsByTypeFamilyFriendly();
		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseTagsByType($result);
	}

	public static function deleteTag(mysqli $db, int $tagId): void
	{
		$query = "DELETE FROM up_tag_type_tag WHERE TAG_ID={$tagId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$query = "DELETE FROM up_tag WHERE ID={$tagId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function saveTag(mysqli $db, int $tagId, string $tagName): void
	{
		$query = "UPDATE up_tag SET NAME='{$tagName}' WHERE ID={$tagId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function saveTypeTag(mysqli $db, int $typeTagId, string $typeTagName): void
	{
		$query = "UPDATE up_type_tag SET NAME='{$typeTagName}' WHERE ID={$typeTagId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}
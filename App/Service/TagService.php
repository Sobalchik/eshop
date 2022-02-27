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
		$query = DBQuery::getTagsForAdminPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $typeTag);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

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
		$query = DBQuery::getTypeTagsForAdminPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

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

	public static function deleteTag(mysqli $db, int $tagId): void
	{
		$query = DBQuery::deleteTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "ii", $typeTag, $typeTag);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function deleteTypeTag(mysqli $db, int $typeTagId): void
	{
		$query = DBQuery::deleteTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function saveTag(mysqli $db, int $tagId, string $tagName): void
	{
		$query = DBQuery::saveTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "ii", $tagName, $tagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function saveTypeTag(mysqli $db, int $typeTagId, string $typeTagName): void
	{
		$query = DBQuery::saveTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "ii", $typeTagName, $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function addTag(mysqli $db, string $tagName): int
	{
		$query = DBQuery::addTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $tagName);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	public static function setTypeTagBelongTag(mysqli $db, int $typeTagId, int $tagId): void
	{
		$query = DBQuery::setTypeBelongTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "ii", $tagId, $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function addTypeTag(mysqli $db, string $typeTagName): int
	{
		$query = DBQuery::addTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $typeTagName);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}
}
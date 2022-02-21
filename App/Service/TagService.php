<?php

namespace App\Service;

use App\Entity\Tag;
use App\Entity\TypeTag;
use mysqli;

class TagService
{
	public static function getTagsForAdminPage(mysqli $db, int $typeTag) : array
	{
		$query = "select
    					ut.ID as tagId,
    					ut.NAME as tagName
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
			$tags[] = new Tag(
				$tag['tagId'],
				$tag['tagName'],
				$typeTag,
				null,
				null
			);
		}

		return $tags;
	}

	public static function getTypeTagsForAdminPage(mysqli $db) : array
	{
		$query = "select ID as id, NAME as name from up_type_tag";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$typeTags = [];
		while ($typeTag = mysqli_fetch_assoc($result))
		{
			$typeTags [] = new TypeTag(
				$typeTag['id'],
				$typeTag['name'],
				null,
				null,
				null
			);
		}

		return $typeTags;
	}
}
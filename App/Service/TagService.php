<?php

namespace App\Service;

use App\Entity\Tag;
use mysqli;

class TagService
{
	public static function getTagsForAdminPage(mysqli $db) : array
	{
		$query = "select
    uttt.TYPE_ID as typeID,
    utt.NAME as typeName,
    ut.ID as tagId,
    ut.NAME as tagName,
    ut.DATE_CREATE as tagDateCreate,
    ut.DATE_UPDATE as tagDateUpdate
from up_tag as ut
         inner join up_tag_type_tag uttt on ut.ID = uttt.TAG_ID
         inner join up_type_tag utt on uttt.TYPE_ID = utt.ID
ORDER BY typeID, tagName;";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];

		while ($tag = mysqli_fetch_assoc($result))
		{
			$tags[$tag['typeName']][]= new Tag(
				$tag['tagId'],
				$tag['tagName'],
				$tag['typeId'],
				$tag['typeName'],
				$tag['tagDateCreate'],
				$tag['tagDateUpdate'],
			);
		}

		return $tags;
	}
}
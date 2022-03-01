<?php

namespace App\Service;

use App\Entity\Image;
use App\Lib\DBQuery;
use mysqli;

class ImageService
{
	public static function getImageBindExcusionById(mysqli $db, int $excursionId): array
	{
		$query = "select
    				ui.ID as imageId,
    				ui.PATH as imagePath,
    				ui.MAIN as imageMain,
    				ui.DATE_CREATE as dateCreate,
    				ui.DATE_UPDATE as dateUpdate,
					from up_image as ui
         				inner join up_product_image upi on ui.ID = upi.IMAGE_ID
					WHERE upi.PRODUCT_ID={$excursionId}
					ORDER BY tagName;";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$imageList = [];

		while ($image = mysqli_fetch_assoc($result))
		{
			$currentImage = new Image(
				$image['imageId'],
				$image['imagePath'],
				$image['imageMain'],
				$excursionId,
				$image['dateCreate'],
				$image['dateUpdate']
			);
			$imageList[] = $currentImage;
		}

		return $imageList;
	}

	public static function deleteImageById(mysqli $db, int $imageId): void
	{
		$query = "DELETE up_product_image WHERE IMAGE_ID={$imageId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$query = "DELETE up_image WHERE ID={$imageId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function addImage(mysqli $db, Image $image)
	{
		$query = "insert into ";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}
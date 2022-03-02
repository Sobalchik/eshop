<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Helper;
use App\Service\ImageService;
use App\Lib\Render;

class ImageController
{

	public static function imageUploadAction(): string
	{
		$tmpFolderForPublic = "/Upload/Images/Temp/";
		$tmpFolder = $_SERVER['DOCUMENT_ROOT'].$tmpFolderForPublic;
		if (!is_dir($tmpFolder)) {
			mkdir($tmpFolder, 0777, true);
		}
		else
		{
			foreach (glob($tmpFolder."*") as $file)
			{
				unlink($file);
			}
		}
		$data = '';
		for ($i=0;$i<count($_FILES['file']['tmp_name']);$i++)
		{
			move_uploaded_file($_FILES['file']['tmp_name'][$i], $tmpFolder.$_FILES['file']['name'][$i]);
			$info = pathinfo($tmpFolder.$_FILES['file']['name'][$i]);
			$thumb = Helper::createPreaviewImage($tmpFolder.$_FILES['file']['name'][$i],$tmpFolder.$info['filename']."-thumb.".$info['extension']);
			$data .= "<div class='img-item' id='imageFile_".$info['filename']."'><img src='".$tmpFolderForPublic.$info['filename']."-thumb.".$info['extension']."'>";
			$data .= "<input name='imageFileOriginal' type='hidden' value='".$tmpFolder.$_FILES['file']['name'][$i]."'> <input name='imageFilePreview' type='hidden' value='".$tmpFolderForPublic.$info['filename']."-thumb.".$info['extension']."'></div>";
		}
		return $data;
	}

	public static function setImageBindExcusionAction(string $pathFileOriginal, string $pathFilePreview, int $excursionId): int
	{
		$folderUpload = "/Upload/Images/Products/";
		$info = pathinfo($pathFileOriginal);
		$imageList = ImageService::getImageBindExcusionById(Database::getDatabase(), $excursionId);
		if (!$imageList)
		{
			$imageId = ImageService::addImage(Database::getDatabase(), $folderUpload.$excursionId.".".$info['extension'], 1);
			ImageService::setImageBindExcusionById(Database::getDatabase(), $excursionId,$imageId);
			rename($pathFileOriginal,$_SERVER['DOCUMENT_ROOT'].$folderUpload.$excursionId.$info['extension']);
			unlink($_SERVER['DOCUMENT_ROOT'].$pathFilePreview);
		}
	}

	public static function imageDeleteAction(): string
	{
		if ($_POST['imageId']==0)
		{
			unlink($_POST['pathOriginFile']);
			unlink($_POST['pathPreviewFile']);
		}
		return "true";
	}
}
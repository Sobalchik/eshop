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
		if (!is_dir($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/")) {

			mkdir($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/", 0777, true);

		}
		$data = '';
		for ($i=0;$i<count($_FILES['file']['tmp_name']);$i++)
		{
			move_uploaded_file($_FILES['file']['tmp_name'][$i], $tmpFolder.$_FILES['file']['name'][$i]);
			$info = pathinfo($tmpFolder.$_FILES['file']['name'][$i]);
			$thumb = Helper::createPreaviewImage($tmpFolder.$_FILES['file']['name'][$i],$tmpFolder.$info['filename']."-thumb.".$info['extension']);
			$data .= "<div class='img-item' id='imageFile_".$info['filename']."'><img src='".$tmpFolderForPublic.$info['filename']."-thumb.".$info['extension']."'><a href='javascript:void(0)' onclick='fileImageDelete('imageFile_".$info['filename']."')' '>Удалить</a></div>";
		}
		return $data;
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
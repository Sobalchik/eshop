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
		if (!is_dir($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/")) {

			mkdir($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/", 0777, true);

		}
		$data = '';
		for ($i=0;$i<count($_FILES['file']['tmp_name']);$i++)
		{
			move_uploaded_file($_FILES['file']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/".$_FILES['file']['name'][$i]);
			$info = pathinfo($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/".$_FILES['file']['name'][$i]);
			$thumb = Helper::createPreaviewImage($_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/".$_FILES['file']['name'][$i],$_SERVER['DOCUMENT_ROOT']."/Upload/Images/Temp/".$info['filename']."-thumb.".$info['extension']);
			$data .='<div class="img-item"><img src="/Upload/Images/Temp/' . $info['filename'] ."-thumb.".$info['extension'].'"><a herf="javascript:void(0)" onclick="fileImageRemove();">Удалить</a></div>';
		}
		return $data;
	}
}
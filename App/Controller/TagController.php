<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Helper;
use App\Service\TagService;
use App\Lib\Render;

class TagController
{

	public static function showAdminTags(): string
	{
		if(!UserController::isAuthorized())
		{
			header("Location: ".Helper::getUrl()."/login");
		}
		else
		{
			$content = Render::renderContent("admin-tags-list", ["tags" => array()]);
			return Render::renderAdminMenu($content);
		}
	}

}
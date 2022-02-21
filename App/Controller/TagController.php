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
			$tags = TagService::getTagsForAdminPage(Database::getDatabase());
			$content = Render::renderContent("admin-tags-list", ["tags" => $tags]);
			return Render::renderAdminMenu($content);
		}
	}

}
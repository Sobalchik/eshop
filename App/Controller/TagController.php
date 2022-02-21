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
			$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
			foreach ($typeTags as $typeTag)
			{
				$tagsBelong = TagService::getTagsForAdminPage(Database::getDatabase(),$typeTag->getId());
				$typeTag->setTagsBelong($tagsBelong);
			}
			$content = Render::renderContent("admin-tags-list", ["typeTags" => $typeTags]);
			return Render::renderAdminMenu($content);
		}
	}

}
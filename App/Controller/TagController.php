<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Helper;
use App\Service\TagService;
use App\Lib\Render;

class TagController
{

	public static function showAdminTagsPrepare(): string
	{
		$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
		foreach ($typeTags as $typeTag)
		{
			$tagsBelong = TagService::getTagsForAdminPage(Database::getDatabase(),$typeTag->getId());
			$typeTag->setTagsBelong($tagsBelong);
		}
		$content = Render::renderContent("admin-tags-list", ["typeTags" => $typeTags]);
		return $content;
	}

	public static function showAdminTags(): string
	{
		if(!UserController::isAuthorized())
		{
			header("Location: ".Helper::getUrl()."/login");
		}
		else
		{
			return Render::renderAdminMenu(TagController::showAdminTagsPrepare());
		}
	}

	public static function deleteTag(int $id): string
	{
		if(!UserController::isAuthorized())
		{
			header("Location: ".Helper::getUrl()."/login");
		}
		else
		{
			$deleteTag = TagService::deleteTag(Database::getDatabase(), $id);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function saveTag(): string
	{
		if(!UserController::isAuthorized())
		{
			header("Location: ".Helper::getUrl()."/login");
		}
		else
		{
			$tagId = $_POST['tagId'];
			$tagName = $_POST['tagName'];
			$saveTag = TagService::saveTag(Database::getDatabase(), $tagId, $tagName);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function saveTypeTag(): string
	{
		if(!UserController::isAuthorized())
		{
			header("Location: ".Helper::getUrl()."/login");
		}
		else
		{
			$typeTagId = $_POST['typeTagId'];
			$typeTagName = $_POST['typeTagName'];
			$saveTypeTag = TagService::saveTypeTag(Database::getDatabase(), $typeTagId, $typeTagName);
			return TagController::showAdminTagsPrepare();
		}
	}

}
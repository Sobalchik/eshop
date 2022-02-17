<?php

namespace App\Controller;

use App\Lib\Render;
use App\Service\ExcursionService;
use App\Config\Database;

class ExcursionController
{
	public static function showTopExcursions(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);
	}

	public static function showExcursionById($id): string
	{
		$excursion = ExcursionService::getExcursionById(Database::getDatabase(), $id);
		return Render::render("content-detailed-excursion", ['excursion' => $excursion]);
	}

	public static function showAllExcursions(int $page): string
	{
		$helper = \App\Lib\Helper::getInstance();
		$pageCount = $helper->getPagesCount();

		$excursions = ExcursionService::getAllExcursionsByPage(Database::getDatabase(),$page);
		return Render::render("content-all-excursions", ['excursions' => $excursions,'page' => $page,'pageCount' => $pageCount]);
	}

	public static function showAdminExcursionById(): string
	{
		$excursion = ExcursionService::getExcursionById(Database::getDatabase(), 1);
		$content = Render::renderContent("admin-excursions-detailed", ["excursion" => $excursion]);
		return Render::renderAdminMenu($content);
	}

}
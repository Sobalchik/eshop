<?php

namespace App\Controller;

use App\Entity\Excursion;
use App\Lib\Helper;
use App\Lib\Render;
use App\Logger\Logger;
use App\Service\ExcursionService;
use App\Config\Database;
use App\Service\TagService;

class ExcursionController
{
	/**
	 * Вывод лучших 8 экскурсий по рейтингу на публичную страницу
	 *
	 * @return string строка с html кодом
	 */
	public static function showTopExcursionsForPublicPageAction(): string
	{
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", "layout", ['excursions' => $excursions]);
	}

	/**
	 * Вывод всех экскурсий на публичную страницу
	 *
	 * @return string строка с html кодом
	 */
	public static function showAllExcursionsAction(): string
	{
		$tagList = TagController::getAllTagsAction();
		$excursions = ExcursionService::getExcursionsForHomePage(Database::getDatabase());
		$content = Render:: renderContent("content-card", ['excursions' => $excursions]);
		return Render::render("content-all-excursions", "layout", [
			'content' => $content,
			'tagList' => $tagList,
		]);
	}

	/**
	 * Вывод подробной информации об экскурсии на публичную страницу
	 *
	 * @param $excursionId
	 * @return string строка с html кодом
	 */
	public static function showExcursionByIdAction($excursionId): string
	{
		$excursion = ExcursionService::getExcursionById(Database::getDatabase(), $excursionId);
		return Render::render("content-detailed-excursion", "layout", ['excursion' => $excursion]);
	}

	/**
	 * Выводит отсортированные экскурсии по возрастанию/убыванию,
	 * кол-во зависит от выбранных тегов.
	 * В случае если теги не выбраны, сортирует все имеющиеся экскурсии.
	 *
	 * @return string строка с html кодом
	 */
	public static function showSortedExcursionsAction(): string
	{
		if ($_POST['tagList'] === null && ($_POST['order'] === null)) // $_POST['tagList'] - массив с id выбранных тегов.
		{
			$excursions = ExcursionService::getExcursionsForHomePage(Database::getDatabase());
			return Render:: renderContent("content-card", ['excursions' => $excursions]);
		}

		if (($_POST['tagList'] === null) && ($_POST['order'] !== null))
		{
			(int)$order = $_POST['order'];
			$allExcursions = ExcursionService::getExcursionsForHomePage(Database::getDatabase());
			$excursions = ExcursionService::getExcursionsForHomePageSortedByType(Database::getDatabase(), $allExcursions, $order);
			return Render:: renderContent("content-card", ['excursions' => $excursions]);
		}

		$excursions = ExcursionService::getExcursionsByTag(Database::getDatabase(), $_POST['tagList']);

		if (sizeof($excursions) == 0) // в случае если экскурсий с таким набором тегов не существует
		{
			return MessageController::excursionNotFoundAction();
		}

		if ($_POST['order'] !== null) // в случае если присутствует какая-либо сортировка
		{
			$excursions = ExcursionService::getExcursionsForHomePageSortedByType(Database::getDatabase(), $excursions, $_POST['order']);
		}

		return Render:: renderContent("content-card", ['excursions' => $excursions]);
	}

	/**
	 * Выводит найденную по поиску экскурсию на публичную страницу.
	 *
	 * @return string строка с html кодом
	 */
	public static function showFoundBySearchExcursionsAction(): string
	{
		$excursions = ExcursionService::getExcursionsForHomePageByName(Database::getDatabase(),
			$_POST['search-excursions']); // $_POST['search-excursions']) - массив из id найденных экскурсий
		if (sizeof($excursions) == 0)
		{
			return MessageController::excursionNotFoundAction();
		}
		return Render:: renderContent("content-card", ['excursions' => $excursions]);
	}

	public static function showAdminExcursionById(): string
	{
		if (UserController::isAuthorized())
		{
			$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(), $_GET['id']);
			$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
			foreach ($typeTags as $typeTag)
			{
				$tagsBelong = TagService::getTagsForAdminPage(Database::getDatabase(), $typeTag->getId());
				$typeTag->setTagsBelong($tagsBelong);
			}
			$content = Render::renderContent("admin-excursions-detailed-edit",
				["excursion" => $excursion, "typeTags" => $typeTags]);
			return Render::renderLayout($content, "admin");
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
			return '';
		}
	}

	public static function showAdminExcursionList(): string
	{
		if (UserController::isAuthorized())
		{
			$excursions = ExcursionService::getExcursionsForAdminHomePage(Database::getDatabase());
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderLayout($content, "admin");
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
			return '';
		}
	}

	public static function showAdminExcursionListBySearch(): string
	{
		if (UserController::isAuthorized())
		{
			$excursions = ExcursionService::getExcursionsForHomePageByName(Database::getDatabase(),
				$_POST['search-excursions']);
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderLayout($content, "admin");
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
			return '';
		}
	}

	public static function addExcursionDate(): string
	{
		$date = str_replace("T", " ", $_POST['date']);
		ExcursionService::addDateToExcursionById(Database::getDatabase(), $_POST['id'], $date);
		header("Location: " . Helper::getUrl() . "/admin/excursions");
		return self::showAdminExcursionList();
	}

	public static function editExcursion(): string
	{
		$excursion = ExcursionService::getExcursionForAdminDetailedPage(Database::getDatabase(), $_POST['id']);
		$excursion->setNameCity($_POST['city']);
		$excursion->setNameCountry($_POST['country']);
		$excursion->setPrice($_POST['price']);
		$excursion->setInternetRating((float)$_POST['iRating']);
		$excursion->setEntertainmentRating((float)$_POST['eRating']);
		$excursion->setServiceRating((float)$_POST['sRating']);
		$excursion->setDuration((int)$_POST['duration']);
		$excursion->setDegrees((float)$_POST['degrees']);
		$excursion->setTagList(explode(',', $_POST['tagList']));
		$excursion->setCountPersons($_POST['person']);
		$excursion->setFullDescription($_POST['description']);
		$excursion->setRating(Helper::calculationRating($excursion->getInternetRating(),
			$excursion->getEntertainmentRating(), $excursion->getServiceRating()));
		$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
		$resultSelectTags = [];
		foreach ($typeTags as $typeTag)
		{
			$resultSelectTags = array_merge($resultSelectTags, $_POST['select_typeTag_' . $typeTag->getId()]);
		}
		$excursion->setTagList($resultSelectTags);
		ExcursionService::editExcursionById(Database::getDatabase(), $excursion);
		ExcursionService::deleteProductBelongTags(Database::getDatabase(), $excursion);
		ExcursionService::addProductBelongTags(Database::getDatabase(), $excursion);

		return self::showAdminExcursionList();
	}

	public static function addExcursion()
	{
		if (UserController::isAuthorized())
		{
			$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
			foreach ($typeTags as $typeTag)
			{
				$tagsBelong = TagService::getTagsForAdminPage(Database::getDatabase(), $typeTag->getId());
				$typeTag->setTagsBelong($tagsBelong);
			}
			$content = Render::renderContent("admin-excursions-detailed-add", ["typeTags" => $typeTags]);
			return Render::renderLayout($content, "admin");
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
			return '';
		}
	}

	public static function createExcursion()
	{
		$excursionDate = new \DateTime('now');
		if (UserController::isAuthorized())
		{
			$excursion = new Excursion(
				0,
				mysqli_real_escape_string(Database::getDatabase(), $_POST['city']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['country']),
				'null',
				mysqli_real_escape_string(Database::getDatabase(), $_POST['price']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['description']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['iRating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['eRating']),
				mysqli_real_escape_string(Database::getDatabase(), $_POST['sRating']),
				'null',
				mysqli_real_escape_string(Database::getDatabase(), $_POST['degrees']),
				1,
				'null',
				$excursionDate->format("Y-m-d H:i:s"),
				$excursionDate->format("Y-m-d H:i:s")
			);
			$excursion->setRating(Helper::calculationRating($excursion->getInternetRating(),
				$excursion->getEntertainmentRating(), $excursion->getServiceRating()));
			$excursion->setCountPersons(mysqli_real_escape_string(Database::getDatabase(), $_POST['person']));
			$excursion->setDuration(mysqli_real_escape_string(Database::getDatabase(), $_POST['duration']));
			$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
			$resultSelectTags = [];
			foreach ($typeTags as $typeTag)
			{
				$resultSelectTags = array_merge($resultSelectTags, $_POST['select_typeTag_' . $typeTag->getId()]);
			}
			$excursion->setTagList($resultSelectTags);
			$excursionId = ExcursionService::addExcursion(Database::getDatabase(), $excursion);
			$excursion->setId($excursionId);
			ExcursionService::addProductBelongTags(Database::getDatabase(), $excursion);
			return self::showAdminExcursionList();
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
			return '';
		}
	}

	public static function deactivateDate(): string
	{
		$log = new Logger;
		$log->info('', ['id' => $_POST['id']]);
		ExcursionService::deactivateDate(Database::getDatabase(), $_POST['id']);
		header("Location: " . Helper::getUrl() . "/admin/excursions");
		return self::showAdminExcursionList();
	}

	public static function deleteExcursionDate(): void
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			ExcursionService::deleteDateById(Database::getDatabase(), $_POST['dateId']);
		}
	}

}
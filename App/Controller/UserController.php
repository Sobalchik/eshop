<?php

namespace App\Controller;

use App\Service\UserService;
use App\Config\Database;
use App\Lib\Helper;
use App\Service\ExcursionService;
use App\Lib\Render;

class UserController
{

	public static function loginUser(): string
	{
		return Render::renderContent("login", []);
	}

	public static function logOutUser(): string
	{
		session_start();
		$_SESSION = [];
		session_destroy();
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", ['excursions' => $excursions]);
	}

	public static function adminPanel(): string
	{
		if (self::isAuthorized() === true)
		{
			return Render::renderContent("admin", []);
		}
		else
		{
			return Render::renderContent("login", []);
		}
	}

	public static function isAuthorized(): bool
	{
		session_start();
		if (!isset($_SESSION['userHash']))
		{
			return false;
		}
		else
		{
			$user = UserService::getUserByHash(Database::getDatabase(), $_SESSION['userHash']);
			if ($_SESSION['userHash'] === $user->getUserHash())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public static function Authorized(): string
	{
		$validateLogin = $_POST['login'];
		$validatePassword = $_POST['password'];

		$user = UserService::getUserByLogin(Database::getDatabase(), $validateLogin);
		if (!isset($user))
		{
			return Render::render("login", []);
		}
		else
		{
			$isCorrectPassword = password_verify($validatePassword, $user->getPassword());
			if (!$isCorrectPassword)
			{
				return Render::render("login", []);
			}
			else
			{
				$userHash = Helper::generateUserHash();
				UserService::setUserHash(Database::getDatabase(), $user->getId(), $userHash);
				Helper::setAuthorized($user->getId(), $userHash);
				return ExcursionController::showAdminExcursionList();
			}
		}
	}

}
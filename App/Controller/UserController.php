<?php

namespace App\Controller;

use App\Service\UserService;
use App\Config\Database;
use App\Lib\Helper;
use App\Service\ExcursionService;
use App\Lib\Render;

class UserController
{

	public static function loginUser():string
	{
		return Render::renderContent("login", []);
	}

	public static function logOutUser():string
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		return Render::renderContent("logout", []);
	}

	public static function adminPanel():string
	{
		if (self::isAuthorized()==true)
		{
			return Render::renderContent("admin", []);
		}
		else
		{
			return Render::renderContent("login", []);
		}
	}

	public static function isAuthorized():bool
	{
		session_start();
		if (!isset($_SESSION['userHash']))
		{
			return false;
		}
		else
		{
			$user = UserService::getUserByHash(Database::getDatabase(),$_SESSION['userHash']);
			if ($_SESSION['userHash']==$user->getUserHash())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public static function Authorized():string
	{
		$validateLogin = $_POST['login'];
		$validatePassword = $_POST['password'];



		$user = UserService::getUserByLogin(Database::getDatabase(),$validateLogin);
		if (!isset($user))
		{
			return Render::render("login", []);
		}
		else
		{
			$passwordHash = Helper::getPasswordHash($user->getLogin(),$validatePassword,$user->getEmail());
			if ($user->getPassword()!=$passwordHash)
			{
				return Render::render("login", []);
			}
			else
			{
				$userHash = Helper::generateUserHash();
				UserService::setUserHash(Database::getDatabase(),$user->getId(),$userHash);
				Helper::setAuthorized($user->getId(),$userHash);
				return self::showAdminExcursionList();
			}
		}

	}

	public static function showAdminExcursionList(): string
	{
		# Переделать метод получения экскурсий
		if(self::isAuthorized()){
			$excursions = ExcursionService::getAllExcursionsByPage(Database::getDatabase());
			$content = Render::renderContent("admin-excursions-list", ["excursions" => $excursions]);
			return Render::renderAdminMenu($content);
		}else{
			header("Location: http://eshop/login");
			return '';
		}


	}
}
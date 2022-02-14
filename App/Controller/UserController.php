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
		return Render::render("login", []);
	}

	public static function isAuthorized():string
	{
		$user = UserService::getUserByHash(Database::getInstance()->connect());
	}

	public static function Authorized():string
	{
		$validateLogin = $_POST['login'];
		$validatePassword = $_POST['password'];
		$user = UserService::getUserByLogin(Database::getInstance()->connect(),$validateLogin);
		if (!isset($user))
		{
			return var_dump("Fail auth");
		}
		else
		{
			$passwordHash = Helper::getPasswordHash($user->getLogin(),$validatePassword,$user->getEmail());
			if ($user->password!=$passwordHash)
			{
				return var_dump("Fail auth");
			}
			else
			{
				$userHash = Helper::generateUserHash();
				UserService::setUserHash(Database::getInstance()->connect(),$user->getId(),$userHash);
				Helper::setAuthorized($user->getId(),$userHash);
				return var_dump("Success auth");
			}
		}

	}
}
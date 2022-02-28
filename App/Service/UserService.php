<?php

namespace App\Service;

use App\Entity\User;
use App\Lib\UserDBQuery;
use mysqli;

class UserService
{

	public static function parseUserForAdminPage(\mysqli_result $result) : User
	{
		$user = mysqli_fetch_assoc($result);

		return
			new User(
				$user['id'],
				$user['login'],
				$user['password'],
				$user['userHash'],
				$user['email'],
				$user['isAdmin'],
				$user['dateCreate'],
				$user['dateUpdate']
			);
	}

	public static function getUserByLogin(mysqli $db, string $login): User
	{
		$query = UserDBQuery::getUserByLogin();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseUserForAdminPage($result);
	}

	public static function getUserById(mysqli $db, int $id): User
	{
		$query = UserDBQuery::getUserById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseUserForAdminPage($result);
	}

	public static function getUserByHash(mysqli $db, string $hash): User
	{
		$query = UserDBQuery::getUserByHash();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $hash);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseUserForAdminPage($result);
	}

	public static function setUserHash(mysqli $db, int $id, string $userHash): void
	{
		$query = UserDBQuery::setUserHash();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $userHash, $id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function setPassword(mysqli $db, int $id, string $password): void
	{
		$query = UserDBQuery::setPassword();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $password, $id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}
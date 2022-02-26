<?php

namespace App\Service;

use App\Entity\User;
use mysqli;

class UserService
{

	public static function getUserByLogin(mysqli $db, string $login): User
	{
		$validateLogin = mysqli_real_escape_string($db,$login);
		$query = "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE LOGIN='{$validateLogin}' LIMIT 1
		";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$user = mysqli_fetch_assoc($result);

		$resultUser = new User(
			$user['id'],
			$user['login'],
			$user['password'],
			$user['userHash'],
			$user['email'],
			$user['isAdmin'],
			$user['dateCreate'],
			$user['dateUpdate']
		);

		return $resultUser;
	}

	public static function getUserById(mysqli $db, int $id): User
	{
		$query = "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE ID='{$id} ' LIMIT 1
		";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$user = mysqli_fetch_assoc($result);
		$resultUser = new User(
			$user['id'],
			$user['login'],
			$user['password'],
			$user['userHash'],
			$user['email'],
			$user['isAdmin'],
			$user['dateCreate'],
			$user['dateUpdate']
		);

		return $resultUser;
	}

	public static function getUserByHash(mysqli $db, string $hash): User
	{
		$query = "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE USER_HASH='{$hash} ' LIMIT 1
		";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$user = mysqli_fetch_assoc($result);
		$resultUser = new User(
			$user['id'],
			$user['login'],
			$user['password'],
			$user['userHash'],
			$user['email'],
			$user['isAdmin'],
			$user['dateCreate'],
			$user['dateUpdate']
		);

		return $resultUser;
	}

	public static function setUserHash(mysqli $db, int $id, string $userHash): void
	{
		$query = "UPDATE up_user SET USER_HASH='{$userHash}' WHERE ID={$id};";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function setPassword(mysqli $db, int $id, string $password): void
	{
		$query = "UPDATE up_user SET PASSWORD='{$password}' WHERE ID={$id};";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}
<?php

namespace App\Config;

class Config
{
	protected $user;
	protected $host;
	protected $username;
	protected $password;
	protected $db_name;

	public function __construct()
	{
		$ini = parse_ini_file('config.ini');
		$this->user = $ini['user'];
		$this->host = $ini['host'];
		$this->username = $ini['username'];
		$this->password = $ini['password'];
		$this->db_name = $ini['db_name'];
	}

	// получение соединения с базой данных
	public function dbConnect()
	{

		$database = mysqli_init();
		$connectionResult = mysqli_real_connect(
			$database,
			$this->host,
			$this->username,
			$this->password,
			$this->db_name
		);

		if (!$connectionResult)
		{
			$error = mysqli_connect_errno() . ": " . mysqli_connect_error();
			trigger_error($error, E_USER_ERROR);
		}

		$result = mysqli_set_charset($database, 'utf8');
		if (!$result)
		{
			trigger_error(mysqli_error($database), E_USER_ERROR);
		}

		return $database;
	}
}
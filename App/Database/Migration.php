<?php

namespace App\Database;

use mysqli;

class Migration
{
	public $table = 'up_migration';
	public $path = 'Migrations';

	private $pathDir;
	private $db;

	public function __construct(mysqli $db)
	{
		$this->pathDir = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/');
		$this->db = $db;
		$this->checkEnvironment();
	}

	public function checkEnvironment()
	{
		if (!file_exists($this->pathDir.$this->path))
		{
			mkdir($this->pathDir.$this->path);
		}
		$this->executeDB('CREATE TABLE IF NOT EXISTS ' . $this->table . ' (`ID` int not null auto_increment, `FILE_MIGRATION` varchar(500) not null, PRIMARY KEY (ID)) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
	}

	public function up()
	{
		$this->getMigrationFiles();
	}

	private function getMigrationFiles()
	{
		$fileMigrationListInFolder = glob($this->pathDir.$this->path. '*.sql');
		print_r($fileMigrationListInFolder);
		$fileMigrationListInBD = $this->queryDB('SELECT FILE_MIGRATION FROM up_migration;');
		if (!$fileMigrationListInBD)
		{

		}
		else
		{

		}
	}

	private function executeCommandShell()
	{
		//
	}

	private function executeDB($query)
	{
		$result = mysqli_query($this->db, $query);
		if (!$result)
		{
			trigger_error(mysqli_error($this->db), E_USER_ERROR);
		}
	}

	private function queryDB($query): array
	{
		$result = mysqli_query($this->db, $query);
		if (!$result)
		{
			trigger_error(mysqli_error($this->db), E_USER_ERROR);
		}
		$fileMigrationList = [];
		while ($fileMigration = mysqli_fetch_assoc($result))
		{
			$fileMigrationList[]=$fileMigration['FILE_MIGRATION'];
		}
		return $fileMigrationList;
	}
}
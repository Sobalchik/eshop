<?php

namespace App\Database;

use mysqli;

class Migration
{
	public $table = 'up_migration';
	public $path = 'Migrations';
	protected $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
		$this->checkEnvironment();
	}

	public function checkEnvironment()
	{
		if (!file_exists(str_replace('\\', '/', realpath(dirname(__FILE__)) . '/').$this->path))
		{
			mkdir(str_replace('\\', '/', realpath(dirname(__FILE__)) . '/').$this->path);
		}
		$this->executeDB('CREATE TABLE IF NOT EXISTS ' . $this->table . ' (`ID` int not null auto_increment, `FILE_MIGRATION` varchar(500) not null, PRIMARY KEY (ID)) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
	}

	public function getMigrationFiles()
	{
		//
	}

	public function up()
	{
		//
	}

	private function executeDB($query)
	{
		$result = mysqli_query($this->db, $query);
	}
}
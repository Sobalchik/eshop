<?php

namespace App\Database;

use App\Config\Database;
use mysqli;

class Migration
{
	protected $table = 'up_migration';
	protected $path = 'Migrations';
	protected $pathDir;
	protected $db;

	const pathIniFile = '/App/Config/config.ini';

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
		$fileMigrationList = $this->getMigrationFiles();
		if (!$fileMigrationList)
		{
			return false;
		}
		else
		{
			$this->executeCommandShell($fileMigrationList);
		}
	}

	private function getMigrationFiles():array
	{
		$fileMigrationListInFolder = $this->getFileMigrationListInFolder();
		$fileMigrationListInBD = $this->queryDB('SELECT FILE_MIGRATION FROM up_migration;');
		if (!$fileMigrationListInBD)
		{
			$fileMigrationList = $fileMigrationListInFolder;
		}
		else
		{
			$fileMigrationList = array_diff($fileMigrationListInFolder, $fileMigrationListInBD);
		}
		return $fileMigrationList;
	}

	private function getFileMigrationListInFolder():array
	{
		$filesMigration = array_diff( scandir( $this->pathDir.$this->path ), Array( ".", ".." ) );
		$fileMigrationListInFolder = [];
		foreach ($filesMigration as $fileMigration)
		{
			if (stripos($fileMigration,'.sql'))
			{
				$fileMigrationListInFolder[]=$fileMigration;
			}
		}
		return $fileMigrationListInFolder;
	}

	private function executeCommandShell($fileMigrationList)
	{
		$ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'].self::pathIniFile);
		foreach ($fileMigrationList as $fileMigration)
		{
			$command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $ini['username'], $ini['password'], $ini['host'], $ini['db_name'], $this->pathDir.$this->path.'/'.$fileMigration);
			shell_exec($command);
			$this->executeDB("INSERT INTO up_migration (`FILE_MIGRATION`) VALUES ('".$fileMigration."')");
		}

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
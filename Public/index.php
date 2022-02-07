<?php

use App\Config\Database;

require "../App/autoload.php";
require '../App/routes.php';

$db = App\Config\Database::getInstance();
$db->connect();

$migration = new \App\Database\Migration(Database::getInstance()->connect());
$migration->up();

$response = App\Lib\Application::run();
$response->flush();

<?php

require "../App/autoload.php";
require '../App/routes.php';

$db = App\Config\Database::getInstance();
$db->connect();

$response = App\Lib\Application::run();
$response->flush();

<?php

\App\Lib\Router::add(
	"GET",
	"/public/index.php",
	[\App\Controller\Controller::class,'view']);

\App\Lib\Router::add(
	"GET",
	"/Public/index.php",
	[\App\Controller\Controller::	class,'view']);
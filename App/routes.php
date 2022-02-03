<?php

\App\Lib\Router::add(
	"GET",
	"/Public/index",
	[\App\Controller\MainController::class,'showAllExcursion']);

\App\Lib\Router::add(
	"GET",
	"/Public/placeholder",
	[\App\Controller\MainController::class,'showPlaceHolder']);


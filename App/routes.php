<?php

\App\Lib\Router::add(
	"GET",
	"/Public/index",
	[\App\Controller\MainController::class,'showAllExcursion']);


<?php

use App\Controller\MainController;
use App\Controller\UserController;
use App\Lib\Router;

Router::add(
	"GET",
	"/",
	[MainController::class, 'showTopExcursions']
);

Router::add(
	"GET",
	"/excursion/:id",
	[MainController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/excursion/:id",
	[MainController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/:page",
	[MainController::class, 'showAllExcursions']
);

Router::add(
	"POST",
	"/createOrder",
	[MainController::class, 'createOrder']
);

Router::add(
	"GET",
	"/login",
	[UserController::class, 'loginUser']
);

Router::add(
	"POST",
	"/auth",
	[UserController::class, 'Authorized']
);

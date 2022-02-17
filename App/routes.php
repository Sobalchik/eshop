<?php

use App\Controller\ExcursionController;
use App\Controller\UserController;
use App\Controller\OrderController;
use App\Lib\Router;

Router::add(
	"GET",
	"/",
	[ExcursionController::class, 'showTopExcursions']
);

Router::add(
	"GET",
	"/excursion/:id",
	[ExcursionController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/excursion/:id",
	[ExcursionController::class, 'showExcursionById']
);

Router::add(
	"GET",
	"/allExcursions/:page",
	[ExcursionController::class, 'showAllExcursions']
);

Router::add(
	"POST",
	"/createOrder",
	[OrderController::class, 'createOrder']
);

Router::add(
	"GET",
	"/login",
	[UserController::class, 'loginUser']
);

Router::add(
	"GET",
	"/logout",
	[UserController::class, 'logOutUser']
);

Router::add(
	"POST",
	"/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"GET",
	"/admin",
	[UserController::class, 'adminPanel']
);

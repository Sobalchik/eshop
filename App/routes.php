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
	"/admin/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"POST",
	"/admin/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"POST",
	"/admin/excursions/saved",
	[ExcursionController::class, 'editExcursion']
);

Router::add(
	"GET",
	"/admin/excursions",
	[ExcursionController::class, 'showAdminExcursionList']
);

Router::add(
	"GET",
	"/admin",
	[UserController::class, 'adminPanel']
);

Router::add(
	"GET",
	"/admin/detailed?id=:id",
	[ExcursionController::class, 'showAdminExcursionById']

);

Router::add(
	"GET",
	"/admin/orders",
	[OrderController::class, 'showAdminOrders']
);
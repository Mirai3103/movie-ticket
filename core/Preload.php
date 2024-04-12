<?php

use App\Core\Database\Database;
use App\Core\Logger;
use App\Services\SeatService;

$GLOBALS['config'] = require 'config.php';

Database::init_db();
Router::load_from_class(HomeController::class);
Router::load_from_class(PayController::class);
Router::load_from_class(UserController::class);
Router::load_from_class(DashboardController::class);
Router::load_from_class(CheckoutController::class);
Router::load_from_class(RoomController::class);
Router::load_from_class(CinemaController::class);
Router::load_from_class(SeatController::class);
Router::load_from_class(StatusController::class);
Router::load_from_class(MovieController::class);
Router::build();
function exception_handler(Throwable $exception)
{
    Logger::error($exception->getMessage());
    Logger::error($exception->getTraceAsString());
}

set_exception_handler('exception_handler');
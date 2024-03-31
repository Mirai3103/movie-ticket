<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'AcctionMap' => $baseDir . '/core/ControllerMap.php',
    'App\\Core\\Database\\Connection' => $baseDir . '/core/database/Connection.php',
    'App\\Core\\Database\\Database' => $baseDir . '/core/database/Database.php',
    'App\\Core\\Request' => $baseDir . '/core/Request.php',
    'App\\Models\\JsonDataErrorRespose' => $baseDir . '/app/models/Response.php',
    'App\\Models\\JsonResponse' => $baseDir . '/app/models/Response.php',
    'App\\Models\\Permission' => $baseDir . '/app/models/Permision.php',
    'App\\Models\\TrangThaiPhim' => $baseDir . '/app/models/Enum.php',
    'App\\Models\\TrangThaiPhong' => $baseDir . '/app/models/Enum.php',
    'App\\Models\\TrangThaiVe' => $baseDir . '/app/models/Enum.php',
    'App\\Services\\AccountType' => $baseDir . '/app/services/UserService.php',
    'App\\Services\\CinemaService' => $baseDir . '/app/services/CinemaService.php',
    'App\\Services\\Payments\\Models\\CreatePaymentResponse' => $baseDir . '/app/services/payments/models/CreatePaymentResponse.php',
    'App\\Services\\Payments\\MomoPaymentStrategy' => $baseDir . '/app/services/payments/MomoStrategy.php',
    'App\\Services\\Payments\\PaymentStrategy' => $baseDir . '/app/services/payments/PaymentStrategy.php',
    'App\\Services\\Payments\\ZaloPayStrategy' => $baseDir . '/app/services/payments/ZaloPayStrategy.php',
    'App\\Services\\PermissionService' => $baseDir . '/app/services/PermissionService.php',
    'App\\Services\\PhimService' => $baseDir . '/app/services/PhimService.php',
    'App\\Services\\RoomService' => $baseDir . '/app/services/RoomService.php',
    'App\\Services\\SeatService' => $baseDir . '/app/services/SeatService.php',
    'App\\Services\\SeatTypeService' => $baseDir . '/app/services/SeatTypeService.php',
    'App\\Services\\StatusService' => $baseDir . '/app/services/StatusService.php',
    'App\\Services\\UserService' => $baseDir . '/app/services/UserService.php',
    'CheckoutController' => $baseDir . '/app/controllers/CheckoutController.php',
    'CinemaController' => $baseDir . '/app/controllers/admin/CinemaController.php',
    'ComposerAutoloaderInit7d8cde7a46b174acd021ce9a6503a48a' => $vendorDir . '/composer/autoload_real.php',
    'Composer\\Autoload\\ClassLoader' => $vendorDir . '/composer/ClassLoader.php',
    'Composer\\Autoload\\ComposerStaticInit7d8cde7a46b174acd021ce9a6503a48a' => $vendorDir . '/composer/autoload_static.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'ControllerMap' => $baseDir . '/core/ControllerMap.php',
    'Core\\Attributes\\Controller' => $baseDir . '/core/attributes/ControllerAttribute.php',
    'Core\\Attributes\\Route' => $baseDir . '/core/attributes/RouteAtributte.php',
    'DashboardController' => $baseDir . '/app/controllers/admin/DashboardController.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'PayController' => $baseDir . '/app/controllers/PayController.php',
    'PaymentType' => $baseDir . '/app/services/payments/index.php',
    'RoomController' => $baseDir . '/app/controllers/admin/RoomController.php',
    'Router' => $baseDir . '/core/Router.php',
    'SeatTypeController' => $baseDir . '/app/controllers/SeatTypeController.php',
    'StatusController' => $baseDir . '/app/controllers/StatusController.php',
    'UserController' => $baseDir . '/app/controllers/UserController.php',
);

<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d8cde7a46b174acd021ce9a6503a48a
{
    public static $files = array (
        '5ec26a44593cffc3089bdca7ce7a56c3' => __DIR__ . '/../..' . '/core/helpers.php',
    );

    public static $classMap = array (
        'AcctionMap' => __DIR__ . '/../..' . '/core/ControllerMap.php',
        'App\\Core\\Database\\Connection' => __DIR__ . '/../..' . '/core/database/Connection.php',
        'App\\Core\\Database\\Database' => __DIR__ . '/../..' . '/core/database/Database.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'App\\Models\\JsonDataErrorRespose' => __DIR__ . '/../..' . '/app/models/Response.php',
        'App\\Models\\JsonResponse' => __DIR__ . '/../..' . '/app/models/Response.php',
        'App\\Models\\Permission' => __DIR__ . '/../..' . '/app/models/Permision.php',
        'App\\Models\\TrangThaiPhim' => __DIR__ . '/../..' . '/app/models/Enum.php',
        'App\\Models\\TrangThaiPhong' => __DIR__ . '/../..' . '/app/models/Enum.php',
        'App\\Models\\TrangThaiVe' => __DIR__ . '/../..' . '/app/models/Enum.php',
        'App\\Services\\AccountType' => __DIR__ . '/../..' . '/app/services/UserService.php',
        'App\\Services\\CinemaService' => __DIR__ . '/../..' . '/app/services/CinemaService.php',
        'App\\Services\\Payments\\Models\\CreatePaymentResponse' => __DIR__ . '/../..' . '/app/services/payments/models/CreatePaymentResponse.php',
        'App\\Services\\Payments\\MomoPaymentStrategy' => __DIR__ . '/../..' . '/app/services/payments/MomoStrategy.php',
        'App\\Services\\Payments\\PaymentStrategy' => __DIR__ . '/../..' . '/app/services/payments/PaymentStrategy.php',
        'App\\Services\\Payments\\ZaloPayStrategy' => __DIR__ . '/../..' . '/app/services/payments/ZaloPayStrategy.php',
        'App\\Services\\PermissionService' => __DIR__ . '/../..' . '/app/services/PermissionService.php',
        'App\\Services\\PhimService' => __DIR__ . '/../..' . '/app/services/PhimService.php',
        'App\\Services\\RoomService' => __DIR__ . '/../..' . '/app/services/RoomService.php',
        'App\\Services\\SeatService' => __DIR__ . '/../..' . '/app/services/SeatService.php',
        'App\\Services\\SeatTypeService' => __DIR__ . '/../..' . '/app/services/SeatTypeService.php',
        'App\\Services\\StatusService' => __DIR__ . '/../..' . '/app/services/StatusService.php',
        'App\\Services\\UserService' => __DIR__ . '/../..' . '/app/services/UserService.php',
        'CheckoutController' => __DIR__ . '/../..' . '/app/controllers/CheckoutController.php',
        'CinemaController' => __DIR__ . '/../..' . '/app/controllers/admin/CinemaController.php',
        'ComposerAutoloaderInit7d8cde7a46b174acd021ce9a6503a48a' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit7d8cde7a46b174acd021ce9a6503a48a' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ControllerMap' => __DIR__ . '/../..' . '/core/ControllerMap.php',
        'Core\\Attributes\\Controller' => __DIR__ . '/../..' . '/core/attributes/ControllerAttribute.php',
        'Core\\Attributes\\Route' => __DIR__ . '/../..' . '/core/attributes/RouteAtributte.php',
        'DashboardController' => __DIR__ . '/../..' . '/app/controllers/admin/DashboardController.php',
        'HomeController' => __DIR__ . '/../..' . '/app/controllers/HomeController.php',
        'PayController' => __DIR__ . '/../..' . '/app/controllers/PayController.php',
        'PaymentType' => __DIR__ . '/../..' . '/app/services/payments/index.php',
        'RoomController' => __DIR__ . '/../..' . '/app/controllers/admin/RoomController.php',
        'Router' => __DIR__ . '/../..' . '/core/Router.php',
        'SeatTypeController' => __DIR__ . '/../..' . '/app/controllers/SeatTypeController.php',
        'StatusController' => __DIR__ . '/../..' . '/app/controllers/StatusController.php',
        'UserController' => __DIR__ . '/../..' . '/app/controllers/UserController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit7d8cde7a46b174acd021ce9a6503a48a::$classMap;

        }, null, ClassLoader::class);
    }
}

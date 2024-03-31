<?php

use App\Models\JsonResponse;
use App\Services\CinemaService;
use App\Services\RoomService;
use App\Services\SeatTypeService;
use App\Services\StatusService;
use Core\Attributes\Controller;
use Core\Attributes\Route;

class RoomController
{
    #[Route("/admin/phong-chieu", "GET")]
    public static function index()
    {
        $results = RoomService::getAllRooms($_GET);
        $cinemas = CinemaService::getAllCinemas();
        return view("admin/room/index", [
            'rooms' => $results['rooms'],
            'total' => $results['total'],
            'cinemas' => $cinemas
        ]);
    }
    #[Route("/api/phong-chieu", "GET")]
    public static function getRooms()
    {
        $results = RoomService::getAllRooms($_GET);
        header("X-Total-Count: " . $results['total']);
        return json(JsonResponse::ok($results['rooms']));
    }

    #[Route("/admin/phong-chieu/them", "GET")]
    public static function create()
    {
        $cinemas = CinemaService::getAllCinemas();
        $status = StatusService::getAllStatus('PhongChieu');
        $seatTypes = SeatTypeService::getAllSeatType();
        return view("admin/room/create", [
            'cinemas' => $cinemas,
            'statuses' => $status,
            'seatTypes' => $seatTypes
        ]);
    }
    #[Route("/api/phong-chieu", "POST")]
    public static function createRoom()
    {
        $data = request_body();
        $result = RoomService::createRoom($data);
        return json($result);
    }

}
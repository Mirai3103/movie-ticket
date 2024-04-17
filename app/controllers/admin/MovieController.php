<?php

use App\Models\JsonDataErrorRespose;
use App\Models\JsonResponse;
use App\Services\CategoryService;
use App\Services\CinemaService;
use App\Services\PhimService;
use App\Services\RoomService;
use App\Services\ShowService;
use App\Services\StatusService;
use Core\Attributes\Controller;
use Core\Attributes\Route;

class MovieController
{

    #[Route("/api/phim/tim-kiem-nang-cao", "POST")]
    public static function advancedSearch()
    {
        $data = request_body();
        $phims = ShowService::advanceSearch($data) ?? [];
        return json(JsonResponse::ok($phims));
    }
    #[Route("/api/phim", "GET")]
    public static function search()
    {
        $query = $_GET;
        $phims = PhimService::getTatCaPhim($query);
        return json(JsonResponse::ok($phims));
    }
    #[Route(path: '/admin/phim', method: 'GET')]
    public static function index()
    {
        $phimStatuses = StatusService::getAllStatus("Phim");
        return view(
            'admin/movie/index',
            ['phimStatuses' => $phimStatuses]
        );
    }
    #[Route(path: '/admin/phim/them', method: 'GET')]
    public static function add()
    {
        $phimStatuses = StatusService::getAllStatus("Phim");
        $categories = CategoryService::getAllCategories();
        return view('admin/movie/add', ['phimStatuses' => $phimStatuses, 'categories' => $categories]);
    }
    #[Route(path: '/admin/phim/them', method: 'POST')]
    public static function save()
    {
        $data = request_body();
        $result = PhimService::createMovie($data);
        if ($result) {
            return JsonResponse::ok([
                "MaPhim" => $result
            ]);
        } else {
            return json(JsonResponse::error("Thêm phim thất bại"));
        }
    }
}
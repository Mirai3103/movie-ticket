<?php

namespace App\Models;

enum TrangThaiPhim: int
{
    case DangChieu = 1;
    case SapChieu = 2;
    case SapKhoiChieu = 3;
}

enum TrangThaiVe: int
{
    case DaDat = 4;
    case ChuaDat = 5;
}

<?php
namespace App\Services;

use App\Core\Database\Database;
use App\Models\JsonResponse;
use App\Models\TrangThaiVe;

class TicketService
{

    public static function isSeatLocked($seatId, $showId)
    {
        $ticket = Database::queryOne("SELECT * FROM Ve WHERE MaGhe = ? AND MaSuatChieu = ?", [$seatId, $showId]);
        // KhoaDen	type = timestamp	
        $trangThai = $ticket['TrangThai'];
        if ($trangThai == TrangThaiVe::DaDat) {
            return true;
        }
        if ($ticket['KhoaDen'] == null)
            return false;
        $now = time();
        $lockTime = strtotime($ticket['KhoaDen']);
        return $now < $lockTime;
    }

    public static function isAnySeatsLocked($seatIds, $showId)
    {
        $seatIds = implode(",", $seatIds);
        $tickets = Database::query("SELECT * FROM Ve WHERE MaGhe IN ($seatIds) AND MaSuatChieu = ?", [$showId]);
        $now = time();
        foreach ($tickets as $ticket) {
            // check if TrangThai = 4
            $trangThai = $ticket['TrangThai'];
            if ($trangThai == TrangThaiVe::DaDat) {
                return true;
            }
            if ($ticket['KhoaDen'] == null)
                continue;
            $lockTime = strtotime($ticket['KhoaDen']);
            if ($now < $lockTime) {
                return true;
            }
        }
        return false;
    }



    public static function lockTicket($ticketId)
    {
        $lockTime = time() + getArrayValueSafe($GLOBALS['config'], 'ticket_lock_time', 10) * 60;
        Database::execute("UPDATE Ve SET KhoaDen = ? WHERE id = ?", [date('Y-m-d H:i:s', $lockTime), $ticketId]);
        return $lockTime;
    }
    public static function lockSeats($seatIds, $showId)
    {
        $seatIds = implode(",", $seatIds);
        $lockTime = time() + getArrayValueSafe($GLOBALS['config'], 'ticket_lock_time', 10) * 60;
        Database::execute("UPDATE Ve SET KhoaDen = ? WHERE MaGhe IN ($seatIds) AND MaSuatChieu = ?", [date('Y-m-d H:i:s', $lockTime), $showId]);
        return $lockTime;
    }

    public static function getAllTicketsOfShow($showId)
    {
        return Database::query("SELECT * FROM Ve WHERE MaSuatChieu = ?", [$showId]);
    }

    public static function getTicketOfSeats($seatIds, $showId)
    {
        $seatIds = implode(",", $seatIds);
        $sql = "SELECT
        Ve.*,
        LoaiVe.TenLoaiVe
        FROM Ve JOIN LoaiVe ON Ve.MaLoaiVe = LoaiVe.MaLoaiVe
        WHERE Ve.MaSuatChieu = ? AND Ve.MaGhe IN ($seatIds)";
        return Database::query($sql, [$showId]);
    }


    public static function getTicketTypes()
    {
        return Database::query("SELECT * FROM LoaiVe", []);
    }

    public static function createNewTicketType($data)
    {
        $params = [
            'MaLoaiVe' => $data['MaLoaiVe'],
            'TenLoaiVe' => $data['TenLoaiVe'],
            'GiaVe' => $data['GiaVe'],
            'MoTa' => $data['MoTa'],
            //   'TrangThai' => $data['TrangThai'] ?? TrangThai::DangHoatDong->value,
            'Rong' => $data['Rong']
        ];
        $result = Database::insert('LoaiVe', $params);
        if ($result) {
            return JsonResponse::ok();
        }
        return JsonResponse::error('Thêm mới thất bại', 500);
    }

    public static function updateTicketType($data, $id)
    {
        $params = [
            'TenLoaiVe' => $data['TenLoaiVe'],
            'GiaVe' => $data['GiaVe'],
            'MoTa' => $data['MoTa'],
            //      'TrangThai' => $data['TrangThai'] ?? TrangThai::DangHoatDong->value,
            'Rong' => $data['Rong']
        ];
        $result = Database::update('LoaiVe', $params, "MaLoaiVe=$id");
        if ($result) {
            return JsonResponse::ok();
        }
        return JsonResponse::error('Cập nhật thất bại', 500);
    }

    public static function deleteTicketType($id)
    {
        $result = Database::delete('LoaiVe', "MaLoaiVe=$id");
        if ($result) {
            return JsonResponse::ok();
        }
        return JsonResponse::error('Xóa thất bại', 500);
    }
}
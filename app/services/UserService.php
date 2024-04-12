<?php

namespace App\Services;

use App\Core\Database\Database;
use App\Core\Logger;
use App\Models\JsonDataErrorRespose;
use App\Models\JsonResponse;

enum AccountType: int
{
    case Employee = 1;
    case Customer = 2;
}
class UserService
{
    public static function isMailExist($email)
    {
        $query = "SELECT * FROM NguoiDung WHERE Email = ?;";
        $user = Database::queryOne($query, [$email]);
        return $user ? true : false;
    }
    public static function getUserByEmail($email)
    {
        $query = "SELECT * FROM NguoiDung WHERE Email = ?;";
        $user = Database::queryOne($query, [$email]);
        return $user;
    }

    public static function register($data)
    {
        $email = $data['email'];
        $isMailExist = self::isMailExist($email);
        if ($isMailExist) {
            return JsonDataErrorRespose::create(["email" => "Email đã tồn tại"]);
        }
        $id = Database::insert(
            "NguoiDung",
            [
                "TenNguoiDung" => $data['fullname'],
                "Email" => $data['email'],
                "NgaySinh" => $data['dateOfBirth']
            ]
        );
        if (!$id) {
            return new JsonResponse(500, "Đăng ký thất bại");
        }
        $idTaiKhoan = Database::insert(
            "TaiKhoan",
            [
                "TenDangNhap" => $data['email'],
                "MatKhau" => $data['password'],
                "LoaiTaiKhoan" => AccountType::Customer->value,
                "MaNguoiDung" => $id,
            ]
        );
        if (!$idTaiKhoan) {
            return new JsonResponse(500, "Đăng ký thất bại");
        }
        return new JsonResponse(200, "Đăng ký thành công");
    }
    private static function setSession($user)
    {
        $_SESSION['user'] = $user;
    }
    private static function rememberLogin($user)
    {
        $secretKey = $GLOBALS['config']['Auth']['secret'];
        $rememberTime = $GLOBALS['config']['Auth']['remember_time_in_days'];
        $userId = $user['MaNguoiDung'];
        $rawHash = "$userId";
        $hash = hash_hmac('sha256', $rawHash, $secretKey);
        $cookieValue = "$userId|$hash";
        setcookie(
            "remember",
            $cookieValue,
            time() + 60 * 60 * 24 * $rememberTime
        );

    }
    public static function logout()
    {
        unset($_SESSION['user']);
        setcookie("remember", "", time() - 3600, '/');
    }
    public static function login($username, $password, $rememberMe = false)
    {

        $query = "SELECT MaTaiKhoan, TrangThai,LoaiTaiKhoan,MaNhomQuyen FROM TaiKhoan WHERE TenDangNhap = ? AND MatKhau = ?;";
        $account = Database::queryOne($query, [$username, $password]);
        if (!$account) {
            return new JsonResponse(401, "Sai tên đăng nhập hoặc mật khẩu");
        }
        $userInfor = self::getUserByEmail($username);
        $userInfor['TaiKhoan'] = $account;

        self::setSession($userInfor);
        if ($rememberMe) {
            self::rememberLogin($userInfor);
        }
        return new JsonResponse(200, "Đăng nhập thành công", $userInfor);
    }
    public static function recoverAuth()
    {
        if (isset($_SESSION['user'])) {
            return;
        }
        if (isset($_COOKIE['remember'])) {
            $cookieValue = $_COOKIE['remember'];
            $secretKey = $GLOBALS['config']['Auth']['secret'];
            $parts = explode('|', $cookieValue);
            if (count($parts) !== 2) {
                return;
            }
            $userId = $parts[0];
            $hash = $parts[1];
            $rawHash = "$userId";
            $expectedHash = hash_hmac('sha256', $rawHash, $secretKey);
            if ($hash === $expectedHash) {
                $query = "SELECT * FROM NguoiDung WHERE MaNguoiDung = ?;";
                $user = Database::queryOne($query, [$userId]);

                if ($user) {
                    $query = "SELECT MaTaiKhoan, TrangThai,LoaiTaiKhoan,MaNhomQuyen FROM TaiKhoan WHERE MaNguoiDung = ?;";
                    $account = Database::queryOne($query, [$userId]);
                    $user['TaiKhoan'] = $account;
                    self::setSession($user);
                }
            }
        }
    }
}
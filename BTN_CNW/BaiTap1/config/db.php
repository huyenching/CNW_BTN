<?php
class Database {
    private static $instance = null; // Biến static để giữ instance duy nhất của PDO

    // Phương thức kết nối và trả về instance PDO
    public static function connect() {
        if (self::$instance === null) { // Kiểm tra nếu chưa tồn tại kết nối
            try {
                $dsn = "mysql:host=localhost;dbname=tintuc1;charset=utf8";
                $username = "root";
                $password = ""; 
                // Tạo kết nối PDO
                self::$instance = new PDO($dsn, $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
            }
        }
        return self::$instance; // Trả về instance PDO duy nhất
    }

}

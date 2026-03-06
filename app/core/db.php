<?php
class Database
{
    // Thông tin cấu hình (Bạn có thể chuyển các giá trị này ra file config.php sau này)
    private $host = "localhost";
    private $db_name = "db_quanly_cv"; // Thay bằng tên DB của bạn
    private $username = "root";              // Mặc định là root trên XAMPP
    private $password = "";                  // Mặc định là rỗng
    private $conn;

    /**
     * Tạo kết nối PDO tới MySQL
     * @return PDO|null
     */
    public function getConnection()
    {
        $this->conn = null;

        try {
            // DSN - Data Source Name
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Báo lỗi chi tiết khi query sai
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,         // Mặc định trả về Object thay vì mảng
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Dùng native prepare để bảo mật tối đa
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Chỉ log lỗi hoặc in thông báo khi đang phát triển
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }

        return $this->conn;
    }
}

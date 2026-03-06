<?php
class task
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getStats()
    {
        $sql = "SELECT 
                SUM(CASE WHEN 1=1 THEN 1 ELSE 0 END) as total,
                SUM(CASE WHEN trang_thai = 'Chưa thực hiện' THEN 1 ELSE 0 END) as chua_thuc_hien,
                SUM(CASE WHEN trang_thai = 'Đã hoàn thành' THEN 1 ELSE 0 END) as hoan_thanh,
                SUM(CASE WHEN trang_thai = 'Quá hạn' THEN 1 ELSE 0 END) as qua_han
            FROM cong_viec";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTasks()
    {
        $sql = "SELECT c.*, u.ho_ten as nguoi_thuc_hien_ten,
            DATEDIFF(CURDATE(), c.han_hoan_thanh) as so_ngay_qua_han
            FROM cong_viec c 
            LEFT JOIN users u ON c.nguoi_thuc_hien_id = u.id 
            ORDER BY FIELD(c.trang_thai, 'Quá hạn', 'Chưa thực hiện', 'Đang thực hiện', 'Đã hoàn thành'), 
                     c.han_hoan_thanh ASC";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }
}

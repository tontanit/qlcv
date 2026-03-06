<?php
require_once "../app/Core/db.php";
require_once "../app/Models/Task.php";

class TaskController
{
    private $db;
    private $taskModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->taskModel = new Task($this->db);
    }

    public function index()
    {
        $db = (new Database())->getConnection();
        $taskModel = new Task($db);

        // Bạn PHẢI lấy dữ liệu từ Model
        $stats = $taskModel->getStats();
        $tasks = $taskModel->getAllTasks();

        // Sau đó mới gọi view, biến $stats sẽ được truyền sang
        require_once "../app/Views/list.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = (new Database())->getConnection();

            $sql = "INSERT INTO cong_viec (ten_cong_viec, mo_ta, han_hoan_thanh, nguoi_thuc_hien_id, trang_thai, created_at) 
                VALUES (:ten, :mo_ta, :han, :user_id, 'Chưa thực hiện', NOW())";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                'ten'    => $_POST['ten_cong_viec'],
                'mo_ta'  => $_POST['mo_ta'],
                'han'    => $_POST['han_hoan_thanh'],
                'user_id' => $_POST['nguoi_thuc_hien_id']
            ]);

            header('Location: list.php?success=1');
        }
    }
}

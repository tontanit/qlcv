<?php
require_once "../app/Core/Router.php";
require_once '../app/Core/Helpers.php';
// Lấy URL từ .htaccess
$url = $_GET['url'] ?? 'task/index';

// Gọi Router xử lý
Router::handle($url);

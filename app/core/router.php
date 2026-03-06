<?php
class Router
{
    public static function handle($url)
    {
        // Tách URL thành mảng: [controller, action, id]
        $params = explode('/', trim($url, '/'));

        // Mặc định là TaskController và hàm index
        $controllerName = ucfirst($params[0] ?? 'Task') . 'Controller';
        $action = $params[1] ?? 'index';

        $controllerPath = "../app/Controllers/$controllerName.php";

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controller = new $controllerName();

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                die("Lỗi: Không tìm thấy phương thức $action");
            }
        } else {
            die("Lỗi: Không tìm thấy Controller $controllerName");
        }
    }
}

<?php
// public/index.php

spl_autoload_register(function ($className) {
    // Danh sách các thư mục chứa class của bạn
    $directories = [
        '../app/Controllers/',
        '../app/Models/',
        '../app/Core/'
    ];

    foreach ($directories as $dir) {
        $filePath = $dir . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

// Sau đó mới gọi Router...
require_once '../app/Core/Router.php';
Router::handle($_GET['url'] ?? 'task/index');

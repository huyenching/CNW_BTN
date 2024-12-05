<?php
require_once '../BaiTap1/config/db.php'; // Kết nối CSDL
require_once '../BaiTap1/Controllers/NewsController.php';
require_once '../BaiTap1/Models/News.php';

// Kết nối cơ sở dữ liệu
$db = Database::connect();

// Khởi tạo controller
$controller = $_GET['controller'] ?? 'news';
$action = $_GET['action'] ?? 'index';

$newsController = new NewsController($db);

if ($controller == 'news' && $action == 'index') {
    $newsController->index();
} elseif ($controller == 'news' && $action == 'detail') {
    $id = $_GET['id'] ?? 0;
    $newsController->detail($id);
} elseif ($controller == 'news' && $action == 'search') {
    $keyword = $_GET['keyword'] ?? '';
    $newsController->search($keyword);
} else {
    echo "Invalid route!";
}

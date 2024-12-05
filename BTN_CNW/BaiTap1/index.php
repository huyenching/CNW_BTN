<?php
require_once 'config/db.php'; // Kết nối CSDL
require_once '../BaiTap1/Controllers/NewsController.php';

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
}

<?php
require_once 'Models/News.php';
require_once 'Servies/NewsService.php';

class NewsController {
    public function detail() {
        $id = $_GET['id'] ?? 0;
        $newsService = new NewsService();
        $news = $newsService->getAllNews();
        require 'Views/admin/news/index.php';
    }
}
?>

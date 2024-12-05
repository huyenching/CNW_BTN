<?php
require_once '../BaiTap1/Models/News.php';

class NewsController {
    private $newsModel;

    public function __construct($db) {
        $this->newsModel = new News($db);
    }

    public function index() {
        $newsList = $this->newsModel->getAllNews();
        include '../BaiTap1/Views/home/index.php';
    }

    public function detail($id) {
        $newsItem = $this->newsModel->getNewsById($id);
        include '../BaiTap1/Views/news/detail.php';
    }

    public function search($keyword) {
        $results = $this->newsModel->searchNews($keyword);
        include '../BaiTap1/Views/news/search.php';
    }
}

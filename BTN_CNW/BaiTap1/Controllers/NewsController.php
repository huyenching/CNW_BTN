<?php
require_once '../Models/News.php';

class NewsController {
    private $newsModel;

    public function __construct($db) {
        $this->newsModel = new News($db);
    }
    public function index() {
        $news = $this->newsModel->getAllNews();
        require_once '../views/home/index.php';
    }

    public function detail($id) {
        $newsDetail = $this->newsModel->getNewsById($id);
        require_once '../views/news/detail.php';
    }

    public function search($keyword) {
        $results = $this->newsModel->searchNews($keyword);
        require_once '../views/news/search.php';
    }
}

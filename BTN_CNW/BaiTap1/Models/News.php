<?php
class News {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllNews() {
        // Correct table name 'news' used here
        $stmt = $this->db->query("SELECT * FROM news ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        // Correct table name 'news' used here
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchNews($keyword) {
        // Correct table name 'news' used here
        $stmt = $this->db->prepare("SELECT * FROM news WHERE title LIKE :keyword OR content LIKE :keyword");
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


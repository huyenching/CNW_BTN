<?php
class New{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllNews() {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchNews($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE title LIKE :keyword OR content LIKE :keyword");
        $searchTerm = "%" . $keyword . "%";
        $stmt->bindParam(':keyword', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


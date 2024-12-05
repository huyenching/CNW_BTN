<?php
require_once 'Models/News.php';
require_once 'config/db.php';

class NewsService {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Kết nối tới CSDL
    }

    public function getAllNews() {
        try {
            $sql = "SELECT * FROM news";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $newsList = [];
            foreach ($result as $row) {
                $news = new News(
                    $row['id'],
                    $row['title'],
                    $row['content'],
                    $row['image'],
                    $row['created_at'],
                    $row['category_id']
                );
                $newsList[] = $news;
            }
            return $newsList;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }


    public function getNewsById($id) {
        try {
            $sql = "SELECT * FROM news WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new News(
                    $row['id'],
                    $row['title'],
                    $row['content'],
                    $row['image'],
                    $row['created_at'],
                    $row['category_id']
                );
            }
            return null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }


    public function addNews($news) {
        try {
            $sql = "INSERT INTO news (title, content, image, created_at, category_id) VALUES (:title, :content, :image, :created_at, :category_id)";
            $stmt = $this->db->prepare($sql);
            $title = $news->getTitle();
            $content = $news->getContent();
            $image = $news->getImage();
            $created_at = $news->getCreatedAt();
            $category_id = $news->getCategoryId();
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);

            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateNews($news) {
        try {
            $sql = "UPDATE news SET title = :title, content = :content, image = :image, created_at = :created_at, category_id = :category_id WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $news->getId());
            $stmt->bindParam(':title', $news->getTitle());
            $stmt->bindParam(':content', $news->getContent());
            $stmt->bindParam(':image', $news->getImage());
            $stmt->bindParam(':created_at', $news->getCreatedAt());
            $stmt->bindParam(':category_id', $news->getCategoryId());
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function deleteNews($id) {
        try {
            $sql = "DELETE FROM news WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>

<?php
require_once 'Models/News.php';
require_once 'config/db.php';

class NewsService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection(); // Kết nối tới CSDL
    }

    public function getAllNews()
    {
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


    public function getNewsById($id)
    {
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


    public function add(news $news)
    {
        return $this->model->add($news);
    }

    public function edit($news)
    {
        return $this->model->edit($news);
    }


    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
?>

<?php
require_once 'Models/News.php';
require_once 'Servies/NewsService.php';

class NewsController {
    public function index() {
        $id = $_GET['id'] ?? 0;
        $newsService = new NewsService();
        $news = $newsService->getAllNews();
        require 'Views/news/detail.php';
    }


    public function add() {

        require_once __DIR__ . '/../admin/news/add.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title= trim($_POST['title'] ?? '') ;
            $content  = trim($_POST['content'] ?? '');
            $created_at = trim($_POST['created_at']);
            $category_id = trim($_POST['category_id']);

            // var_dump($file);

            $fileName = $_FILES['fileToUpload']['name'];
            $fileType = $_FILES['fileToUpload']['type'];
            $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
            $fileError = $_FILES['fileToUpload']['error'];
            $fileSize = $_FILES['fileToUpload']['size'];

            // cắt đuôi file
            $fileExt = explode('.', $fileName);
            $fileActuaExt = strtolower(end($fileExt));

            //echo $fileActuaExt;

            $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

            if (in_array($fileActuaExt, $listImgExt)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                        $fileDestination = './assets/images/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            echo "File đã được tải lên: $fileDestination";
                        } else {
                            echo "Lỗi khi lưu file.";
                        }
                    } else {
                        echo "loi";
                    }
                } else {
                    echo "loi";
                }
            } else {
                echo "loi";
            }
            $this->model->createNews($title, $content, $created_at, $category_id);
            header('Location: /index.php');
            exit();
        }
    }
    // Hiển thị form sửa tin tức
    public function edit() {
        require_once __DIR__ . '/../admin/news/edit.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editIndex = $_POST['edit_index'] ?? null; // Lấy chỉ số cần sửa nếu có
            $title= trim($_POST['title'] ?? '') ;
            $content  = trim($_POST['content'] ?? '');
            $created_at = trim($_POST['created_at']);
            $category_id = trim($_POST['category_id']);

            if ($editIndex !== null) {
                $editIndex = (int) $editIndex;
                $old_image = $_POST['old_image']; // Đường dẫn ảnh cũ

                $image = $old_image; // Mặc định giữ lại ảnh cũ nếu không tải ảnh mới

                $fileName = $_FILES['fileToUpload']['name'];
                $fileType = $_FILES['fileToUpload']['type'];
                $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
                $fileError = $_FILES['fileToUpload']['error'];
                $fileSize = $_FILES['fileToUpload']['size'];

                // cắt đuôi file
                $fileExt = explode('.', $fileName);
                $fileActuaExt = strtolower(end($fileExt));

                //echo $fileActuaExt;

                $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

                if (in_array($fileActuaExt, $listImgExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                            $fileDestination = './assets/images/' . $fileNameNew;
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                echo "File đã được tải lên: $fileDestination";
                                $image = $fileDestination;

                                // Xóa ảnh cũ nếu ảnh mới tải lên thành công
                                if (file_exists($old_image)) {
                                    unlink($old_image);
                                }
                            } else {
                                echo "Lỗi khi lưu file.";
                            }
                        } else {
                            echo "loi";
                        }
                    } else {
                        echo "loi";
                    }
                } else {
                    echo "loi";
                }
                $this->model->createNews($title, $content, $created_at, $category_id);
                header('Location: /index.php');
                exit();
            }
        }
    }


    // Xóa tin tức
    public function delete() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deleteIndex = $_POST['delete_index'] ?? null; // Lấy chỉ số cần xóa nếu có

            if ($deleteIndex !== null && is_numeric($deleteIndex)) {
                // Xóa phần tử khỏi danh sách
                $this->model->RemoveImg($deleteIndex);
            }
            header('Location: /index.php');
            exit();
        }
    }
}

?>

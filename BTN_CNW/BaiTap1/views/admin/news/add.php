<?php
// Bao gồm file kết nối cơ sở dữ liệu
include "../config/db.php"; // Đảm bảo đường dẫn chính xác đến file db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nhận dữ liệu từ form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $created_at = date('Y-m-d H:i:s'); // Lấy ngày giờ hiện tại

    // Xử lý ảnh upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Các loại file được phép
        if (in_array($imageExtension, $allowedExtensions)) {
            // Tạo tên file duy nhất để tránh trùng lặp
            $image = 'uploads/' . uniqid() . '-' . $imageName;
            // Di chuyển ảnh đến thư mục 'uploads'
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                echo "Ảnh đã được upload thành công.";
            } else {
                echo "Lỗi khi upload ảnh.";
                $image = ''; // Nếu không upload được ảnh, để giá trị mặc định là rỗng
            }
        } else {
            echo "Chỉ chấp nhận các định dạng ảnh: jpg, jpeg, png, gif.";
            $image = ''; // Nếu ảnh không hợp lệ, để giá trị mặc định là rỗng
        }
    }

    try {
        // Lấy kết nối từ lớp Database
        $conn = Database::getConnection();

        // Thực hiện câu lệnh INSERT vào cơ sở dữ liệu
        $sql = "INSERT INTO news (title, content, image, created_at, category_id) 
                VALUES (:title, :content, :image, :created_at, :category_id)";

        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);

        // Liên kết các giá trị với các tham số trong câu lệnh SQL
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':category_id', $category_id);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            echo "Tin tức đã được thêm thành công!";
        } else {
            echo "Lỗi khi thêm tin tức vào cơ sở dữ liệu.";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <header class="mb-4">
        <h1 class="text-center">Thêm Tin Tức Mới</h1>
    </header>

    <form action="add.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="1">Tin tức 1</option>
                <option value="2">Tin tức 2</option>
                <option value="3">Tin tức 3</option>
                <!-- Các danh mục khác -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Tin Tức</button>
    </form>

    <footer class="text-center mt-5">
        <a href="index.php" class="btn btn-secondary">Quay lại trang chủ</a>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

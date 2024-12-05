

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

    <form action="../admin/news/add.php" method="POST" enctype="multipart/form-data">
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

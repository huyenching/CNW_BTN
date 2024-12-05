<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <header class="mb-4">
        <h1 class="text-center">News Detail</h1>
    </header>

    <?php if (isset($news) && $news instanceof News): ?>
        <div class="card mb-4">
            <img src="../image/hoa-1.jpg" class="card-img-top" alt="News Image" style="max-height: 400px; object-fit: cover;">
            <div class="card-body">
                <h2 class="card-title"><?= htmlspecialchars($news->getTitle()) ?></h2>
                <p class="card-text"><?= nl2br(htmlspecialchars($news->getContent())) ?></p>
                <p class="text-muted"><small>Published on: <?= htmlspecialchars($news->getCreatedAt()) ?></small></p>
                <p class="text-muted"><small>Category ID: <?= htmlspecialchars($news->getCategoryId()) ?></small></p>
            </div>
        </div>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Image</th>
                <th scope="col">Created At</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($news) && is_array($news)): ?>
                <?php foreach ($news as $item => $newsItem): ?>
                    <tr>
                        <td><?= htmlspecialchars($newsItem->getId()) ?></td>
                        <td><?= htmlspecialchars($newsItem->getTitle()) ?></td>
                        <td><?= htmlspecialchars(substr($newsItem->getContent(), 0, 50)) ?>...</td>
                        <td><img src="<?= htmlspecialchars($newsItem->getImage()) ?>" alt="Image" style="width: 100px;"></td>
                        <td><?= htmlspecialchars($newsItem->getCreatedAt()) ?></td>
                        <td><?= htmlspecialchars($newsItem->getCategoryId()) ?></td>
                        <td>
                            <a href="../admin/news/edit.php?id=<?= $newsItem->getId() ?>" class="btn btn-primary">Sửa</a>
                            <form action="../admin/news/delete.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="delete_id" value="<?= $newsItem->getId() ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No news available.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between mb-4">
            <a href="/BaiTap1/Views/admin/news/add.php" class="btn btn-success">Thêm bài viết</a>

        </div>
    <?php endif; ?>

    <footer class="text-center mt-5">
        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

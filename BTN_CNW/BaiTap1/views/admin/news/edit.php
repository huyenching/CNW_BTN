<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tin tức</title>
</head>
<body>
<h1>Sửa Tin tức</h1>
<form method="POST" enctype="multipart/form-data">
    <label for="title">Tiêu đề:</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($news['title']) ?>" required>

    <label for="content">Nội dung:</label>
    <textarea name="content" id="content" required><?= htmlspecialchars($news['content']) ?></textarea>

    <label for="image">Hình ảnh:</label>
    <input type="file" name="image" id="image">

    <label for="category">Danh mục:</label>
    <select name="category_id" id="category" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?= $news['category_id'] == $category['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Lưu</button>
</form>
</body>
</html>

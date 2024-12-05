<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tin tức</title>
</head>
<body>
    <h1>Danh sách tin tức</h1>
    <ul>
        <?php foreach ($newsList as $news): ?>
            <li>
                <a href="index.php?controller=news&action=detail&id=<?= $news['id']; ?>">
                    <?= htmlspecialchars($news['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

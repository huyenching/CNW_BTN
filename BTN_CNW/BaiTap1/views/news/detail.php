<!-- views/news/detail.php -->
<?php if (isset($news) && $news): ?>
    <h1><?= htmlspecialchars($news['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($news['content'])) ?></p>
    <p><small>Ngày đăng: <?= htmlspecialchars($news['created_at']) ?></small></p>
<?php else: ?>
    <p>News article not found!</p>
<?php endif; ?>

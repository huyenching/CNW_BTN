<form method="get">
    <input type="hidden" name="controller" value="news">
    <input type="hidden" name="action" value="search">
    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
    <button type="submit">Tìm kiếm</button>
</form>

<?php if (!empty($results)): ?>
    <?php foreach ($results as $item): ?>
        <h2><a href="index.php?controller=news&action=detail&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></h2>
        <p><?= substr($item['content'], 0, 100) ?>...</p>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>Không tìm thấy tin tức nào.</p>
<?php endif; ?>

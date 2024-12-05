<?php foreach ($news as $item): ?>
    <h2><a href="index.php?controller=news&action=detail&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></h2>
    <p><?= substr($item['content'], 0, 100) ?>...</p>
    <hr>
<?php endforeach; ?>

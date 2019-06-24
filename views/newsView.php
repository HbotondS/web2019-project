<?php include_once '../includes/autoload.php' ?>
<link href="../styles/news.css" rel="stylesheet">

<div class="container">
    <h3>Hírek</h3>
    <?php foreach (News::getAllNews() as $news): ?>
        <div class="news">
            <p class="title"><?= $news['title'] ?></p>
            <p class="content"><?= $news['content'] ?></p>
            <p class="author"><?= $news['date'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

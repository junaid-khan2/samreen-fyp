<?php

include("./init.php");

/// Set Page Title
$page_title = "News";

/// Fetch All Events from database
$news = $database->query("SELECT * FROM news ORDER BY timestamp DESC");
$news = $news->fetchAll();


?>

<html>
<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h1 class="page-title">News</h1>
        </div>
        <div class="news-grid">
            <?php foreach ($news as $n): ?>
            <div class="news-card">
                <img class="cover" src="./assets/covers/<?= $n["cover"]; ?>" />
                <h5 class="title">
                    <?= $n["title"] ?>
                </h5>
                <p><?= $n["description"] ?></p>
                <a href="./news_view.php?id=<?= $n["id"]; ?>" class="btn btn-sm btn-primary">Read More</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
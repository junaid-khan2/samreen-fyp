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
        <div class="row">
            <?php foreach ($news as $n): ?>
               <div class="col-md-4 col-lg-4 col-sm-4 border m-1">
                    <div class="row">
                        <div class="col-6 p-1">
                            <a href="./news_view.php?id=<?= $n["id"]; ?>">
                                <img class="cover" height="200" src="./assets/covers/<?= $n["cover"]; ?>" />
                            </a>
                        </div>
                        <div class="col-6 mt-4">
                            <h5 class="h5   ">
                                <a href="./news_view.php?id=<?= $n["id"]; ?>">
                                <?= $n["title"] ?>
                                </a>
                            </h5>
                            <p><?= $n["description"] ?></p>
                        </div>
                    </div>
               </div>
            <!-- <div class="news-card">
                <img class="cover" src="./assets/covers/<?= $n["cover"]; ?>" />
                <h5 class="title">
                    <?= $n["title"] ?>
                </h5>
                <p><?= $n["description"] ?></p>
                <a href="./news_view.php?id=<?= $n["id"]; ?>" class="btn btn-sm btn-primary">Read More</a>
            </div> -->
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
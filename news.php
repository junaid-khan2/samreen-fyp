<?php

include("./init.php");

/// Set Page Title
$page_title = "News";

/// Fetch All Events from the database
$news = $database->query("SELECT * FROM news ORDER BY timestamp DESC");
$news = $news->fetchAll();

?>

<html>
<head>
    <?php include("layout/head.php"); ?>
    <style>
        /* Custom styles for the card */
        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .card-body {
            height: 200px;
            overflow: hidden;
        }
    </style>
</head>

<body class="home-layout">
    <?php include("layout/header.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h1 class="page-title">News</h1>
        </div>
        <div class="row">
            <?php foreach ($news as $n): ?>
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <a href="./news_view.php?id=<?= $n["id"]; ?>" class="text-decoration-none">
                        <div class="container">
                            <div class="card">
                                <img src="./assets/covers/<?= $n["cover"]; ?>" class="card-img-top" alt="Card Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $n["title"] ?></h5>
                                    <p class="card-text text-muted"><?= $n["description"] ?></p>
                                    <?php if (strlen($n["description"]) > 200): ?>
                                        <a href="./news_view.php?id=<?= $n["id"]; ?>" class="btn btn-link">See more</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>

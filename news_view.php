<?php

include("./init.php");

/// Set Page Title
$page_title = "News";

/// Fetch News Detail from database
$news = $database->prepare("SELECT * FROM news WHERE id=:id");
$news->execute([':id' => $_GET["id"]]);
$news = $news->fetch();

?>

<html>
<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>
    <div class="page-content">
        <div class="page-header" style="margin-bottom: 1em">
            <h1 class="page-title"><?= $news["title"] ?></h1>
            <p>Published: <?= $news["timestamp"] ?></p>
        </div>
        <div class="card">
            <div class="card-body">
                <?= $news["content"] ?>
            </div>
        </div>
    </div>
</body>

</html>
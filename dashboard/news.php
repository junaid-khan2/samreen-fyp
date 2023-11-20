<?php

include("../init.php");

$page_title = "News - Dashboard";

/// Fetch All Events From Database
$news = $database->query("SELECT * FROM news ORDER BY `timestamp` DESC")->fetchAll();



?>

<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">News</h2>
            <a href="./news_write.php" class="btn btn-sm btn-primary">Write a News</a>
        </div>
        <table class="table">
            <thead>
                <th>Created At</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($news as $n): ?>
                <tr>
                    <td><?= $n["timestamp"] ?></td>
                    <td><?= $n["title"] ?></td>
                    <td><?= $n["description"] ?></td>
                    <td class="actions">
                        <a class="text-danger" href="./actions/news_delete.php?id=<?= $n["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>
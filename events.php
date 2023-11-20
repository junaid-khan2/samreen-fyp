<?php

include("./init.php");


/// Set Page Title
$page_title = "Events";


/// Fetch All Events From Database
$events = $database->query('SELECT * FROM events ORDER BY `timestamp` DESC')->fetchAll();
?>

<html>

<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h1 class="page-title">Events</h1>
            <p class="page-subtitle">Join our sports family and feel the energy of the game by registering yourself in
                your favourite sports
            </p>
        </div>
        <div class="events-grid">
            <?php foreach ($events as $event): ?>
            <div class="event-card">
                <img class="cover" src="./assets/covers/<?= $event["cover"] ?>" />
                <h4 class="title">
                    <?= $event["title"] ?>
                </h4>
                <a href="./event_view.php?id=<?= $event["id"]; ?>" class="btn btn-primary">View</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
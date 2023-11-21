<?php


include("./init.php");

$page_title = "Schedule";


/// Fetch All Events from database
$schedules = $database->query("SELECT
schedule.id AS schedule_id,
team_a.name AS team_a_name,
team_b.name AS team_b_name,
schedule.date,
schedule.venue,
events.title AS event_title
FROM
schedule
JOIN
teams AS team_a ON schedule.team_a = team_a.id
JOIN
teams AS team_b ON schedule.team_b = team_b.id
JOIN
events ON schedule.event_id = events.id ORDER BY
    schedule.date DESC;");
$schedules = $schedules->fetchAll();
?>


<html>

<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>

    <div class="page-content">
        <div class="page-header">
            <h1 class="page-title">Schedule</h1>
        </div>
        <table class="table">
            <thead>
                <th>Event</th>
                <th>Date/Time</th>
                <th>Teams</th>
                <th>Venue</th>
            </thead>
            <tbody>
                <?php foreach ($schedules as $n): ?>
                <tr>
                    <td><?= $n['event_title']?></td>
                    <td><?= $n["date"] ?></td>
                    <td><?= $n["team_a_name"] ?> v/s <?= $n["team_b_name"] ?></td>
                    <td><?= $n["venue"] ?></td>
                  
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
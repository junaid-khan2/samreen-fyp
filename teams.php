<?php
include("./init.php");

$page_title = "Teams";

// Fetch All Events from the database
$schedules = $database->query("
SELECT
    sch.id AS schedule_id,
    evt.title AS event_title,
    team_a.name AS team_a_name,
    team_b.name AS team_b_name,
    (
        SELECT GROUP_CONCAT(players_a.name) 
        FROM players players_a 
        WHERE players_a.team_id = team_a.id AND players_a.event_id = sch.event_id
    ) AS team_a_players,
    (
        SELECT GROUP_CONCAT(players_b.name) 
        FROM players players_b 
        WHERE players_b.team_id = team_b.id AND players_b.event_id = sch.event_id
    ) AS team_b_players,
    MIN(sch.date) AS min_date,
    sch.venue
FROM
    schedule sch
JOIN events evt ON sch.event_id = evt.id
JOIN teams team_a ON sch.team_a = team_a.id
JOIN teams team_b ON sch.team_b = team_b.id
GROUP BY
    sch.id, sch.team_a, sch.team_b, sch.venue
ORDER BY
    min_date;
");

$schedules = $schedules->fetchAll(PDO::FETCH_ASSOC);

?>

<html>

<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>

    <div class="page-content">
        <div class="page-header">
            <h1 class="page-title">Teams</h1>
        </div>

        <div class="row">
            <?php foreach ($schedules as $schedule) : ?>
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="card p-3">
                        <div class="row p-3">
                            <div class="col-12">
                                <h4 class="h4 "><?= $schedule['event_title']; ?></h4>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted">Date: <span id="date"><?= $schedule['min_date']; ?></span></h6>
                                <h6 class="text-muted">Venue: <span id="venue"><?= $schedule['venue']; ?></span></h6>
                            </div>
                        </div>

                        <div class="button-container mt-3">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" id="teamATab<?= $schedule['schedule_id']; ?>" data-toggle="pill" href="#teamA<?= $schedule['schedule_id']; ?>"><?= $schedule['team_a_name']; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="teamBTab<?= $schedule['schedule_id']; ?>" data-toggle="pill" href="#teamB<?= $schedule['schedule_id']; ?>"><?= $schedule['team_b_name']; ?></a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content mt-3">
                            <!-- Inside the loop for team A players -->
                            <div class="tab-pane fade show active" id="teamA<?= $schedule['schedule_id']; ?>">
                                <?php $teamAPlayers = explode(',', $schedule['team_a_players']); ?>
                                <div class="row">
                                <?php foreach ($teamAPlayers as $player) : ?>
                                    <div class="col-3">
                                        <a style="color: var(--primary-color);" herf="#"><?= $player; ?></a>
                                        <!-- Add additional styling or information for each player -->
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Inside the loop for team B players -->
                            <div class="tab-pane fade" id="teamB<?= $schedule['schedule_id']; ?>">
                                <?php $teamBPlayers = explode(',', $schedule['team_b_players']); ?>
                                <div class="row">
                                <?php foreach ($teamBPlayers as $player) : ?>
                                    <div class="col-3">
                                        <a style="color: var(--primary-color);" herf="#"><?= $player; ?></a>
                                        <!-- Add additional styling or information for each player -->
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
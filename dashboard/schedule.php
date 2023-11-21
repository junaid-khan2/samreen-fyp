<?php

include("../init.php");

$page_title = "Schedule - Dashboard";
$event_id = $_GET["event_id"];

$schedule = $database->query("
    SELECT 
        s.*,
        t1.name as team_a_name,
        t2.name as team_b_name
    FROM 
        schedule s
    LEFT JOIN 
        teams t1 ON s.team_a = t1.id
    LEFT JOIN 
        teams t2 ON s.team_b = t2.id
    WHERE 
        s.event_id = '".$event_id."'
    ORDER BY 
        s.date ASC;
")->fetchAll();

$teams = $database->query("SELECT * FROM teams WHERE event_id='".$event_id."' ORDER BY `timestamp` DESC")->fetchAll();

?>

<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">Schedule</h2>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#schedule-match">Schedule
                a
                Match</button>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./events.php">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
        </nav>
        <table class="table">
            <thead>
                <th>Date/Time</th>
                <th>Teams</th>
                <th>Venue</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($schedule as $n): ?>
                <tr>
                    <td><?= $n["date"] ?></td>
                    <td><?= $n["team_a_name"] ?> v/s <?= $n["team_b_name"] ?></td>
                    <td><?= $n["venue"] ?></td>
                    <td class="actions">
                        <a class="text-danger" href="./actions/schedule_delete.php?id=<?= $n["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="schedule-match" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="./actions/schedule_match.php?event_id=<?= $_GET["event_id"] ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Schedule a Match</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="team_b">
                                <?php foreach ($teams as $team): ?>
                                <option value="<?= $team["id"] ?>"><?= $team["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <h5 class="text-center my-2">V/S</h5>
                            <select class="form-control" name="team_a">
                                <?php foreach ($teams as $team): ?>
                                <option value="<?= $team["id"] ?>"><?= $team["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="datetime-local" name="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" name="venue" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
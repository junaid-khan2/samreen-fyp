<?php

include("../init.php");
$page_title = "Events - Dashboard";

$sql = "
    SELECT 
        events.*, 
        COALESCE(total_teams, 0) as total_teams,
        COALESCE(total_players, 0) as total_players
    FROM `events` 
    LEFT JOIN (
        SELECT event_id, COUNT(id) as total_teams
        FROM teams
        GROUP BY event_id
    ) AS team_counts ON team_counts.event_id = events.id
    LEFT JOIN (
        SELECT event_id, COUNT(id) as total_players
        FROM players
        GROUP BY event_id
    ) AS player_counts ON player_counts.event_id = events.id
    ORDER BY events.timestamp DESC
";

/// Fetch All Events From Database
$events = $database->query($sql)->fetchAll();

?>


<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">Events</h2>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-event">Create new
                Event</button>
        </div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Created At</th>
                <th>Teams</th>
                <th>Players</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event["title"] ?></td>
                    <td><?= $event["timestamp"] ?></td>
                    <td><?= $event["total_teams"] ?></td>
                    <td><?= $event["total_players"] ?></td>
                    <td class="actions">
                        <a href="./players.php?event_id=<?= $event["id"] ?>">Players</a> |
                        <a href="./teams.php?event_id=<?= $event["id"] ?>">Teams</a> |
                        <a href="./schedule.php?event_id=<?= $event["id"] ?>">Schedule</a> |
                        <a class="text-danger" href="./actions/event_delete.php?id=<?= $event["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="create-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="./actions/event_create.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" type="text" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover" class="form-control">
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


    <!-- <form action="event_create.php" method="post">
        <div class="form->
        <label for=" name">Event Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="date">Description:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="location">Event Location:</label>
            <input type="text" id="location" name="location" required><br><br>

            <input type="submit" value="Create Event">
    </form> -->

</body>

</html>
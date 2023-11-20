<?php

include("../init.php");

$page_title = "Teams - Dashboard";
$event_id = $_GET["event_id"];

/// Fetch All Events From Database
$teams = $database->query("SELECT * FROM teams WHERE event_id='".$event_id."' ORDER BY `timestamp` DESC")->fetchAll();

?>


<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">Teams</h2>
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-team">Create
                new
                Team</button>
        </div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?= $team["name"] ?></td>
                    <td><?= $team["timestamp"] ?></td>
                    <td class="actions">
                        <a class="text-danger"
                            href="./actions/team_delete.php?id=<?= $team["id"] ?>&event_id=<?= $event_id ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="create-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="./actions/team_create.php?event_id=<?= $_GET["event_id"] ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
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
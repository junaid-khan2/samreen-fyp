<?php

include("../init.php");


$page_title = "Players - Dashboard";
$event_id = $_GET["event_id"];

$players = $database->query("SELECT * FROM players WHERE event_id='".$event_id."' ORDER BY `timestamp` DESC")->fetchAll();

$teams = $database->query("SELECT * FROM teams WHERE event_id='".$event_id."' ORDER BY `timestamp` DESC")->fetchAll();


?>


<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">Players</h2>
        </div>
        <table class="table">
            <thead>
                <th>ID#</th>
                <th>Registerd At</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Team</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($players as $player): ?>
                <tr data-id="<?= $player["id"] ?>">
                    <td><?= $player["id"]; ?>
                    </td>
                    <td><?= $player["timestamp"] ?></td>
                    <td><?= $player["name"] ?></td>
                    <td><?= $player["email"] ?></td>
                    <td><?= $player["phone_number"] ?></td>
                    <td>
                        <select class="form-control" name="team">
                            <?php foreach ($teams as $team): ?>
                            <option value="<?= $team["id"] ?>"
                                <?= ($team["id"] == $player["team_id"]) ? 'selected' : '' ?>>
                                <?= $team["name"] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </td>

                    <td class="actions">
                        <a class="text-danger"
                            href="./actions/player_delete.php?id=<?= $player["id"] ?>&event_id=<?= $event_id ?>">Delete</a>
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

<script>
document.querySelectorAll('select[name="team"]').forEach(e => {
    e.addEventListener('change', (event) => {
        const payload = {
            id: event.target.closest("tr").getAttribute("data-id"),
            team_id: event.target.value
        }
        $.post("./actions/player_update.php", payload);
    })
})
</script>

</html>
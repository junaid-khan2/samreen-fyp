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
                data-target="#schedule-match">Schedule a Match</button>
        </div>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./events.php">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
        </nav>
          <!-- Bootstrap Alert for Success -->
          <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert" style="display: none;">
            <strong>Success!</strong> Schedule created successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
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
                        <a class="text-danger" href="#" data-toggle="modal" data-target="#deleteScheduleModal" data-delete-id="<?= $n["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Schedule Deletion -->
    <div class="modal fade" id="deleteScheduleModal" tabindex="-1" role="dialog" aria-labelledby="deleteScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteScheduleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this schedule?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteSchedule">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Scheduling a Match -->
    <!-- Modal for Scheduling a Match -->
    <div class="modal fade" id="schedule-match" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="scheduleMatchForm" action="./actions/schedule_match.php?event_id=<?= $_GET["event_id"] ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Schedule a Match</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="team_b" id="team_b">
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?= $team["id"] ?>"><?= $team["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <h5 class="text-center my-2">V/S</h5>
                            <select class="form-control" name="team_a" id="team_a">
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?= $team["id"] ?>"><?= $team["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="datetime-local" name="date" id="date" class="form-control">
                            <div id="dateError" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" name="venue" id="venue" class="form-control">
                            <div id="venueError" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveScheduleBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#saveScheduleBtn').on('click', function () {
            // Validate the form before submitting
            $.ajax({
                type: "POST",
                url: $("#scheduleMatchForm").attr("action"),
                data: new FormData($("#scheduleMatchForm")[0]),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // If validation is successful, close the modal and perform any other actions
                        $("#schedule-match").modal("hide");
                        // You might want to reload the schedule table or do other actions here
                        $("#success-alert").show();
                            // Reload the page after 3 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 3000)
                    } else {
                        // Clear previous error messages and classes
                        $(".form-control").removeClass("is-invalid");
                        $(".invalid-feedback").empty();

                        // Display validation errors next to corresponding form fields
                        $.each(response.errors, function (key, value) {
                            if (value != null) {
                                $("#" + key).addClass("is-invalid");
                                $("#" + key + "Error").html(value);
                                $("#" + key + "Error").show();
                            }
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });


            var deleteScheduleId = null;

            // Event handler for the Delete link
            $('.text-danger').on('click', function (event) {
                event.preventDefault();
                deleteScheduleId = $(this).data('delete-id');
                $('#deleteScheduleModal').modal('show');
            });

            // Event handler for the Delete button in the modal
            $('#confirmDeleteSchedule').on('click', function () {
                if (deleteScheduleId !== null) {
                    // Perform the deletion (you can use AJAX here)
                    // For demonstration purposes, redirecting to a delete action URL
                    window.location.href = './actions/schedule_delete.php?id=' + deleteScheduleId;
                }

                // Reset the deleteScheduleId variable
                deleteScheduleId = null;

                // Close the modal
                $('#deleteScheduleModal').modal('hide');
            });
        });
    </script>
</body>

</html>

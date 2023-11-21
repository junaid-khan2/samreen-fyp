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
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-event">Create new Event</button>
            
        </div>
           <!-- Bootstrap Alert for Success -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert" style="display: none;">
            <strong>Success!</strong> Event created successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                    <a class="text-danger delete-event" data-event-id="<?= $event["id"] ?>" >Delete</a>
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
                <form id="createEventForm" action="./actions/event_create.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <div id="title-Error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" type="text" name="description" id="description" class="form-control"></textarea>
                            <div id="description-Error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover" id="cover" class="form-control">
                            <div id="cover-Error" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="createEventBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Model -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this event?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
 
    <script>
  
  $(document).ready(function () {
    // Handle Delete 
     // Handle delete confirmation
     $(".delete-event").on("click", function () {
       
       
            var eventId = $(this).data("event-id");

            // Set the event id in the modal for reference
            $("#deleteEventModal").data("event-id", eventId);

            // Show the delete confirmation modal
            $("#deleteEventModal").modal("show");
        });

        // Handle actual delete after confirmation
        $("#confirmDelete").on("click", function () {
            // Get the event id from the modal
            var eventId = $("#deleteEventModal").data("event-id");
            
            // Perform your delete action here, for example, using AJAX
            $.ajax({
                type: "POST",
                url: "./actions/event_delete.php",
                data: { id: eventId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // If deletion is successful, close the modal or perform any other actions
                        $("#deleteEventModal").modal("hide");
                        // Reload the page or update the events table as needed
                        location.reload();
                    } else {
                        console.error(response.errors);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });
    });
    // Handle form submission via AJAX
    $("#createEventBtn").on("click", function () {
        $.ajax({
            type: "POST",
            url: $("#createEventForm").attr("action"),
            data: new FormData($("#createEventForm")[0]),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json", // Expect JSON response from the server
            success: function (response) {
                // Check for valid JSON
             
                try {
                  
                    if (response.success) {
                        // If creation is successful, close the modal or perform any other actions
                        $("#create-event").modal("hide");
                        // You might want to reload the events table or do other actions here
                        $("#success-alert").show();
                        // Reload the page after 3 seconds
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        // Clear previous error messages and classes
                        $(".form-control").removeClass("is-invalid");
                        $(".invalid-feedback").empty();

                        // Display validation errors next to corresponding form fields
                        $.each(response.errors, function (key, value) {
                            if (value != null) {
                                $("#" + key).addClass("is-invalid");
                                $("#" + key + "-Error").html(value);
                                $("#" + key + "-Error").show(); // Show the invalid-feedback div
                            }
                        });

                        // Log the error messages to the console
                        console.error(response.errors);
                    }
                } catch (e) {
                    // Log parsing error
                    console.error('Invalid JSON response:', response);
                }
            },
            error: function (xhr, status, error) {
                // Log AJAX request failure
                console.error('AJAX request failed:', status, error);
            }
        });
    });
    </script>
</body>
</html>

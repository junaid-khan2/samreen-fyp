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
   <!--Create Modal -->
    <div class="modal fade" id="create-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="createTeamForm" action="./actions/team_create.php?event_id=<?= $_GET["event_id"] ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div id="nameError" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveTeamBtn">Save</button>
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
                // Check for validation errors in the response
                if (response.success) {
                    // If creation is successful, close the modal or perform any other actions
                    $("#create-event").modal("hide");
                    // You might want to reload the events table or do other actions here
                    
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
                            $("#" + key + "-error").html(value);
                            $("#" + key + "-error").show(); // Show the invalid-feedback div
                        }
                    });

                    // Log the error messages to the console
                    console.error(response.errors);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    });

           // Event handler for the Save button
           $('#saveTeamBtn').on('click', function () {
            // Validate the form before submitting
            if (validateForm()) {
                $.ajax({
                    type: "POST",
                    url: $("#createTeamForm").attr("action"),
                    data: new FormData($("#createTeamForm")[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json", // Expect JSON response from the server
                    success: function (response) {
                        // Check for validation errors in the response
                        if (response.success) {
                            // If creation is successful, close the modal or perform any other actions
                            $("#create-team").modal("hide");
                            // You might want to reload the teams table or do other actions here

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
                                    $("#" + key + "Error").show(); // Show the invalid-feedback div
                                }
                            });

                            // Log the error messages to the console
                            console.error(response.errors);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                    }
                });
            }
        });

        // Function to validate the form
        function validateForm() {
            // Reset any previous error messages
            $('#nameError').text('');

            // Get the input values
            var name = $('#name').val();

            // Validate the Name field
            if (name.trim() === '') {
                $('#nameError').text('Name is required.');
                return false;
            }

            // Add additional validation rules as needed

            // Form is valid
            return true;
        }
   


    </script>
</body>
</html>

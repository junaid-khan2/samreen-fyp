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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./events.php">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Teams</li>
            </ol>
        </nav>
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
                        <!-- Add data-toggle, data-target, and data-delete-id attributes for modal trigger -->
                        <a class="text-danger" href="#" data-toggle="modal" data-target="#deleteEventModal" data-delete-id="<?= $team["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
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

    
   <!-- Delete Event Modal -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Display team information in the modal body -->
                <div class="modal-body">
                  
              
                    <p>Are you sure you want to delete this team?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Add an ID to the delete button for event handling -->
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        // JavaScript to handle the deletion confirmation
        $(document).ready(function () {
            // Event handler for the modal show event
            $('#deleteEventModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var teamId = button.data('delete-id'); // Extract info from data-* attributes
    
                
    
                // Set the delete-id attribute on the modal confirm button
                $('#confirmDelete').attr('data-delete-id', teamId);
            });
    
            // Event handler for the delete button in the modal
            $('#confirmDelete').on('click', function () {
                // Get the delete ID from the data attribute
                var deleteId = $(this).data('delete-id');
             
                // Redirect to the delete action with the delete ID
                window.location.href = './actions/team_delete.php?id=' + deleteId + '&event_id=<?= $event_id ?>';
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
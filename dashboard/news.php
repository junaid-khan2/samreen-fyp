<?php

include("../init.php");

$page_title = "News - Dashboard";

/// Fetch All News From Database
$news = $database->query("SELECT * FROM news ORDER BY `timestamp` DESC")->fetchAll();

?>

<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">News</h2>
            <a href="./news_write.php" class="btn btn-sm btn-primary">Write a News</a>
        </div>
        <table class="table">
            <thead>
                <th>Created At</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($news as $n): ?>
                <tr>
                    <td><?= $n["timestamp"] ?></td>
                    <td><?= $n["title"] ?></td>
                    <td><?= $n["description"] ?></td>
                    <td class="actions">
                        <!-- Add data-toggle, data-target, and data-delete-id attributes for modal trigger -->
                        <a class="text-danger" href="#" data-toggle="modal" data-target="#deleteNewsModal" data-delete-id="<?= $n["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Delete News Modal -->
    <div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNewsModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Display news information in the modal body -->
                <div class="modal-body">
                    <p>Are you sure you want to delete this news?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Add an ID to the delete button for event handling -->
                    <button class="btn btn-danger" id="confirmDeleteNews">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle the deletion confirmation
        $(document).ready(function () {
            // Event handler for the modal show event
            $('#deleteNewsModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var newsId = button.data('delete-id'); // Extract info from data-* attributes

                // Set the delete-id attribute on the modal confirm button
                $('#confirmDeleteNews').attr('data-delete-id', newsId);
            });

            // Event handler for the delete button in the modal
            $('#confirmDeleteNews').on('click', function () {
                // Get the delete ID from the data attribute
                var deleteId = $(this).data('delete-id');

                // Redirect to the delete action with the delete ID
                window.location.href = './actions/news_delete.php?id=' + deleteId;
            });
        });
    </script>
</body>

</html>

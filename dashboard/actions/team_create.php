<?php
include("../../init.php");
header('Content-Type: application/json');

try {
    $errors = [];

    // Validate Name
    if (empty($_POST['name'])) {
        $errors['name'] = "Team name is required";
    }

    // Validate Event ID
    $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;
    if (empty($event_id)) {
        $errors['event_id'] = "Event ID is required";
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        // Validation errors, return the error response
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Get form data
    $name = $_POST['name'];

    // Insert into the database
    $stmt = $database->prepare("INSERT INTO teams (name, event_id) VALUES (:name, :event_id)");
    $stmt->execute([':name' => $name, ':event_id' => $event_id]);

    // Return a success response
    echo json_encode(['success' => true, 'message' => 'Team created successfully']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo json_encode(['success' => false, 'errors' => ['message' => 'Database error: ' . $e->getMessage()]]);
} catch (Exception $e) {
    // Handling other general exceptions
    echo json_encode(['success' => false, 'errors' => ['message' => 'An error occurred: ' . $e->getMessage()]]);
}
?>

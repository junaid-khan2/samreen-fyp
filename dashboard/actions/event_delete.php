<?php

include("../../init.php");

header('Content-Type: application/json');

try {
    $event_id = $_POST['id'];
    $stmt = $database->prepare("DELETE FROM events WHERE id = :id");
    $stmt->execute([':id' => $event_id]);

    // Respond with JSON success message
    echo json_encode(['success' => true, 'message' => 'Event deleted successfully']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Handling other general exceptions
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>

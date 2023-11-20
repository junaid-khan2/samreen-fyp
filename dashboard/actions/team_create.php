<?php
include("../../init.php");

try {
    // Get form data
    $name = $_POST['name'];
    $event_id = $_GET['event_id'];
    
    // Insert into the database
    $stmt = $database->prepare("INSERT INTO teams (name, event_id) VALUES (:name, :event_id)");
    $stmt->execute([':name' => $name, ':event_id' => $event_id,]);
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
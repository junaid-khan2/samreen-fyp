<?php
include("./init.php");

try {

    $event_id = $_GET['event_id'];
    
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    
    // // Insert into the database
    $stmt = $database->prepare("INSERT INTO players (name, email, phone_number, event_id) VALUES (:name, :email, :phone_number, :event_id)");
    $stmt->execute([
        ':name' => $name, 
        ':email' => $email,
        ':phone_number' => $phone_number, 
        ':event_id' => $event_id
    ]);
    // Redirect back to events page
    header("Location: ./event_view.php?id=".$event_id."");
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}
?>
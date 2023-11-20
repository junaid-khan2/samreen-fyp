<?php

include("../../init.php");

try {
    $event_id = $_GET['id'];
    $stmt = $database->prepare("DELETE FROM news WHERE id = :id");
    $stmt->execute([':id' => $event_id]);
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}

?>
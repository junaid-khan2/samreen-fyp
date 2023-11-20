<?php

include("../../init.php");

try {
    $player_id = $_GET['id'];
    $event_id = $_GET['event_id'];
    $stmt = $database->prepare("DELETE FROM players WHERE id = :id");
    $stmt->execute([':id' => $player_id]);
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}

?>
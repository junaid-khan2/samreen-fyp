<?php

include("../../init.php");

try {

    $player_id = $_POST['id'];
    $team_id = $_POST['team_id'];
    
    // Prepare the UPDATE SQL statement
    $stmt = $database->prepare("UPDATE players SET team_id = :team_id WHERE id = :id");
    $stmt->execute([
        ':id' => $player_id,
        ':team_id' => $team_id
    ]);
    echo "Player Updated";
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}

?>
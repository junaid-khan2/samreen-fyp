<?php
include("../../init.php");

try {
    // Get form data
    $team_a = $_POST['team_a'];
    $team_b = $_POST['team_b'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $event_id = $_GET['event_id'];

    // Insert into the database
    $stmt = $database->prepare("INSERT INTO schedule (team_a, team_b, date, venue, event_id) VALUES (:team_a, :team_b, :date, :venue, :event_id)");
    $stmt->execute([
        ':team_a' => $team_a,
        ':team_b' => $team_b,
        ':date' => $date,
        ':venue' => $venue,
        ':event_id' => $event_id
    ]);
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
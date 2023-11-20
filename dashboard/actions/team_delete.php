<?php

include("../../init.php");

try {
    $team_id = $_GET['id'];
    $stmt = $database->prepare("DELETE FROM teams WHERE id = :id");
    $stmt->execute([':id' => $team_id]);
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

?>
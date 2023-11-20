<?php

include("../../init.php");

try {
    $match_id = $_GET['id'];
    $stmt = $database->prepare("DELETE FROM schedule WHERE id = :id");
    $stmt->execute([':id' => $match_id]);
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

?>
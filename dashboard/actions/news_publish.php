<?php
include("../../init.php");

try {

    // Get form data
    $title = $_POST['title'];
    $description  = $_POST['description'];
    $content = $_POST["content"];
    
    if (isset($_FILES['cover'])) {
        $cover = hash('sha256', time() . $_FILES['cover']['name']) . '.' . pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['cover']['tmp_name'], '../../assets/covers/' . $cover);
    }else{
        die('File upload error.');
    }
    
    // Insert into the database
    $stmt = $database->prepare("INSERT INTO news (title, description, content, cover) VALUES (:title, :description, :content, :cover)");
    $stmt->execute([':title' => $title, ':description' => $description, ':content' => $content, ':cover' => $cover]);
    
    // Redirect back to events page
    header("Location: " . $_SERVER['HTTP_REFERER']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}
?>
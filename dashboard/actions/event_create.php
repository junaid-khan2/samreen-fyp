<?php
include("../../init.php");

header('Content-Type: application/json');

try {
    $errors = [];

    // Validate Title
    if (empty($_POST['title'])) {
        $errors['title'] = "Title field is required";
    }

    // Validate Description
    if (empty($_POST['description'])) {
        $errors['description'] = "Description field is required";
    }

    // Validate Cover
    if (empty($_FILES['cover']['name'])) {
        $errors['cover'] = "Cover image is required";
    } elseif (!in_array(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
        $errors['cover'] = "Invalid file format. Only JPG, JPEG, PNG, or GIF are allowed.";
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        // Validation errors, return the error response
        // Return a success response
        echo json_encode(['success' => false, 'errors' => $errors]);

        exit;
    }

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Upload cover image
    $cover = hash('sha256', time() . $_FILES['cover']['name']) . '.' . pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['cover']['tmp_name'], '../../assets/covers/' . $cover);

    // Insert into the database
    $stmt = $database->prepare("INSERT INTO events (title, description, cover) VALUES (:title, :description, :cover)");
    $stmt->execute([':title' => $title, ':description' => $description, ':cover' => $cover]);

    // Return a success response
    echo json_encode(['success' => true, 'message' => 'success']);
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo json_encode(['success' => false, 'errors' => ['message' => 'Database error: ' . $e->getMessage()]]);
} catch (Exception $e) {
    // Handling other general exceptions
    echo json_encode(['success' => false, 'errors' => ['message' => 'An error occurred: ' . $e->getMessage()]]);
}
?>

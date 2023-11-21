<?php

include("../../init.php");

// Function to validate form data
function validateFormData($title, $description, $content, $cover)
{
    $errors = [];

    // Validate title
    if (empty($title)) {
        $errors['title'] = 'Title is required.';
    }

    // Validate description
    if (empty($description)) {
        $errors['description'] = 'Description is required.';
    }

    // Validate content
    if (empty($content)) {
        $errors['content'] = 'Content is required.';
    }

   
    // Validate Cover
    if (empty($_FILES['cover']['name'])) {
        $errors['cover'] = "Cover image is required";
    } elseif (!in_array(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
        $errors['cover'] = "Invalid file format. Only JPG, JPEG, PNG, or GIF are allowed.";
    }


    return $errors;
}

try {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST["content"];

    // Check if the cover file is set
    if (isset($_FILES['cover'])) {
        $cover = hash('sha256', time() . $_FILES['cover']['name']) . '.' . pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['cover']['tmp_name'], '../../assets/covers/' . $cover);
    } else {
        // If cover file is not set, handle the error
        die('File upload error.');
    }

    // Validate form data
    $validationErrors = validateFormData($title, $description, $content, $cover);

    if (empty($validationErrors)) {
        // If there are no validation errors, proceed to insert into the database
        $stmt = $database->prepare("INSERT INTO news (title, description, content, cover) VALUES (:title, :description, :content, :cover)");
        $stmt->execute([':title' => $title, ':description' => $description, ':content' => $content, ':cover' => $cover]);

        // Redirect back to the events page
        echo json_encode(['success' => TRUE, 'message' => 'news add successfly']);
    } else {
        // If there are validation errors, send a JSON response with the errors
        echo json_encode(['success' => false, 'errors' => $validationErrors]);
    }
} catch (PDOException $e) {
    // Handling PDO exceptions
    echo json_encode(['success' => false, 'errors' => ['database' => 'Database error: ' . $e->getMessage()]]);
} catch (Exception $e) {
    // Handling other general exceptions
    echo json_encode(['success' => false, 'errors' => ['general' => 'An error occurred: ' . $e->getMessage()]]);
}
?>

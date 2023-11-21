<?php
include("../../init.php");

// Function to validate date format
function isValidDateTime($date)
{
    $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);
    return $dateTime && $dateTime->format('Y-m-d\TH:i') === $date;
}

// Function to validate venue (you can customize this as needed)
function isValidVenue($venue)
{
    // Example: Check if the venue is not empty
    return !empty($venue);
}

try {
    // Get form data
    $team_a = $_POST['team_a'];
    $team_b = $_POST['team_b'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $event_id = $_GET['event_id'];

    // Validation
    $errors = [];

    // Example validation: Check if date is valid
    if (!isValidDateTime($date)) {
        $errors['date'] = 'Invalid date format';
    }

    // Example validation: Check if venue is valid
    if (!isValidVenue($venue)) {
        $errors['venue'] = 'Venue cannot be empty';
    }

    // If there are validation errors, return the errors as JSON
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit();
    }

    // Insert into the database
    $stmt = $database->prepare("INSERT INTO schedule (team_a, team_b, date, venue, event_id) VALUES (:team_a, :team_b, :date, :venue, :event_id)");
    $stmt->execute([
        ':team_a' => $team_a,
        ':team_b' => $team_b,
        ':date' => $date,
        ':venue' => $venue,
        ':event_id' => $event_id
    ]);

    echo json_encode(['success' => true]);
    exit();

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'errors' => ['database' => 'Database error']]);
    exit();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'errors' => ['general' => 'An error occurred']]);
    exit();
}
?>

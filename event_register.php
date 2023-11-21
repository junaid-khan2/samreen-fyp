<?php
include("./init.php");

try {

    $event_id = $_GET['event_id'];
    
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    if(isset($name) && isset($email) && isset($phone_number) && $name != null && $email != null && $phone_number != null){
    // // Insert into the database
        $stmt = $database->prepare("INSERT INTO players (name, email, phone_number, event_id) VALUES (:name, :email, :phone_number, :event_id)");
        $stmt->execute([
            ':name' => $name, 
            ':email' => $email,
            ':phone_number' => $phone_number, 
            ':event_id' => $event_id
        ]);
        // Redirect back to events page
        // header("Location: ./event_view.php?id=".$event_id."");
        $response = array(
            'success' => true,
            'message' => 'You are susscessfly registred',
        );
    }else{
        $phone_number_msg = null;
        $name_msg = null;
        $email_msg = null;
        if(!isset($name) || $name == null){
            $name_msg = "Name field is requred";
        }
        if(!isset($email) || $email == null){
            $email_msg = "email filed is requred";
        }
        if(!isset($phone_number) || $phone_number == null){
            $phone_number_msg = "Phone Number is requred";
        }
        $response = array(
            'success' => false,
            'errors' => ['name'=>$name_msg, 'email'=>$email_msg, 'phone_number'=>$phone_number_msg],
        );
        
        
    }
    echo json_encode($response);

} catch (PDOException $e) {
    // Handling PDO exceptions
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handling other general exceptions
    echo "An error occurred: " . $e->getMessage();
}
?>
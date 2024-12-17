<?php
// Include the database connection settings
include "../settings/connection.php";

// Initialize variable to store student ID
$studentid = "";

// Check if the student ID is passed via GET request
if (isset($_GET["id"])) {
    // Get the student ID from the GET request
    $studentid = $_GET["id"];
    
    // Prepare the DELETE query to remove the student based on the student ID
    $query = "DELETE FROM `Student` WHERE `studentID` = ?";
    
    // Prepare the query for execution
    $delete = $con->prepare($query);
    
    // Bind the student ID parameter to the query
    $delete->bind_param("i", $studentid);
    
    // Execute the query
    $result = $delete->execute();
    
    // Check if the deletion was successful
    if ($result) {
        // Return a success message in JSON format if the deletion is successful
        echo json_encode(['success' => true, 'message' => 'Student removed successful']);
    } else {
        // Return a failure message in JSON format if the deletion fails
        echo json_encode(['success' => false, 'message' => 'Sorry, could not remove student']);
    }
} 

?>



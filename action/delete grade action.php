<?php
// Include the database connection settings
include "../settings/connection.php";

// Initialize variable to store grade ID
$gradeid = "";

// Check if the grade ID is passed via GET request
if (isset($_GET["id"])) {
    // Get the grade ID from the GET request
    $gradeid = $_GET["id"];
    
    // Prepare the DELETE query to remove the grade based on the grade ID
    $query = "DELETE FROM `Grade` WHERE `gradeID` = ?";
    
    // Prepare the query for execution
    $delete = $con->prepare($query);
    
    // Bind the grade ID parameter to the query
    $delete->bind_param("i", $gradeid);
    
    // Execute the query
    $result = $delete->execute();
    
    // Check if the deletion was successful
    if ($result) {
        // Return a success message in JSON format if the deletion is successful
        echo json_encode(['success' => true, 'message' => "Student's score removed successful"]);
    } else {
        // Return a failure message in JSON format if the deletion fails
        echo json_encode(['success' => false, 'message' => "Sorry, could not remove student's score"]);
    }
}

?>

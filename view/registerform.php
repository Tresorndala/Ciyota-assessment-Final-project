<?php

include "../functions/Allfunctions.php";
session_start();

$className = $classNumber = "";
$classid = $_POST["student_class"];
$classNumber = $_POST["classNumber"];

$result = get_a_classname($classid);
$classForm="<div class='container mx-auto p-5 bg-light rounded-md shadow-md'>";  // Container for the form
$classForm .= "<form action='../action/register_student_action.php' method='post' id='formsubmit'>";

// Hidden input to store the class name
$classForm .= "<input type='hidden' name='stage' value='" . $result . "'>";

// Heading for the class
$classForm .= "<h3 class='text-center text-xl font-bold text-black mb-5'>Class: " . $result . "</h3>";

// Loop to generate student input fields
for ($i = 0; $i < $classNumber; $i++) {
  $classForm .= "<div class='form-group mb-4'>";
  $classForm .= "<label class='block text-sm font-medium text-gray-700' for='studentName" . ($i + 1) . "'>Name of student " . ($i + 1) . "</label>";
  $classForm .= "<input type='text' class='form-control form-control-sm w-full p-2 rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500' id='studentName" . ($i + 1) . "' name='input[]'>";
  $classForm .= "</div>";
}

// Submit button with custom styles
$classForm .= "<button type='submit' class='register btn custom-btn edit-btn w-full py-2 text-white font-bold rounded-md'>Register</button>";

$classForm .= "</form><br><br><br>";
$classForm .= "</div>";

echo $classForm;

?>

<!-- Vue.js integration for dynamic form behavior (if necessary) -->
<script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

<!-- TailwindCSS, Bootstrap, and custom CSS for better styling -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet" />

<!-- Custom CSS for Button Styling -->
<style>
  /* Custom Button Style */
  .custom-btn {
    transition: background-color 0.3s ease;
    cursor: pointer;
    text-align: center;
  }

  /* Edit Button */
  .edit-btn {
    background-color: #17a2b8; /* Info Blue */
  }

  /* Button Hover Effect */
  .custom-btn:hover {
    background-color: #138496; /* Darker blue on hover */
  }
</style>


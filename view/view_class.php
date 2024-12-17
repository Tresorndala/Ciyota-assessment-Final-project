<?php 

include "../functions/Allfunctions.php";

$class = $_POST["student_class"];

$result = get_all_student_class($class);

$class_name = get_a_classname($class);
if ($result->num_rows === 0) {
  echo "<div class='text-center'>";
  echo "<h3 class='text-3xl text-black font-semibold'>Class: " . $class_name . "</h3>";
  echo "<p class='text-xl text-red-600 font-bold'>No students are registered in this class</p>";
  echo "<button class='bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700'>
          <strong><a class='text-decoration-none text-white' href='../view/register_student_display.php'>Register Student</a></strong>
        </button>";
  echo "</div>";
} else {
  $students = $result->fetch_all(MYSQLI_ASSOC);
  $table = "<h3 class='text-center text-black text-3xl font-semibold'>Class: " . $class_name . "</h3>";

  // Table start with Materialize and Bootstrap classes
  $table .= "<table class='table table-bordered shadow-md rounded-lg w-full table-light mt-5'>";
  $table .= "<thead class='bg-info text-center'>";
  $table .= "<tr>";
  $table .= "<th scope='col'>Student Index Number</th>";
  $table .= "<th scope='col'>Student Name</th>";
  $table .= "<th>Actions</th>";
  $table .= "</tr>";
  $table .= "</thead>";
  $table .= "<tbody class='text-center'>";
  
  foreach ($students as $row) {
    $table .= "<tr>";
    $table .= "<td>" . $row["studentIndex"] . "</td>";
    $table .= "<td>" . $row["studentName"] . "</td>";
    $table .= "<td class='flex justify-center space-x-2'>
                  <button class='edit btn btn-info' data-student-id='" . $row['studentID'] . "' data-action-name='editName' style='background-color: #4f86f7;'>Edit Name</button>
                  <button class='edit btn btn-secondary' data-student-id='" . $row['studentID'] . "' data-action-name='editClass' style='background-color: #ffa500;'>Change Class</button>
                  <button class='delete btn btn-danger' data-student-id='" . $row['studentID'] . "' style='background-color: #e74c3c;'>Delete Student</button>
                  <a href='https://vm.tiktok.com/ZMk1ga6MH/' target='_blank' class='btn btn-primary' style='background-color: #007bff;'>Autism awareness meltdown TikTok Link</a>
                </td>";
    $table .= "</tr>";
  }
  $table .= "</tbody>";
  $table .= "</table>";

  // Add table to the page
  echo $table;
}

?>


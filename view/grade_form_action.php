<?php
session_start();
include "../functions/Allfunctions.php";
include "../settings/connection.php";

$term = $_POST["termname"];
$class = $_POST["classname"];
$subject = $_POST["subject"];
$assessment = $_POST["assessment"];

$classname = get_a_classname($class);
$termname = get_a_termname($term);
$subjectname = get_a_subjectname($subject);
$assessmentname = get_an_assessmentname($assessment);

$query = "SELECT * FROM `Student` WHERE `classID` = ?";
$query_prepare = $con->prepare($query);
$query_prepare->bind_param("i", $class);
$query_prepare->execute();
$query_excuted = $query_prepare->get_result();

if ($query_excuted->num_rows > 0) {
    $data = $query_excuted->fetch_all(MYSQLI_ASSOC);
    $stu_form = "<form action='../action/grade_action.php' method ='post' id='gradeForm'>";
    $stu_form .= "<table class='table table-info table-striped'>";
    $stu_form .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
    $stu_form .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
    $stu_form .= "<tr><th>Subject:</th><th>" . $subjectname . "</th></tr>";
    $stu_form .= "<tr><th>Assessment:</th><th>" . $assessmentname . "</th></tr>";
    $stu_form .= "</table>";
    $stu_form .= "<table class='table table-secondary'>";
    $stu_form .= "<tr><th>Student Name</th><th>Score/Marks</th></tr>";
    foreach ($data as $row) {
        $stu_form .= "<tr><td><input type='hidden' name='student[]' value='" . $row["studentID"] . "'>" . $row["studentName"] . "</td>";
        $stu_form .= "<td><input type='text' class='form-control' name='marks[]'></td></tr>";
    }
    $stu_form .= "</table>";
    $stu_form .= "<button type='submit' class='register btn btn-warning' name='grade'>Submit grades</button>";
    $stu_form .= "</form>";
    echo $stu_form;
} else {
    echo "<div class='text-center'><p>No students registered for this class. <a href='../view/register_student_display.php'>Register Students</a></p></div>";
}

$_SESSION["term"] = $term;
$_SESSION["class"] = $class;
$_SESSION["subject"] = $subject;
$_SESSION["assessment"] = $assessment;
?>

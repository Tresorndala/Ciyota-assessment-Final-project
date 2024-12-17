<?php

include "../functions/Allfunctions.php";

 // Include Composer Autoloader (for external packages like Guzzle or Symfony)

use Symfony\Component\VarDumper\VarDumper; // For better debugging

$classid = $termid = $subjectid = $assessmentid = "";

if (isset($_POST["termname"]) && isset($_POST["classname"]) && isset($_POST["subject"]) && isset($_POST["assessment"])) {

    // Sanitize user inputs for security
    $termid = filter_input(INPUT_POST, 'termname', FILTER_SANITIZE_NUMBER_INT);
    $classid = filter_input(INPUT_POST, 'classname', FILTER_SANITIZE_NUMBER_INT);
    $subjectid = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_NUMBER_INT);
    $assessmentid = filter_input(INPUT_POST, 'assessment', FILTER_SANITIZE_NUMBER_INT);
    $academicyear = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);

    // Fetch the names from the database
    $classname = get_a_classname($classid);
    $termname = get_a_termname($termid);
    $subjectname = get_a_subjectname($subjectid);
    $assessmentname = get_an_assessmentname($assessmentid);

    // Handle assessment grades
    if ($assessmentid != 6) {
        $class_assessment = grade($classid, $assessmentid, $termid, $subjectid, $academicyear);

        $stu_form = "<div class='container' style='background-color:#f0f8ff; padding:20px; border-radius:8px;'>";
        $stu_form .= "<div class='row'>";
        $stu_form .= "<div class='col'>";
        $stu_form .= "<table class='table table-striped' style='background-color:#e0ffff; border:1px solid #ccc;'>";
        $stu_form .= "<tr><th style='color:#4682b4;'>Class:</th><th>" . $classname . "</th></tr>";
        $stu_form .= "<tr><th style='color:#4682b4;'>Term:</th><th>" . $termname . "</th></tr>";
        $stu_form .= "<tr><th style='color:#4682b4;'>Subject:</th><th>" . $subjectname . "</th></tr>";
        $stu_form .= "<tr><th style='color:#4682b4;'>Assessment Name:</th><th>" . $assessmentname . "</th></tr>";
        $stu_form .= "<tr><th style='color:#4682b4;'>Academic Year:</th><th>" . $academicyear . "</th></tr>";
        $stu_form .= "</table>";
        $stu_form .= "</div></div>";

        // Display assessment results
        if (is_string($class_assessment)) {
            $stu_form .= "<div class='text-center'>";
            $stu_form .= "<h5 style='color:red; font-size:x-large; font-weight:bold;'>!!!" . $class_assessment . "</h5>";
            $stu_form .= "<button class='btn btn-primary' style='background-color:#20b2aa;'><strong><a class='text-decoration-none' href='../view/register_student_view.php' style='color:white;'>Register Student</a></strong></button></div>";
            echo $stu_form;
        } elseif (is_array($class_assessment) && empty($class_assessment)) {
            $stu_form .= "<div class='text-center'>";
            $stu_form .= "<h3 style='color:#ff6347; font-size:x-large; font-weight:bold;'>No assessment has been done</h3>";
            $stu_form .= "<button class='btn btn-warning' style='background-color:#ffa07a;'><strong><a class='text-decoration-none' href='../view/assigning_grade.php' style='color:white;'>Record grades</a></strong></button></div>";
            echo $stu_form;
        } else {
            $stu_form .= "<div class='row'>";
            $stu_form .= "<div class='col'>";
            $stu_form .= "<table class='table table-light table-bordered' style='background-color:#f5f5f5;'>";
            $stu_form .= "<tr><th style='color:#4682b4;'>Student Name</th><th style='color:#4682b4;'>Score/Marks</th><th style='color:#4682b4;'>Actions</th></tr>";

            foreach ($class_assessment as $student_grades) {
                foreach ($student_grades as $grade) {
                    $student = get_an_studendentname($grade["studentID"]);
                    $stu_form .= "<tr>";
                    $stu_form .= "<td>" . $student . "</td>";
                    $stu_form .= "<td>" . $grade["score"] . "</td>";
                    $stu_form .= "<td>
                    <button class='edit btn btn-info' style='background-color:#4682b4;' data-grade-id='" . $grade['gradeID'] . "'>Change Score</button>
                    <button class='delete btn btn-danger' style='background-color:#ff6347;' data-grade-id='" . $grade['gradeID'] . "'>Delete Score</button>
                    </td>";
                    $stu_form .= "</tr>";
                }
            }
            $stu_form .= "</table>";
            $stu_form .= "</div></div>";
            echo $stu_form;
        }
    } elseif ($assessmentid == 6) {
        // Enhanced SQL handling with prepared statements
        $table = "<div class='container' style='background-color:#f0f8ff; padding:20px; border-radius:8px;'>";
        $table .= "<div class='row'>";
        $table .= "<div class='col'>";
        $table .= "<table class='table table-striped' style='background-color:#e0ffff; border:1px solid #ccc;'>";
        $table .= "<tr><th style='color:#4682b4;'>Class:</th><th>" . $classname . "</th></tr>";
        $table .= "<tr><th style='color:#4682b4;'>Term:</th><th>" . $termname . "</th></tr>";
        $table .= "<tr><th style='color:#4682b4;'>Subject:</th><th>" . $subjectname . "</th></tr>";
        $table .= "<tr><th style='color:#4682b4;'>Assessment Name:</th><th>" . $assessmentname . "</th></tr>";
        $table .= "<tr><th style='color:#4682b4;'>Academic Year:</th><th>" . $academicyear . "</th></tr>";
        $table .= "</table>";
        $table .= "</div></div>";

        // Dynamically fetching assessment names for the SQL query
        $sql_assessment_names = "SELECT `assessmentName` FROM `Assessment`";
        $stmt_assessment_names = $con->query($sql_assessment_names);
        $assessment_names = [];
        while ($row = $stmt_assessment_names->fetch_assoc()) {
            $assessment_names[] = $row['assessmentName'];
        }

        // Dynamically creating SQL select clauses
        $select_statements = [];
        foreach ($assessment_names as $assessment_name) {
            $select_statements[] = "MAX(CASE WHEN Assessment.assessmentName = '$assessment_name' THEN Grade.score ELSE NULL END) AS '$assessment_name'";
        }

        $select_clause = implode(", ", $select_statements);

        $sql = "SELECT Student.studentName, $select_clause FROM `Grade`
        INNER JOIN `Student` ON Grade.studentID = Student.studentID
        INNER JOIN `Assessment` ON Grade.assessmentID = Assessment.assessmentID
        WHERE Student.classID = ? AND Grade.subjectID = ? AND Grade.termID = ? AND Grade.year =?
        GROUP BY Student.studentID";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("iiii", $classid, $subjectid, $termid, $academicyear);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $table .= "<tr><th style='color:#4682b4;'>Name</th>";
            foreach ($assessment_names as $assessment_name) {
                $table .= "<th style='color:#4682b4;'>$assessment_name</th>";
            }

            while ($row = $result->fetch_assoc()) {
                $table .= "<tr><td>" . $row['studentName'] . "</td>";
                foreach ($assessment_names as $assessment_name) {
                    $table .= "<td>" . $row[$assessment_name] . "</td>";
                }
                $table .= "</tr>";
            }

            $table .= "</table>";
            $table .= "</div></div>";
            echo $table;
        }
    }
}
?>

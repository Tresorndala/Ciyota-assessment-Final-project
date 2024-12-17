<?php
include "../settings/connection.php";
include "../functions/Allfunctions.php";

// Get the selected class, term, and academic year from the user
$classID = $_POST['student_class'];
$termID = $_POST['termname'];
$academicYear = $_POST["year"];
$termname = get_a_termname($termID);
$classname = get_a_classname($classID);

// Retrieve the list of distinct subject IDs from the Grade table
$sql_subjects = "SELECT DISTINCT `subjectID` FROM `Grade` WHERE `termID` = ? AND `year` = ?";
$stmt_subjects = $con->prepare($sql_subjects);
$stmt_subjects->bind_param("ii", $termID, $academicYear);
$stmt_subjects->execute();
$result_subjects = $stmt_subjects->get_result();
$subjectIDs = [];
while ($row_subject = $result_subjects->fetch_assoc()) {
    $subjectIDs[] = $row_subject['subjectID'];
}

// Retrieve grades for each student in the selected class
$result_students = get_all_student_class($classID);

while ($row_student = $result_students->fetch_assoc()) {
    $studentID = $row_student['studentID'];
    $studentName = $row_student['studentName'];

    $report = "<div class='head container bg-light'>
    <div class='text-center'>
    <h4><i> ciyota secondary school </i></h4>
    <img src=\"../images/logo.png\" alt='school logo'>
    <p> P.O. BOX WY 1658 <br> Kwangwali refugee camp</p>
    <p> 0542867505/0546761896<br><i>corburwasinternationalschool@gmail.com </i></p>
    <hr>
    <h5> END OF TERM REPORT</h5>";

    $report .= " <p><b>Name: $studentName</b></p>
    <p><b>Term: $termname</b> </p>
    <p> <b>Class: $classname</b> </p>
    <p> <b> Academic Year: $academicYear</b></p></div>";

    // Display table header
    $report .= "<table class='table table-striped table-bordered' style='border-color: #003366; background-color: #f0f8ff;'>";
    $report .= "<tr><th style='background-color: #00509e; color: white;'>Subject Name</th><th style='background-color: #00509e; color: white;'>Class Score</th><th style='background-color: #00509e; color: white;'>Exams Score</th><th style='background-color: #00509e; color: white;'>Total</th><th style='background-color: #00509e; color: white;'>Grade</th><th style='background-color: #00509e; color: white;'>Grade Title</th></tr>";

    // Retrieve grades for the student in the selected term and academic year
    foreach ($subjectIDs as $subjectID) {
        // Retrieve grades for the subject
        $sql_grades = "SELECT * FROM `Grade` WHERE `studentID` = ? AND `subjectID` = ? AND `termID` = ? AND year = ?";
        $stmt_grades = $con->prepare($sql_grades);
        $stmt_grades->bind_param("iiii", $studentID, $subjectID, $termID, $academicYear);
        $stmt_grades->execute();
        $result_grades = $stmt_grades->get_result();

        // Initialize variables for scores and grade calculation
        $classScore = 0;
        $examsScore = 0;
        $subject = get_a_subjectname($subjectID);

        // Iterate over each grade for the subject
        while ($grade_row = $result_grades->fetch_assoc()) {
            // Calculate class score (excluding exams)
            if ($grade_row['assessmentID'] != 3) { // Assuming assessmentID = 3 represents exams
                $classScore += $grade_row['score'];
            } else {
                // Calculate exams score (assumed to be 30% of the exams score category)
                $examsScore += $grade_row['score'] * 0.3;
            }
        }

        // Convert class score to a scale of 70
        $classScore = ($classScore / 80) * 70;

        // Calculate total score
        $totalScore = number_format(($classScore + $examsScore), 2);

        // Determine grade and grade title
        $grade = '';
        $gradeTitle = '';
        if ($totalScore >= 75) {
            $grade = 'A';
            $gradeTitle = 'Excellent';
        } elseif ($totalScore >= 65) {
            $grade = 'B';
            $gradeTitle = 'Very Good';
        } elseif ($totalScore >= 55) {
            $grade = 'C';
            $gradeTitle = 'Good';
        } elseif ($totalScore >= 45) {
            $grade = 'D';
            $gradeTitle = 'Satisfactory';
        } elseif ($totalScore >= 35) {
            $grade = 'E';
            $gradeTitle = 'Pass';
        } else {
            $grade = 'F';
            $gradeTitle = 'Fail';
        }

        // Display grade information in the table row
        $report .= "<tr>";
        $report .= "<td>$subject</td>";
        $report .= "<td>$classScore</td>";
        $report .= "<td>$examsScore</td>";
        $report .= "<td>$totalScore</td>";
        $report .= "<td>$grade</td>";
        $report .= "<td>$gradeTitle</td>";
        $report .= "</tr>";
    }

    // Close the table
    $report .= "</table> <br><br>";
    $report .= "<button data-student-id='$studentID' data-student-name='$studentName' class='register promoted btn btn-primary'>Promoted</button>";
    $report .= "<button class='register print btn btn-warning' onclick='printReport(this)'>Print Report</button>";
    $report .= "</div><br><br><br><br>";
    echo $report;
}
?>

<script>
function printReport(button) {
    var reportContainer = $(button).closest('.container').clone();   
    reportContainer.find(".register").remove();
    reportContainer.find('table').css('border-collapse', 'collapse').find('td, th').css('border', '1px solid #ddd');
    reportContainer.find(".register").remove();

    reportContainer.find('div').css({
        'width': '100%',
        'margin': '0',
        'padding': '10px',
        'display': 'flex',
        'flex-direction': 'column',
        'align-items': 'center',
        'text-align': 'center'
    });

    reportContainer.find('.school-info').css({
        'margin-right': '20px'
    });

    reportContainer.find('img').css({
        'max-width': '80%',
        'height': 'auto'
    });

    reportContainer.find('.table').css({
        'width': '95%',
        'border-collapse': 'collapse',
        'margin': '20px'
    });

    reportContainer.find('p').css({
        'margin': '0px'
    });

    reportContainer.find('.table th, .table td').css({
        'border': '1px solid #ddd',
        'padding': '8px',
        'text-align': 'left'
    });

    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(reportContainer.html());
    printWindow.document.close();
    printWindow.print();
}
</script>


<?php
include "../settings/connection.php";

session_start();

// Ensure required session variables are set
if (!isset($_SESSION["term"], $_SESSION["class"], $_SESSION["subject"], $_SESSION["assessment"], $_SESSION["user_id"])) {
    echo json_encode(['success' => false, 'message' => 'Session data is missing. Please try again.']);
    exit;
}

// Retrieve session variables
$term = $_SESSION["term"];
$class = $_SESSION["class"];
$subject = $_SESSION["subject"];
$assessment = $_SESSION["assessment"];
$user = $_SESSION["user_id"];
$currentYear = date("Y");

// Validate POST data
if (!isset($_POST["student"], $_POST["marks"])) {
    echo json_encode(['success' => false, 'message' => 'Form data is incomplete.']);
    exit;
}

$students = $_POST["student"];
$grades = $_POST["marks"];

if (count($students) !== count($grades)) {
    echo json_encode(['success' => false, 'message' => 'Mismatch between students and grades.']);
    exit;
}

// Prepare to store grades in the database
$studentGrades = [];
foreach ($students as $index => $studentName) {
    if (isset($grades[$index]) && is_numeric($grades[$index])) {
        $studentGrades[] = [
            'studentID' => $studentName,
            'grade' => $grades[$index],
        ];
    }
}

if (empty($studentGrades)) {
    echo json_encode(['success' => false, 'message' => 'No valid grades to record.']);
    exit;
}

// Use transaction for safer inserts
$con->begin_transaction();

try {
    $stmt = $con->prepare("
        INSERT INTO `Grade` (`assessmentID`, `studentID`, `subjectID`, `termID`, `score`, `year`, `teacherID`)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    foreach ($studentGrades as $studentGrade) {
        $stmt->bind_param(
            'isisiii',
            $assessment,
            $studentGrade['studentID'],
            $subject,
            $term,
            $studentGrade['grade'],
            $currentYear,
            $user
        );
        $stmt->execute();
    }

    $con->commit();
    echo json_encode(['success' => true, 'message' => 'Grades recorded successfully!']);
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>

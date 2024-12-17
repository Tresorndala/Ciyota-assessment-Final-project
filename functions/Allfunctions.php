<?php
// Include the database connection
include "../settings/connection.php";

// Class-function to get all in a selected class
function get_all_class($con) {
    // Query to fetch all classes
    $query = "SELECT * FROM `Class`";
    $executeQuery = $con->query($query);
    if ($executeQuery) {
        return $executeQuery->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

// Grade-function 
function grade($classid, $assessmentid, $termid, $subjectid, $year) {
    global $con;
    $studentList = get_all_student_class($classid);
    $gradeData = [];
    if ($studentList->num_rows === 0) {
        return "No students registered in this class.";
    } else {
        $studentRecords = $studentList->fetch_all(MYSQLI_ASSOC);
        foreach ($studentRecords as $record) {
            $studentId = $record["studentID"];
            $query = "SELECT * FROM `Grade` WHERE `assessmentID` = ? AND `termID` = ? AND `subjectID` = ? AND `studentID` = ? AND `year` = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("iiiii", $assessmentid, $termid, $subjectid, $studentId, $year);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $gradeData[] = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $gradeData;
    }
}
// Class function to get a class
function get_a_classname($classId) {
    global $con;
    $query = "SELECT `className` FROM `Class` WHERE `classID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $classId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return "Class not found. Please select a valid class.";
    } else {
        return $result->fetch_assoc()["className"];
    }
}
// Class-function to get an id of a class
function get_class_id($className) {
    global $con;
    $query = "SELECT `classID` FROM `Class` WHERE `className` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $className);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["classID"];
    }
    return null;
}

// Term-function to get a term
function get_all_term($con) {
    $query = "SELECT * FROM `Term`";
    $executeQuery = $con->query($query);
    if ($executeQuery) {
        return $executeQuery->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}
// Class- function to change a class
function get_change_class($studentId) {
    global $con;
    $query = "SELECT * FROM Student WHERE studentID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $studentData = $result->fetch_assoc();
        $currentClassId = $studentData['classID'];
        return get_a_classname($currentClassId);
    }
    return null;
}
// Class- function to get a ternmame
function get_a_termname($termId) {
    global $con;
    $query = "SELECT `termName` FROM `Term` WHERE `termID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $termId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return "Invalid term ID. Please select a valid term.";
    } else {
        return $result->fetch_assoc()["termName"];
    }
}
// grade- function to get a grade
function get_grade($gradeId) {
    global $con;
    $query = "SELECT `score` FROM `Grade` WHERE `gradeID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $gradeId);
    $stmt->execute();
    return $stmt->get_result();
}
// Class- function to change grade
function change_grade($gradeId, $newScore) {
    global $con;
    $query = "UPDATE `Grade` SET `score` = ? WHERE `gradeID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $newScore, $gradeId);
    return $stmt->execute();
}

// Student-function to get all students in a class
function get_all_student_class($classId) {
    global $con;
    $query = "SELECT * FROM `Student` WHERE `classID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $classId);
    $stmt->execute();
    return $stmt->get_result();
}

// Subject-related functions
function get_all_subject($con) {
    $query = "SELECT * FROM `Subjects`";
    $executeQuery = $con->query($query);
    if ($executeQuery) {
        return $executeQuery->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

function get_a_subjectname($subjectId) {
    global $con;
    $query = "SELECT `subjectName` FROM `Subjects` WHERE `subjectID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $subjectId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["subjectName"];
    }
    return null;
}
// student- function to get a student
function get_a_student($studentId) {
    global $con;
    $query = "SELECT * FROM `Student` WHERE `studentID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    return $stmt->get_result();
}
// Class-function to change a student
function change_student($studentId, $newName) {
    global $con;
    $query = "UPDATE `Student` SET `studentName` = ? WHERE `studentID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $newName, $studentId);
    return $stmt->execute();
}
// Class-related functions
function change_student_class($studentId, $newClassId) {
    global $con;
    $query = "UPDATE `Student` SET `classID` = ? WHERE `studentID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $newClassId, $studentId);
    return $stmt->execute();
}

function get_all_assessment($con) {
    $query = "SELECT * FROM `Assessment`";
    $executeQuery = $con->query($query);
    if ($executeQuery) {
        return $executeQuery->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

function get_an_assessmentname($assessmentId) {
    global $con;
    $query = "SELECT `assessmentName` FROM `Assessment` WHERE `assessmentID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $assessmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["assessmentName"];
    }
    return null;
}

function get_an_studendentname($studentId) {
    global $con;
    $query = "SELECT `studentName` FROM `Student` WHERE `studentID` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()["studentName"];
    }
    return null;
}

// Utility function
function generate_index() {
    return rand(1000, 9999); // Generate a random index
}
?>





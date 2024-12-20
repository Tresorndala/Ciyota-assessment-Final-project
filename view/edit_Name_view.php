<?php 
include "../functions/Allfunctions.php";

$studentid = $action = "";
$forms = "";  // Initialize the $forms variable

if (isset($_GET['id'])) {
    $studentid = $_GET["id"];
    $action = $_GET["name"];

    if ($action === "editName") {
        $result = get_a_student($studentid);
        if ($result) {
            $rows = $result->fetch_assoc();
            $forms = "<div class='container bg-light p-4 rounded'>";
            $forms .= "<form action='../action/edit action.php' method='post' class='editnameForm'>";
            $forms .= "<div class='form-group'>";
            $forms .= "<input type='hidden' name='action' value='editname'><br>";
            $forms .= "<input type='hidden' name='studentID' value='" . $studentid . "'><br>";
            $forms .= "<b><label for='StudentName'>Student Name</label></b>";
            $forms .= "<input type='text' class='form-control' id='StudentName' name='StudentName' value='" . $rows["studentName"] . "'>";
            $forms .= "<button type='submit' name='nameSubmit' class='btn btn-primary my-3'>Apply changes</button>";
            $forms .= "<button type='button' onclick='history.back()' class='btn btn-secondary my-3'>Cancel</button><br>";
            $forms .= "<br><br>";
            $forms .= "</div>";
            $forms .= "</form>";
            $forms .= "</div>";
        }
    } elseif ($action === "editclass") {
        $result = get_all_class($con);
        $current = get_change_class($studentid);
        
        if ($result) {
            $forms = "<div class='container bg-light p-4 rounded'>";
            $forms .= "<form action='../action/edit action.php' method='post' class='editnameForm'>";
            $forms .= "<div class='form-group'>";
            $forms .= "<b><div class='text-center text-dark' style='font-size:large;'>";
            $forms .= "<label for='currentClass'>Current Class: " . $current . " </label><br><br>";
            $forms .= "<input type='hidden' name='action' value='editclass'>";
            $forms .= "<input type='hidden' name='studentID' value='" . $studentid . "'>";
            $forms .= "<label for='student_class'>Change To</label>";
            $forms .= "</div><b>";
            $forms .= "<select class='form-control' id='student_class' name='student_class'>";
            foreach ($result as $row) {
                $forms .= "<option value='" . $row['classID'] . "'>" . $row["className"] . "</option>";
            }
            $forms .= "</select>";
            $forms .= "<button type='submit' name='classSubmit' class='btn btn-primary my-3'>Apply Changes</button>";
            $forms .= "<button type='button' class='btn btn-secondary my-3' onclick='history.back()'>Cancel</button><br>";
            $forms .= "<br><br>";
            $forms .= "</form>";
            $forms .= "</div>";
        }
    } 
    echo $forms;
} else {
    echo "not found";
}
?>

<!-- Add CSS and framework links here -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome CSS (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS (optional) -->
    <style>
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .btn {
            width: 150px;
            margin: 10px 5px;
        }
    </style>
</head>

<body>
    <!-- Optional: If you want a custom navbar or header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Student Management</a>
    </nav>

    <!-- Body content -->
    <div class="container">
        <!-- Forms dynamically generated by PHP code -->
        <!-- The PHP code will output the form here based on the action -->
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


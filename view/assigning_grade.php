<?php
include "../functions/Allfunctions.php";

include "../settings/core.php";
isLogin()
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/cb76afc7c2.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="../css/style.css" rel="stylesheet" />
  <title>Record Student Grades</title>
z
</head>

<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-4" id="side_nav">
      <div class="header-box mb-4">
        <img src="../images/logo.png" class="logo rounded mx-auto d-block" alt="logo">
      </div>
      <hr class="text-muted">

      <ul class="nav flex-column">
        <li class="nav-item"><a href="../view/class_view.php" class="nav-link text-white"><i class="fa-solid fa-people-group"></i> <b> Start to View Class</b></a></li>
        <li class="nav-item"><a href="../view/register_student_display.php" class="nav-link text-white"><i class="fa-solid fa-users"></i> <b>Proceed to Register Student</b></a></li>
        <li class="nav-item"><a href="../view/assigning_grade.php" class="nav-link text-white"><i class="fa-solid fa-file-pen"></i> <b>You can now Record Assessment</b></a></li>
        <li class="nav-item"><a href="../view/student_grades_recodedview.php" class="nav-link text-white"><i class="fa-solid fa-users-viewfinder"></i> <b>View Assessment Record</b></a></li>
        <li class="nav-item"><a href="../view/view_student_report.php" class="nav-link text-white"><i class="fa-solid fa-users-viewfinder"></i> <b>Generate and View Student Reports</b></a></li>
      </ul>

      <hr class="text-muted">
      <ul class="nav flex-column">
        <li class="nav-item"><a href="../view/Redirection_settings_form.php" class="nav-link text-white"><i class="fa-solid fa-house"></i> <b>Addings</b></a></li>
      </ul>
    </div>


    <nav class="navbar  fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div style="color: #b40c90; font-size:20px;">
        <b><i style="color: #28a745;">Student Assessment Portal</i></b>
</div>

<div class="dropdown">
  <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <b style="color: #28a745;"><?php echo $_SESSION["name"]; ?></b>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="../login/signout.php">Sign out</a></li>
  </ul>
</div>
</nav>

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light second-navbar">

  <form class="container-fluid justify-content-evenly" method="post" id="navform">
    <div class="container-fluid justify-content-evenly">

      <label for="classname"><b>Class Name</b></label>
      <select name="classname" id="classname" style="width:200px;">
        <option></option>
        <?php
        $result = get_all_class($con);
        foreach ($result as $row) {
          echo "<option value='{$row['classID']}'>{$row['className']}</option>";
        }
        ?>
      </select>

      <label for="termname"><b>Term</b></label>
      <select name="termname" id="termname">
        <option></option>
        <?php
        $result = get_all_term($con);
        foreach ($result as $row) {
          echo "<option value='{$row['termID']}'>{$row['termName']}</option>";
        }
        ?>
      </select>

      <label for="subject"><b>Subject Name</b></label>
      <select name="subject" id="subject">
        <option></option>
        <?php
        $result = get_all_subject($con);
        foreach ($result as $row) {
          echo "<option value='{$row['subjectID']}'>{$row['subjectName']}</option>";
        }
        ?>
      </select>

      <label for="assessment"><b>Assessment Name</b></label>
      <select name="assessment" id="assessment">
        <option></option>
        <?php
        $result = get_all_assessment($con);
        foreach ($result as $row) {
          echo "<option value='{$row['assessmentID']}'>{$row['assessmentName']}</option>";
        }
        ?>
      </select>

      <button type="submit" name="submitAssessment" id="pen-btn" class="btn btn-lg btn-info" style="background-color: #28a745;">Done</button>
    </div>
  </form>

</nav>

<div class="content" style="padding-top:50px;">
  <div class="container">
    <div class="row justify-content-center">
      <!-- Additional content can be added here -->
    </div>
  </div>
  <br><br>
</div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/grade.js"></script>







</body>

</html>
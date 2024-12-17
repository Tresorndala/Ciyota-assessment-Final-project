<?php
include "../functions/Allfunctions.php";

include "../settings/connection.php";

session_start();
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
  <title>Settings</title>

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
        <li class="nav-item"><a href="../view/student_grades_recodedview.php" class="nav-link text-white"><i class="fa-solid fa-users-viewfinder"></i> <b>You can View Assessment Record</b></a></li>
        <li class="nav-item"><a href="../view/view_student_report.php" class="nav-link text-white"><i class="fa-solid fa-users-viewfinder"></i> <b>Generate and View Student Reports</b></a></li>
      </ul>

      <hr class="text-muted">
      <ul class="nav flex-column">
        <li class="nav-item"><a href="../view/Redirection_settings_form.php" class="nav-link text-white"><i class="fa-solid fa-house"></i> <b>Addings</b></a></li>
      </ul>
    </div>



    <nav class="navbar  fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="d-flex justify-content-between">
        <a class="navbar-brand justify-content-between d-md-none d-block" href="#" style="color: #28a745;">coding lauge</a>
<button class="btn px-1 py-0 open-btn"><i class="fa fa-stream" style="color: #28a745;"></i></button>
</div>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
  <ul class="navbar-nav mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#" style="color: #28a745;">profile</a>
    </li>
  </ul>
</div>
</div>
</nav>

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light second-navbar container-fluid justify-content-evenly">

  <button data-action-name='Class Name' name="submit" class="add btn btn-lg btn-info btn-outline-dark"
    type="button" style="background-color: #28a745;">You can Add a class</button>
  <button data-action-name='Subject Name' name="submit" class="add btn btn-lg btn-info btn-outline-dark"
    type="button" style="background-color: #28a745;">You can Add a subject</button>
  <button data-action-name='Assessment Name' name="submit" class="add btn btn-lg btn-info btn-outline-dark"
    type="button" style="background-color: #28a745;">You can Add a category of assessment</button>
</nav>

<div class="content" style='padding-top:50px';>
  <div class="container">
    <div class="row justify-content-center">

    </div>
  </div>

  <br><br>
</div>
</div>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/settinngs.js"></script>

</body>

</html>
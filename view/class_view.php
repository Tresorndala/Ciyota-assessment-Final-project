<?php
include "../functions/Allfunctions.php";
include "../settings/core.php";
isLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Updated Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Tailwind CSS for better utility-based styling -->
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0"></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/cb76afc7c2.js" crossorigin="anonymous"></script>
  <!-- SweetAlert for alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Vue.js for dynamic form handling -->
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
  <!-- Custom Stylesheet -->
  <link href="../css/style.css" rel="stylesheet" />
  <title>View a Class</title>
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

    <!-- Main Content -->
    <div class="container-fluid flex-grow-1">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg" style="background-color: #28a745; color: white;">
        <div class="container-fluid">
          <div style="color: white; font-size:20px;">
            <b><i>Student Assessment Portal</i></b>
          </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <b><?php echo $_SESSION["name"]; ?></b>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../login/signout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Select Class Section -->
      <nav class="navbar navbar-expand-lg" style="background-color: #d4edda;">
        <form class="container-fluid justify-content-center" method="post" id="classform">
          <h5><b>Select a Class</b></h5>
          <div class="flex flex-col">
            <select name="student_class" id="student_class" class="form-select w-auto">
              <option value="">Select Class</option>
              <?php
              $result = get_all_class($con);
              foreach ($result as $row) {
                echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
              }
              ?>
            </select>
            <button type="submit" name="submit" class="btn btn-success btn-lg mt-4">Done</button>
          </div>
        </form>
      </nav>

      <div class="content py-4">
        <!-- Content here -->
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Sidebar JS -->
  <script src="../js/sidebar.js"></script>
  <!-- Custom JS -->
  <script src="../js/class.js"></script>

  <!-- Vue.js Example for Dynamic Form Handling -->
  <script>
    const app = Vue.createApp({
      data() {
        return {
          studentClass: '',
        };
      },
      methods: {
        handleSubmit() {
          if (this.studentClass) {
            document.getElementById('classform').submit();
          } else {
            Swal.fire({
              title: 'Error!',
              text: 'Please select a class.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        },
      },
    }).mount('#app');
  </script>
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>V-Learn </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../public/backend/vendors/feather/feather.css">
  <link rel="stylesheet" href="../public/backend/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../public/backend/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../public/backend/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../public/backend/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../public/backend/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../public/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../public/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../public/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="../public/backend/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../public/backend/css/style.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- endinject -->
  <link rel="shortcut icon" href="../public/backend/images/favicon.png" />
</head>

<?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): ?>
<body class="with-welcome-text">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="../public/backend/images/logo.svg" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="../public/backend/images/logo-mini.svg" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">Super Admin</span></h1>
              <h3 class="welcome-sub-text">Here's your users performance overview. </h3>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../public/backend/images/faces/face8.jpg" alt="Profile image">
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../public/backend/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 fw-semibold">Super Admin</p>
                  <p class="fw-light text-muted mb-0">superadmin@yopmail.com</p>
                </div>
                <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a> -->
                <a class="dropdown-item" href="logout.php">
                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">Management Section</li>
            <li class="nav-item <?php echo (CURRENT_PAGE == "users.php" || CURRENT_PAGE == "add_customer.php") ? 'active' : ''; ?>" >
              <a class="nav-link" data-bs-toggle="collapse" href="#subMenu" aria-expanded="false" aria-controls="subMenu">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="subMenu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="users.php">List</a></li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item <?php echo (CURRENT_PAGE == "courses.php" || CURRENT_PAGE == "add_courses.php") ? 'active' : ''; ?>" >
              <a class="nav-link" data-bs-toggle="collapse" href="#subMenu1" aria-expanded="false" aria-controls="subMenu1">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Courses</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="subMenu1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="courses.php">List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="add_courses.php">Add</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper">
            
        <?php endif;?>
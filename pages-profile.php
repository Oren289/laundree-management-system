<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css?v=<?php echo time(); ?>" rel="stylesheet" />

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/cc0302340a.js" crossorigin="anonymous"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

  <body>
    <?php
      session_start();
      error_reporting(E_ALL ^ E_NOTICE);

      if(!isset($_SESSION['username'])){
         header("Location:/tubes pemweb/pages-login.php");
      }

      echo $_SESSION['username'];

      include "koneksi.php";
      $number = 1;
      $username = $_SESSION['username'];

      $stmt = mysqli_prepare($conn, "select * from data_user where username=?");
      mysqli_stmt_bind_param($stmt, 's', $username);
      mysqli_stmt_execute($stmt);
      $hasil = mysqli_fetch_array(mysqli_stmt_get_result($stmt));

      
      if(!empty($_POST['username'])){
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];

        $stmt = mysqli_prepare($conn, "update data_user set email=?, no_telp=?, alamat=? where username=?");
        mysqli_stmt_bind_param($stmt, 'ssss', $email, $no_telp, $alamat, $username);
        mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        header("Location:/tubes pemweb/pages-profile.php");
      }
                    
   ?>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="pages-index.php" class="logo d-flex align-items-center">
          <img src="assets/img/washing-logo.png" alt="" />
          <span class="d-none d-lg-block"><span id="logo_name">Laun</span>dree</span>
        </a>
      </div>
      <!-- End Logo -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="assets/img/profile-img-pink.jpg" alt="Profile" class="rounded-circle" />
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']; ?></span>
            </a>
            <!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?php echo $hasil['username'];?></h6>
                <span><?php echo $hasil['email'];?></span>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a href="logout.php" class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
            <!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a href="pages-index.php" class="nav-link">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-request.php">
            <i class="fas fa-jug-detergent"></i>
            <span>Laundry Now</span>
          </a>
        </li>
        <!-- End Laundry Now Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-history.php">
            <i class="bi bi-list-ul"></i>
            <span>History</span>
          </a>
        </li>
        <!-- End Forms Nav -->
      </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="pages-index.php">Home</a></li>
            <li class="breadcrumb-item active">My Profile</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="assets/img/profile-img-pink.jpg" alt="Profile" class="rounded-circle" />
                <h2><?php echo $hasil['username'] ?></h2>
                <h3><?php echo $hasil['email'] ?></h3>
              </div>
            </div>
          </div>

          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>
                </ul>
                <div class="tab-content pt-2">
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Username</div>
                      <div class="col-lg-9 col-md-8"><?php echo $hasil['username'] ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?php echo $hasil['email'] ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone</div>
                      <div class="col-lg-9 col-md-8"><?php echo $hasil['no_telp'] ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8"><?php echo $hasil['alamat'] ?></div>
                    </div>
                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                    <form action="pages-profile.php" method="post">
                      <div class="row mb-3">
                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="username" type="text" class="form-control" id="username" value="<?php echo $hasil['username'] ?>" readonly/>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="text" class="form-control" id="email" value="<?php echo $hasil['email'] ?>" />
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="no_telp" type="text" class="form-control" id="no_telp" value="<?php echo $hasil['no_telp']; ?>" />
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Address</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="alamat" class="form-control" id="alamat" style="height: 100px"><?php echo $hasil['alamat']; ?></textarea>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>
                    
                    <!-- End Profile Edit Form -->
                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="pages-profile.php" method="post">

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password_baru" type="password" class="form-control" id="newPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="renewPassword">
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->
                    <?php
                      if(!empty($_POST['password_baru']) && !empty($_POST['password'])){
                        if($_POST['password_baru'] != $_POST['password']){
                            echo "Password tidak cocok!";
                        }else{
                            if(!empty($_POST['password'])){
                              $password = md5($_POST['password']);

                              $stmt = mysqli_prepare($conn, "update data_user set password=? where username=?");
                              mysqli_stmt_bind_param($stmt, 'ss', $password, $username);
                              mysqli_stmt_execute($stmt);
                              mysqli_close($conn);
                              header("Location:/tubes pemweb/pages-profile.php");
                            }
                        }
                      }
                    ?>
                  </div>
                </div>
                <!-- End Bordered Tabs -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>Oren289</span></strong
        >. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </footer>
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>

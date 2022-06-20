<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Laundree | Laundry Now</title>
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
      $query = mysqli_query($conn, "select * from data_laundry where username='$username'");
      $query2 = mysqli_query($conn, "select * from data_user where username='$username'");
      $hasil = mysqli_fetch_array($query2);

      if(!empty($_POST['alamat_request'])){
        $username = $_SESSION['username'];
        $tanggal_request = date("Y-m-d");
        $alamat_request = $_POST['alamat_request'];
        $status_request = "belum selesai";

        $stmt = mysqli_prepare($conn, "insert into request_jemput(username, tanggal_request, alamat_request, status_request) values (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $username, $tanggal_request, $alamat_request, $status_request);
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_fetch_array(mysqli_stmt_get_result($stmt));
        if($hasil != NULL){ ?>
          <script>
            preventDefault();
            alert('Request telah ditambahkan');
          </script>
        <?php 
        }
        mysqli_close($conn);
        header("Location:/tubes pemweb/pages-request.php");
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
                <h6><?php echo $_SESSION['username']; ?></h6>
                <span><?php echo $hasil['email']; ?></span>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="pages-profile.php">
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
      <?php
        if($hasil['no_telp'] == NULL || $hasil['alamat'] == NULL){ ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Please compelete your profile, otherwise your transaction will not be processed!
          </div>
        <?php }
      ?>

      <div class="pagetitle">
        <h1>Laundry Now</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="pages-index.php">Home</a></li>
            <li class="breadcrumb-item active">Laundry Now</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section dashboard">
        <div class="card">
          <div class="card-body request">
            <div class="row">
              <div class="col d-flex flex-column align-items-center">
                <i class="bi bi-geo-alt request_icon"></i>
                <h3>Antar Langsung ke Toko</h3>
                <p class="text-center">Jl Pesanggrahan Raya 28-29,<br>Dki Jakarta, Jakarta, 11610</p>
              </div>
              <div class="col d-flex flex-column align-items-center">
                <i class="bi bi-truck request_icon"></i>
                <h3>Request Penjemputan</h3>
                <p class="text-center">Tidak ingin repot-repot keluar rumah?<br>Minta kami untuk menjemput cucian anda dari rumah.</p>
                <div class="container d-flex justify-content-center align-items-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Request Langsung</button>
                  <!-- modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Request Langsung</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Pastikan alamat penjemputan sudah benar.</p>
                          <form action="" method="POST">
                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Alamat penjemputan:</label>
                              <textarea class="form-control" id="message-text" name="alamat_request"><?php echo $hasil['alamat'];?></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Jemput!</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end modal -->
                  <div class="mx-2">atau</div>
                  <a href="https://wa.me/085219850202" target="_blank" class="btn btn-success"><i class="bi bi-whatsapp"></i> Whatsapp</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- request history -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Request History</h5>
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Tanggal Penjemputan</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $number = 1;
                $query3 = mysqli_query($conn, "select * from request_jemput where username='$username'");
                foreach($query3 as $row){?>
                <tr>
                  <th scope="row"><?php echo $number ?></th>
                  <td><?php echo $row['tanggal_request'] ?></td>
                  <td><?php echo $row['alamat_request'] ?></td>
                  <td>
                    <?php
                      if($row['tanggal_jemput'] === '0000-00-00'){
                        echo "Belum dijemput";
                      }else{
                        echo $row['tanggal_jemput'];
                      }
                    ?>
                  </td>
                  <td><?php echo $row['status_request'] ?></td>
                </tr>
                <?php $number++; }?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end request history -->
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
    <!-- <script src="assets/js/script.js"></script> -->
  </body>
</html>

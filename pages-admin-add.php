<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Laundree | Add Data</title>
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
      $query = mysqli_query($conn, "select * from data_laundry");
      $query2 = mysqli_query($conn, "select * from data_user where username='$username'");
      $query3 = mysqli_query($conn, "select * from data_user where status='user'");
      $hasil = mysqli_fetch_array($query2);
      $hasil3 = mysqli_fetch_array($query3);
      $hasil2 = mysqli_fetch_array($query);

      if(!empty($_POST['username'])){
        $username = $_POST['username'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $jumlah_cucian = $_POST['jumlah_cucian'];
        $ket_cucian = $_POST['ket_cucian'];
        $berat_total = $_POST['berat_total'];
        $harga_total = intval($berat_total) * 5000;
        $proses_cucian = "on process";
        $status_pengembalian = "not returned";

        $stmt = mysqli_prepare($conn, "insert into data_laundry(username, tanggal_transaksi,jumlah_cucian, ket_cucian, berat_total, harga_total, proses_cucian, status_pengembalian) values (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssisidss', $username, $tanggal_transaksi, $jumlah_cucian, $ket_cucian, $berat_total, $harga_total, $proses_cucian, $status_pengembalian);
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);
        $a = mysqli_fetch_array($hasil);
        if($a != NULL){ ?>
           <script>
              alert("Data berhasil ditambahkan");
           </script>
        <?php }
        mysqli_close($conn);
        header("Location:/tubes pemweb/pages-admin-laundry.php");
      }?>

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
                <a class="dropdown-item d-flex align-items-center" href="pages-admin-profile.php">
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
          <a href="pages-admin.php" class="nav-link">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-admin-request.php">
            <i class="fas fa-jug-detergent"></i>
            <span>Request List</span>
          </a>
        </li>
        <!-- End Laundry Now Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-admin-laundry.php">
            <i class="fas fa-socks"></i>
            <span>Laundry Data</span>
          </a>
        </li>
        <!-- End Forms Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-admin-user.php">
            <i class="bi bi-people-fill"></i>
            <span>User Data</span>
          </a>
        </li>
        <!-- End Forms Nav -->

        <li class="nav-item">
          <a class="nav-link" href="pages-admin-admin.php">
            <i class="bi bi-file-person"></i>
            <span>Admin Data</span>
          </a>
        </li>
        <!-- End Forms Nav -->
      </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Add Data</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="pages-admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pages-admin-laundry.php">Laundry Data</a></li>
            <li class="breadcrumb-item active">Add Data</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">General Form Elements</h5>

          <!-- General Form Elements -->
          <form action="pages-admin-add.php" method="post">
            <div class="row mb-3">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <!-- <input type="text" class="form-control" name="username"> -->
                <select name="username" class="form-control" id="username">
                  <option value="" disabled selected hidden>Pilih username</option>
                  <?php foreach($query3 as $row) { ?>
                    <option value="<?= $row['username'] ?>"><?= $row['username'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="tdate" class="col-sm-2 col-form-label">Date</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal_transaksi">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Total Clothes</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="jumlah_cucian">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Add. Information</label>
              <div class="col-sm-10">
                <textarea name="ket_cucian" class="form-control" style="height: 100px"></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Total Weight</label>
              <div class="col-sm-10">
                <input class="form-control" type="number" name="berat_total">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Add Data</button>
            </div>
          </form>
        </div>
      </div>
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

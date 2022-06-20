<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Laundree | Admin Dashboard</title>
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
      $query3 = mysqli_query($conn, "select * from data_user");
      $hasil = mysqli_fetch_array($query2);
      $hasil3 = mysqli_fetch_array($query3);

      if(isset($_GET['id_request'])){
        $id_request = $_GET['id_request'];

        $stmt = mysqli_prepare($conn, "delete from request_jemput where id_request=?");
        mysqli_stmt_bind_param($stmt, 'i', $id_request);
        mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        header("Location:/tubes pemweb/pages-admin-request.php");
      }
   ?>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="pages-admin.php" class="logo d-flex align-items-center">
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
        <h1>Request List</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="pages-admin.php">Home</a></li>
            <li class="breadcrumb-item active">Request List</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section dashboard">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Request List</h5>

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="uncompleted-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="uncompleted" aria-selected="false">Uncompleted</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabContent">
              <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="all-tab">
                <h5 class="card-title">Request List</h5>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Tanggal Penjemputan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="requestTbody">
                    <?php
                    $number = 1;
                    $query4 = mysqli_query($conn, "select * from request_jemput");
                    foreach($query4 as $row){?>
                    <tr>
                      <th scope="row"><?php echo $number ?></th>
                      <td><?php echo $row['username'] ?></td>
                      <td><?php echo $row['tanggal_request'] ?></td>
                      <td><?php echo $row['alamat_request'] ?></td>
                      <td>
                        <?php
                          if($row['tanggal_pengembalian'] === '0000-00-00'){
                            echo "Belum dijemput";
                          }else{
                            echo $row['tanggal_jemput'];
                          }
                        ?>
                      </td>
                      <td>
                        <span class="badge bg-warning"><?php echo $row['status_request'] ?></span>
                      </td>
                      <td>
                        <a class="btn btn-primary aksiBtn" href="<?php echo "aksi-ganti-status.php?id_request=".$row['id_request']."&"."status_request=".$row['status_request']; ?>">Ganti Status</a>
                        <a class="btn btn-danger aksiBtn" href="<?php echo "pages-admin-request.php?id_request=".$row['id_request']; ?>">Hapus</a>
                      </td>
                    </tr>
                    <?php $number++; }?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="uncompleted-tab">
                <h5 class="card-title">Request List</h5>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Tanggal Penjemputan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="requestTbody">
                    <?php
                    $number = 1;
                    $query4 = mysqli_query($conn, "select * from request_jemput where status_request='belum selesai'");
                    foreach($query4 as $row){?>
                    <tr>
                      <th scope="row"><?php echo $number ?></th>
                      <td><?php echo $row['username'] ?></td>
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
                      <td>
                        <span class="badge bg-warning"><?php echo $row['status_request'] ?></span>
                      </td>
                      <td>
                        <a class="btn btn-primary aksiBtn" href="<?php echo "aksi-ganti-status.php?id_request=".$row['id_request']."&"."status_request=".$row['status_request']; ?>">Ganti Status</a>
                        <a class="btn btn-danger aksiBtn" href="<?php echo "pages-admin-request.php?id_request=".$row['id_request']; ?>">Hapus</a>
                      </td>
                    </tr>
                    <?php $number++; }?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="completed-tab">
                <h5 class="card-title">Request List</h5>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Tanggal Penjemputan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="requestTbody">
                    <?php
                    $number = 1;
                    $query4 = mysqli_query($conn, "select * from request_jemput where status_request='selesai'");
                    foreach($query4 as $row){?>
                    <tr>
                      <th scope="row"><?php echo $number ?></th>
                      <td><?php echo $row['username'] ?></td>
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
                      <td>
                        <span class="badge bg-warning"><?php echo $row['status_request'] ?></span>
                      </td>
                      <td>
                        <a class="btn btn-primary aksiBtn" href="<?php echo "aksi-ganti-status.php?id_request=".$row['id_request']."&"."status_request=".$row['status_request']; ?>">Ganti Status</a>
                        <a class="btn btn-danger aksiBtn" href="<?php echo "pages-admin-request.php?id_request=".$row['id_request']; ?>">Hapus</a>
                      </td>
                    </tr>
                    <?php $number++; }?>
                  </tbody>
                </table>
              </div>
            </div><!-- End Bordered Tabs -->

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
    <script src="assets/js/script2.js"></script>
  </body>
</html>

<?php
   session_start();
   include "koneksi.php";
   
   // $tanggal_pengembalian = NULL;
   // $status_request = NULL;

   if(isset($_GET['id_request']) && isset($_GET['status_request'])){
      $id_request = $_GET['id_request'];
      if($_GET['status_request'] == "belum selesai"){
         // var_dump($_GET);
         // exit;
         $tanggal_pengembalian = date("Y-m-d");
         $status_request = "selesai";
      }else{
         $tanggal_pengembalian = "0000-00-00";
         $status_request = "belum selesai";
      }

      $stmt = mysqli_prepare($conn, "update request_jemput set tanggal_jemput=? ,status_request=? where id_request=?");
      mysqli_stmt_bind_param($stmt, 'ssi', $tanggal_pengembalian, $status_request, $id_request);
      mysqli_stmt_execute($stmt);
      mysqli_close($conn);
      header("Location:/tubes pemweb/pages-admin-request.php");
   }
?>

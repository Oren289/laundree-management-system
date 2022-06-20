<?php
   session_start();
   include "koneksi.php";

   $username = $_POST['username'];
   $password = md5($_POST['password']);

   $stmt = mysqli_prepare($conn, "select * from data_user where username=? and password=?");
   mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
   mysqli_stmt_execute($stmt);
   $hasil = mysqli_stmt_get_result($stmt);
   $a = mysqli_fetch_array($hasil);
   if($a != NULL){
      $_SESSION['username'] = $a['username'];
      $_SESSION['status'] = $a['status'];
      if($_SESSION['status'] == "admin"){
         header("Location:/tubes pemweb/pages-admin.php");
      }else{
         header("Location:/tubes pemweb/pages-index.php");
      }
   }else{
      header("Location:/tubes pemweb/pages-login.php");
   }
?>
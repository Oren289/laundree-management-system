<?php
   error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
   $conn = mysqli_connect("localhost", "root", "", "laundry_db") or die("connection failed");
?>
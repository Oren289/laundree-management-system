<?php
   session_start();
   session_unset();
   session_destroy();
   header("Location:/tubes pemweb/pages-login.php");
?>
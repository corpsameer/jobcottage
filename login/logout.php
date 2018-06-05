<?php
 session_start();
// $_SESSION['phone_no']="";
unset($_SESSION['phone_no']);
 //session_destroy();
 header("Location:../index.php");
exit;
?> 
<?php
include("../database/connection.php");
@session_start();
$user_nam=mysqli_real_escape_string($con, $_REQUEST['uname']);
$pwd=mysqli_real_escape_string($con, $_REQUEST['pwd']);
$new_pwd=mysqli_real_escape_string($con, md5($pwd));
$result=mysqli_query($con, "select * from sv_admin_login where user_name='$user_nam' and password='$new_pwd'");
$row=mysqli_num_rows($result);
if($row==0)
		echo "*Invalid username or Password";
else
{
	$result=mysqli_query($con, "select * from sv_admin_login where user_name='$user_nam' and password='$new_pwd'");
	$row=mysqli_fetch_array($result);
	$_SESSION['user']=$row['user_name'];
			echo "welcome"; 
		
	}
?>
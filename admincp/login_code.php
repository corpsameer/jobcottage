<?php
include("../database/connection.php");
@session_start();
$user_nam=mysql_real_escape_string($_REQUEST['uname']);
$pwd=mysql_real_escape_string($_REQUEST['pwd']);
$new_pwd=mysql_real_escape_string(md5($pwd));
$result=mysql_query("select * from sv_admin_login where user_name='$user_nam' and password='$new_pwd'");
$row=mysql_num_rows($result);
if($row==0)
		echo "*Invalid username or Password";
else
{
	$result=mysql_query("select * from sv_admin_login where user_name='$user_nam' and password='$new_pwd'");
	$row=mysql_fetch_array($result);
	$_SESSION['user']=$row['user_name'];
			echo "welcome"; 
		
	}
?>
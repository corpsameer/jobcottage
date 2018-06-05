<?php
	include("../database/connection.php");
	@session_start();
	/*user not login and access this page it will going to index page*/
	if(!isset($_SESSION['user']))
		header("Location: index.php");
	/*user after login access this page*/
	else
	{
		$curpwd=mysqli_real_escape_string($con, $_REQUEST['curpwd']);
		$new=mysqli_real_escape_string($con, $_REQUEST['newpwd']);
		$conpwd=mysqli_real_escape_string($con, $_REQUEST['conpwd']);
		$user_name = mysqli_real_escape_string($con, $_SESSION["user"]);
		$genre = mysqli_real_escape_string($con, md5($curpwd));
		$new_pass = mysqli_real_escape_string($con, md5($new));
		$result = mysqli_query($con, "SELECT * FROM sv_admin_login where user_name='$user_name' and password='$genre'");
		$row=mysqli_fetch_array($result);
		if($row=="")
			echo "Invalid";
		else
		{
			mysqli_query($con, "UPDATE sv_admin_login SET password='$new_pass' where user_name='$user_name'");
				echo "success";
		}
	}
?>
<?php
@session_start();
$phone_no=$_SESSION['phone_no'];
include('../database/connection.php');

$name=mysqli_real_escape_string($con, $_REQUEST['name']);
$pno=$_REQUEST['pno'];
//$pno=$_REQUEST['phone_no'];
$email=mysqli_real_escape_string($con, $_REQUEST['email']);
$gender=mysqli_real_escape_string($con, $_REQUEST['gender']);
$type=mysqli_real_escape_string($con, $_REQUEST['action']);

$res=mysqli_query($con, "select * from sv_users where phone_no='$pno'");
$numrow=mysqli_num_rows($res);
if(!$numrow=="")
{	
	mysqli_query($con, "update sv_users set user_name='$name',phone_no='$pno',email='$email',gender='$gender' where phone_no='$phone_no'");		
			echo "Updated";
}
else
	echo "Error";	


?>
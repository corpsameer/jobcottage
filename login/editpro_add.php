<?php
@session_start();
$phone_no=$_SESSION['phone_no'];
include('../database/connection.php');

$name=mysql_real_escape_string($_REQUEST['name']);
$pno=$_REQUEST['pno'];
//$pno=$_REQUEST['phone_no'];
$email=mysql_real_escape_string($_REQUEST['email']);
$gender=mysql_real_escape_string($_REQUEST['gender']);
$type=mysql_real_escape_string($_REQUEST['action']);

$res=mysql_query("select * from sv_users where phone_no='$pno'");
$numrow=mysql_num_rows($res);
if(!$numrow=="")
{	
	mysql_query("update sv_users set user_name='$name',phone_no='$pno',email='$email',gender='$gender' where phone_no='$phone_no'");		
			echo "Updated";
}
else
	echo "Error";	


?>
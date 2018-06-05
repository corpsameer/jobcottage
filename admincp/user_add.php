<?php
include('../database/connection.php');
$type=$_REQUEST['typ'];
if($type=='update')
{
	$name=mysqli_real_escape_string($_POST['name']);
	$email_id=mysqli_real_escape_string($_POST['email_id']);
	$gender=mysqli_real_escape_string($_POST['gender']);
	$user_type=mysqli_real_escape_string($_POST['user_type']);
	$hid=mysqli_real_escape_string($_POST['hid']);
	if(mysqli_query($con, "update sv_users set user_name='$name',email='$email_id',gender='$gender',user_type='$user_type' where id='$hid'")) 
		$msg="Updated";
			header("Location:users.php?msg=".$msg);	
}
else if($type=='delete')
{
	$hid=mysqli_real_escape_string($con, $_REQUEST["hid"]);		
	if(mysqli_query($con, "delete from sv_users where id='$hid'")) 
		echo "Deleted";
}  

?>
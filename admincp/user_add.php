<?php
include('../database/connection.php');
$type=$_REQUEST['typ'];
if($type=='update')
{
	$name=mysql_real_escape_string($_POST['name']);
	$email_id=mysql_real_escape_string($_POST['email_id']);
	$gender=mysql_real_escape_string($_POST['gender']);
	$user_type=mysql_real_escape_string($_POST['user_type']);
	$hid=mysql_real_escape_string($_POST['hid']);
	if(mysql_query("update sv_users set user_name='$name',email='$email_id',gender='$gender',user_type='$user_type' where id='$hid'")) 
		$msg="Updated";
			header("Location:users.php?msg=".$msg);	
}
else if($type=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);		
	if(mysql_query("delete from sv_users where id='$hid'")) 
		echo "Deleted";
}  

?>
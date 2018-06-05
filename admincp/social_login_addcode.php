<?php
ob_start();
include('../database/connection.php');
@session_start();
$facebook=mysqli_real_escape_string($_POST['facebook']);
$twitter=mysqli_real_escape_string($_POST['twitter']);
$pinterest=mysqli_real_escape_string($_POST['pinterest']);
$google=mysqli_real_escape_string($_POST['google-plus']);
$linkedin=mysqli_real_escape_string($_POST['linkedin']);


$res=mysqli_query($con, "select * from sv_social_login");
$row=mysqli_num_rows($res);
$fet=mysqli_fetch_array($res);
echo $id=mysqli_real_escape_string($con, $fet['id']);
if($row=="0")
{
	if(mysqli_query($con, "insert into sv_social_login(facebook,twitter,google_plus,pinterest,linkedin)values('$facebook','$twitter','$google','$pinterest','$linkedin')"))
	{
		$msg="Inserted";
		header("Location:social_login.php?msg=".$msg);			
	}			
}
else
{	
	if(mysqli_query($con, "update sv_social_login set facebook='$facebook',twitter='$twitter',pinterest='$pinterest',google_plus='$google',linkedin='$linkedin' where id='$id'")) 
	{
		$msg="Updated";
		header("Location:social_login.php?msg=".$msg);
	}		
}
		

?>
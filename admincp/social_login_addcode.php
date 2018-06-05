<?php
ob_start();
include('../database/connection.php');
@session_start();
$facebook=mysql_real_escape_string($_POST['facebook']);
$twitter=mysql_real_escape_string($_POST['twitter']);
$pinterest=mysql_real_escape_string($_POST['pinterest']);
$google=mysql_real_escape_string($_POST['google-plus']);
$linkedin=mysql_real_escape_string($_POST['linkedin']);


$res=mysql_query("select * from sv_social_login");
$row=mysql_num_rows($res);
$fet=mysql_fetch_array($res);
echo $id=mysql_real_escape_string($fet['id']);
if($row=="0")
{
	if(mysql_query("insert into sv_social_login(facebook,twitter,google_plus,pinterest,linkedin)values('$facebook','$twitter','$google','$pinterest','$linkedin')"))
	{
		$msg="Inserted";
		header("Location:social_login.php?msg=".$msg);			
	}			
}
else
{	
	if(mysql_query("update sv_social_login set facebook='$facebook',twitter='$twitter',pinterest='$pinterest',google_plus='$google',linkedin='$linkedin' where id='$id'")) 
	{
		$msg="Updated";
		header("Location:social_login.php?msg=".$msg);
	}		
}
		

?>
<?php
ob_start();
include('../database/connection.php');

@session_start();
$phone_no=mysql_real_escape_string($_SESSION['phone_no']);
$res=mysql_fetch_array(mysql_query("select * from sv_shop where phone_no='$phone_no'"));
$shop_id=$res['id'];
$type=$_REQUEST['typ'];
if($type=='add')
{
	$sname=$_POST['services_name'];
	$price=$_POST['price'];
	$time=$_POST['time'];
	mysql_query("insert into sv_seller_services(services_id,price,time,phone_no,shop_id)values('$sname','$price','$time','$phone_no','$shop_id')");	
		$msg="Inserted";				
		header("Location:services.php?msg=".$msg);
}
else if($type=='update')
{
	$id=$_POST['id'];	
	$sname=$_POST['services_name'];
	$price=$_POST['price'];
	$time=$_POST['time'];
		mysql_query("update sv_seller_services set services_id='$sname',price='$price',time='$time',shop_id='$shop_id' where id='$id'");
			$msg="Updated";		
		header("Location:services.php?msg=".$msg);	
}	
else if($type=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);		
	if(mysql_query("delete from sv_seller_services where id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}
?>
<?php
ob_start();
include('../database/connection.php');

@session_start();
$phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);
$res=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where phone_no='$phone_no'"));
$shop_id=$res['id'];
$type=$_REQUEST['typ'];
if($type=='add')
{
	$sname=$_POST['services_name'];
	$price=$_POST['price'];
	$time=$_POST['time'];
	mysqli_query($con, "insert into sv_seller_services(services_id,price,time,phone_no,shop_id)values('$sname','$price','$time','$phone_no','$shop_id')");	
		$msg="Inserted";				
		header("Location:services.php?msg=".$msg);
}
else if($type=='update')
{
	$id=$_POST['id'];	
	$sname=$_POST['services_name'];
	$price=$_POST['price'];
	$time=$_POST['time'];
		mysqli_query($con, "update sv_seller_services set services_id='$sname',price='$price',time='$time',shop_id='$shop_id' where id='$id'");
			$msg="Updated";		
		header("Location:services.php?msg=".$msg);	
}	
else if($type=='delete')
{
	$hid=mysqli_real_escape_string($con, $_REQUEST["hid"]);		
	if(mysqli_query($con, "delete from sv_seller_services where id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}
?>
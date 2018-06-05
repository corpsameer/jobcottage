<?php
ob_start();
include('../database/connection.php');
@session_start();
$phone_no=mysql_real_escape_string($_SESSION['phone_no']);		

	$comment=$_POST['comment'];		
	$rating=$_POST['rating'];		
	$shop_id=$_POST['shop_id'];		
	$res=mysql_query("select * from sv_rating where phone_no='$phone_no' and shop_id='$shop_id'");
	$numrow=mysql_num_rows($res);
	if($numrow=="")
	{
		mysql_query("insert into sv_rating(comment,rating,phone_no,shop_id)values('$comment','$rating','$phone_no','$shop_id')");
			$msg="success";				
			header("Location:my_bookings.php?msg=".$msg);
	}
	else
	{
		mysql_query("update sv_rating set comment='$comment',rating='$rating',phone_no='$phone_no',shop_id='$shop_id' where shop_id='$shop_id'");
			$msg="success";		
		header("Location:my_bookings.php?msg=".$msg);
	}


?>
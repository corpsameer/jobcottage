<?php
ob_start();
include('../database/connection.php');
@session_start();
	$cur_date=date("Y-m-d");
	if(!isset($_SESSION['phone_no'])) { 
		$user_name=mysql_real_escape_string($_POST['name']);
		$phone_no=mysql_real_escape_string($_POST['pno']);
		$email=mysql_real_escape_string($_POST['email']);
		$password=mysql_real_escape_string($_POST['password']); 
		$pwd=md5($password);
		$gender=mysql_real_escape_string($_POST['gender']);
		$user_type=mysql_real_escape_string($_POST['user_type']);
		$res=mysql_query("select * from sv_users where phone_no='$phone_no'");
		$numrow=mysql_num_rows($res);
		if($numrow=="")
		{
			mysql_query("insert into sv_users(user_name,phone_no,email,password,gender,user_type,curr_date)values('$user_name','$phone_no','$email','$pwd','$gender','$user_type','$cur_date')");
			$msg="Inserted";
			$_SESSION['phone_no'] = $phone_no;
			header("Location:view_booking.php?msg=".$msg);	
		}
		else
		{
			$msg="Exist";
			header("Location:view_booking.php?msg=".$msg);	
		}
	}	
	$phone_no=mysql_real_escape_string($_SESSION['phone_no']);	
		
		
	$services = implode(",",$_POST["services"]);
	$shop_id=$_POST['hid'];	
	if($services=="")
	{	
		header("Location:view_booking.php?id=$shop_id&service_id=$services&msg=error ");	
	}
	else{
	
	$booking_date=date('Y-m-d',strtotime($_POST['datepicker']));	
	$booking_time=$_POST['time'];	
	
	$address=$_POST['address'];
	$city=$_POST['city'];
	$pin_code=$_POST['pin_code'];
	
	$payment_mode = mysql_real_escape_string($_POST['payment_mode']);
	
		/* $result=mysql_query("select * from sv_booking where status='pending' order by id desc");
		$numrow=mysql_num_rows($result);
		if($numrow==0)
		{	 */			
			mysql_query("insert into sv_booking (services_id,booking_date,booking_time,address,city,pin_code,phone_no,payment_mode,status,shop_id,currency,curr_date) values ('$services','$booking_date','$booking_time','$address','$city','$pin_code','$phone_no','$payment_mode','pending','$shop_id','$currency_mode','$cur_date')");		
			header("Location:view_booking.php?book_info");	
		/* }
		else
		{			
			mysql_query("update sv_booking set services_id='$services',booking_date='$booking_date',booking_time='$booking_time',phone_no='$phone_no',payment_mode='$payment_mode',status='pending',shop_id='$shop_id',currency='$currency_mode',curr_date='$cur_date' where status='pending'");
			header("Location:view_booking.php?book_info");	
		} */	
	}
	
	?>

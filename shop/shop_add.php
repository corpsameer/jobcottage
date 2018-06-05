<?php
ob_start();
include('../database/connection.php');
	require("../smtp/class.phpmailer.php");

@session_start();
	$phone_no=mysql_real_escape_string($_SESSION['phone_no']);			

$shop_name=mysql_real_escape_string($_POST['shop_name']);
$address=mysql_real_escape_string($_POST['shop_address']);
$city=mysql_real_escape_string($_POST['city']);
$pin_code=mysql_real_escape_string($_POST['pin_code']);
$country=mysql_real_escape_string($_POST['country']);
$state=mysql_real_escape_string($_POST['state']);
$shop_phone_no=mysql_real_escape_string($_POST['shop_phone_no']);
$desc=mysql_real_escape_string($_POST['shop_desc']);
//$gender=mysql_real_escape_string($_POST['gender']);
//$shop_date=mysql_real_escape_string($_POST['shop_date']);
$start_time=mysql_real_escape_string($_POST['start_time']);
$end_time=mysql_real_escape_string($_POST['end_time']);

$ids = implode(",",$_POST["check_list"]);

$opening_days=mysql_real_escape_string($_POST['opening_days']);
$booking_per_hour=mysql_real_escape_string($_POST['booking_per_hour']);
$res=mysql_query("select * from sv_shop where phone_no='$phone_no'");
$row=mysql_num_rows($res);
$fet=mysql_fetch_array($res);
$id=mysql_real_escape_string($fet['id']);

$old_file="shop-img/".$fet['cover_photo'];
$old_file1="shop-img/".$fet['profile_photo'];

$file_name = $_FILES['shop_cover_photo']['name'];
$file_name1 = $_FILES['shop_profile_photo']['name'];
$flag1=0;
$flag2=0;
if($file_name!="")
{
	$allowed =  array('jpeg','png' ,'jpg');	
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed)) 
	{
		$flag1="1";
		$msg1="error1";
	}
	else if($_FILES['shop_cover_photo']['size'] > 1048576)
	{
		$flag1="1";
		$msg1="error2";
	}	
}
if($file_name1!="")
{
	$allowed =  array('jpeg','png' ,'jpg');	
	$ext = pathinfo($file_name1, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed)) 
	{
		$flag1="1";
		$msg1="error1";
	}
	else if($_FILES['shop_profile_photo']['size'] > 1048576)
	{
		$flag1="1";
		$msg1="error2";
	}	
}


if($flag1=="0" && $flag2=="0")
{
	if($file_name!="")
	{
		$random_digit1=rand(0000,9999);
		$file_name= $random_digit1.$file_name;
 		$path= "shop-img/" .$file_name;
		move_uploaded_file($_FILES['shop_cover_photo']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   		 	unlink($old_file);
		}
	}
	else
	{
		$old_file=mysql_real_escape_string($fet['cover_photo']);
		$file_name=mysql_real_escape_string($old_file);
	}		
	if($file_name1!="")
	{
		$random_digit1=rand(0000,9999);
		$file_name1= $random_digit1.$file_name1;
 		$path= "shop-img/" .$file_name1;
		move_uploaded_file($_FILES['shop_profile_photo']["tmp_name"],$path);
		if (file_exists($old_file1))
		{
   		 	unlink($old_file1);
		}
	}
	else
	{
		$old_file1=mysql_real_escape_string($fet['profile_photo']);
		$file_name1=mysql_real_escape_string($old_file1);
	}		
	
	if($row=="0")		
	{			
		if(mysql_query("insert into sv_shop(shop_name,address,city,pin_code,country,state,shop_phone_no,description,shop_date,start_time,end_time,cover_photo,profile_photo,phone_no,featured,status,admin_email_status,booking_opening_days,booking_per_hour)values('$shop_name','$address','$city','$pin_code','$country','$state','$shop_phone_no','$desc','$ids','$start_time','$end_time','$file_name','$file_name1','$phone_no','no','unapproved','0','$opening_days','$booking_per_hour')"))
		{
			$subject = 'Shop Created Successfully'; 
			$shop = mysql_fetch_array(mysql_query("select * from sv_shop where phone_no='$phone_no' order by id DESC limit 1"));
			$shop_id=$shop['id'];
									
			if($shop_['start_time']>12)
			{
				$start=$shop['start_time']-12;
				$stime=$start."PM";
			}
			else
			{
				$stime=$shop['start_time']."AM";
			}
			if($shop['end_time']>12)
			{
				$end=$shop['end_time']-12;
				$etime=$end."PM";
			}
			else
			{
				$etime=$shop['end_time']."AM";
			}
			$sid=$shop['shop_date'];
			$sel=explode(",",$sid);
			$lev=count($sel);
				
			$cover_pic= mysql_real_escape_string($shop['cover_photo']);
			$cover_photo=$site_url. "shop/shop-img/$cover_pic"; 
			$gallery_pic= mysql_real_escape_string($shop['gallery']);
			$gallery=$site_url. "shop/shop-img/$gallery_pic"; 
			$message = '<!DOCTYPE HTML>'. 
			'<head>'. 
			'<meta http-equiv="content-type" content="text/html">'. 
			'</head>'. 
			'<body>'. 
			'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;font-family: Open Sans,Arial,sans-serif;">'. 
			'<img height="50" width="220" style="border-width:0" src="'.$logo.'" title="'.$site_name.'">'. 
			'</div>'. 
			'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
			'<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
			'<h3> '.$subject.'</h3>'.
			'<p> Shop Name - '.$shop['shop_name'].'</p>'. 
			'<p> Address - '.$shop['address'].'</p>'. 	
			'<p> City - '.$shop['city'].'</p>'. 	
			'<p> Pin Code - '.$shop['pin_code'].'</p>'. 	
			'<p> Country - '.$shop['country'].'</p>'. 	
			'<p> State - '.$shop['state'].'</p>'. 	
			'<p> Shop Phone No - '.$shop['shop_phone_no'].'</p>'. 	
			'<p> Description - '.$shop['description'].'</p>'. 	
			'<p> Shop Start Time - '.$stime.'</p>'. 	
			'<p> Shop End Time - '.$etime.'</p>'. 	
			'<p> Advance Booking Upto - '.$shop['booking_opening_days'].'</p>'. 	
			
			'<p> Allowed Booking Per Hour - '.$shop['booking_per_hour'].'</p>'. 


   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$user_det = mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$phone_no' order by id DESC limit 1"));
$to      = mysql_real_escape_string($user_det['email']);            
$subject = 'Shop Details - '.$site_name;  
$from    =  mysql_real_escape_string($admin_email);     
                    
$headers  = "From: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

if($mail_option=="smtp")
		{	
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = $smtp_host;

			$mail->SMTPAuth = true;
			$mail->Username = $smtp_uname;  // SMTP username
			$mail->Password = $smtp_pwd; // SMTP password
			$mail->From =$from;
			$mail->FromName = $site_name;
			$mail->AddAddress($to);
		
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			$mail->Header='Content-type: text/html; charset=iso-8859-1';
			if($mail->Send())
			{  
				//echo 'Email sent successfully';
			}								
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				//echo 'Email sent successfully!'; 
			}
		}	
		/*------------------admin email -------------------*/
		$subject = 'New Shop Created'; 		
			 
			$message = '<!DOCTYPE HTML>'. 
			'<head>'. 
			'<meta http-equiv="content-type" content="text/html">'. 
			'</head>'. 
			'<body>'. 
			'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;font-family: Open Sans,Arial,sans-serif;">'. 
			'<img height="50" width="220" style="border-width:0" src="'.$logo.'" title="'.$site_name.'">'. 
			'</div>'. 
			'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
			'<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
			'<h3> '.$subject.'</h3>'.
			'<p> Shop Name - '.$shop['shop_name'].'</p>'. 
			'<p> Address - '.$shop['address'].'</p>'. 	
			'<p> City - '.$shop['city'].'</p>'. 	
			'<p> Pin Code - '.$shop['pin_code'].'</p>'. 	
			'<p> Country - '.$shop['country'].'</p>'. 	
			'<p> State - '.$shop['state'].'</p>'. 	
			'<p> Shop Phone No - '.$shop['shop_phone_no'].'</p>'. 	
			'<p> Description - '.$shop['description'].'</p>'. 	
			'<p> Shop Start Time - '.$stime.'</p>'. 	
			'<p> Shop End Time - '.$etime.'</p>'. 	
			'<p> Advance Booking Upto - '.$shop['booking_opening_days'].'</p>'. 	
			'<p> Allowed Booking Per Hour - '.$shop['booking_per_hour'].'</p>'. 
 
   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$to      = mysql_real_escape_string($admin_email);            
$subject = 'New Shop Created - '.$site_name;  
$from    =  mysql_real_escape_string($admin_email);     
                    
$headers  = "From: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

if($mail_option=="smtp")
		{	
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = $smtp_host;

			$mail->SMTPAuth = true;
			$mail->Username = $smtp_uname;  // SMTP username
			$mail->Password = $smtp_pwd; // SMTP password
			$mail->From =$from;
			$mail->FromName = $site_name;
			$mail->AddAddress($to);
		
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			$mail->Header='Content-type: text/html; charset=iso-8859-1';
			if($mail->Send())
			{  
				//echo 'Email sent successfully';
			}								
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				//echo 'Email sent successfully!'; 
			}
		}	
		
			$msg="Inserted";
			header("Location:shop.php?msg=".$msg);			
		}			
	}
	else
	{
		if(mysql_query("update sv_shop set shop_name='$shop_name',address='$address',city='$city',pin_code='$pin_code',country='$country',state='$state',shop_phone_no='$shop_phone_no',description='$desc',shop_date='$ids',start_time='$start_time',end_time='$end_time',cover_photo='$file_name',profile_photo='$file_name1',phone_no='$phone_no',admin_email_status='0',booking_opening_days='$opening_days',booking_per_hour='$booking_per_hour' where id='$id'")) 
		{
			$msg="Updated";
			header("Location:shop.php?msg=".$msg);
		}		
	}
}
//if end		
else
{
	$error="";
	if($flag1=="1" && $flag2=="1") 
	{
		if($msg1=="error1" && $msg2=="error1") 
			$error="error";
		else if($msg1=="error2" && $msg2=="error2")
			$error="error1";
		else if($msg1=="error1" && $msg2=="error2")
			$error="error2";
		else if($msg1=="error2" && $msg2=="error1")
			$error="error3";
	}
	if($flag1=="1" && $flag2=="0")
	{
		if($msg1=="error1")
			$error="error4";
		else if($msg1=="error2")
			$error="error5";
	}
	else if($flag1=="0" && $flag2=="1")
	{
		if($msg2=="error1")
			$error="error6"; 
		else if($msg2=="error2")
			$error="error7"; 
	}		
	header("Location:shop.php?msg=".$error);	
}
?>
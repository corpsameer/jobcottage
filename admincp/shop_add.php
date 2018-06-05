<?php
ob_start();
include('../database/connection.php');
require("../smtp/class.phpmailer.php");
$type=$_REQUEST['typ'];
if($type=='update')
{
	$shop_name=mysql_real_escape_string($_POST['shop_name']);				
	$address=mysql_real_escape_string($_POST['address']);	
	$city=mysql_real_escape_string($_POST['city']);	
	$pin_code=mysql_real_escape_string($_POST['pin_code']);
	$country=mysql_real_escape_string($_POST['country']);	
	$state=mysql_real_escape_string($_POST['state']);	
	$shop_phone_no=mysql_real_escape_string($_POST['shop_phone_no']);	
	$description=mysql_real_escape_string($_POST['description']);	
	$status=mysql_real_escape_string($_POST['status']);		
	$featured=mysql_real_escape_string($_POST['featured']);	
	$hid=mysql_real_escape_string($_POST['hid']);
	if($status=='approved')
	{
		$query=mysql_fetch_array(mysql_query("select * from sv_shop where id='$hid'"));
		$email_status=$query['admin_email_status'];
		if($email_status==0)
		{	
			mysql_query("update sv_shop set shop_name='$shop_name',address='$address',city='$city',pin_code='$pin_code',country='$country',state='$state',shop_phone_no='$shop_phone_no',description='$description',status='$status',featured='$featured',admin_email_status='1' where id='$hid'"); 
		

$pno=$query['phone_no'];
$user=mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$pno'"));

$subject = 'Your Shop approved Successfully'; 
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
'<p> Shop Name - '.$query['shop_name'].'</p>'. 
'<p> City- '.$query['city'].'</p>'. 	
   
'</div>'.   
'</div>'. 

'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
'All rights reserved @ '.$site_name. 
'</div>'. 
'</body>'; 

$to      = mysql_real_escape_string($user['email']);             
$subject = 'Shop approved Successfully - '.$site_name; 
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
			$mail->Username = $smtp_uname; 
			$mail->Password = $smtp_pwd; 
			$mail->From =$from;
			$mail->FromName = $site_name;
			$mail->AddAddress($to);
		
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			$mail->Header='Content-type: text/html; charset=iso-8859-1';
			if($mail->Send())
			{  
				
			}								
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				
			}
		}	
	
		$msg="Updated";
			header("Location:shop.php?msg=".$msg);	
		}
	
	else {
		mysql_query("update sv_shop set shop_name='$shop_name',address='$address',city='$city',pin_code='$pin_code',country='$country',state='$state',shop_phone_no='$shop_phone_no',description='$description',status='$status',featured='$featured' where id='$hid'"); 
				$msg="Updated";
		header("Location:shop.php?msg=".$msg);	}
	}
	else if($status=='unapproved')
	{
		mysql_query("update sv_shop set shop_name='$shop_name',address='$address',city='$city',pin_code='$pin_code',country='$country',state='$state',shop_phone_no='$shop_phone_no',description='$description',status='$status',featured='$featured',admin_email_status='0' where id='$hid'"); 
				$msg="Updated";
		header("Location:shop.php?msg=".$msg);	
	}		
		
}
else if($type=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);		
	if(mysql_query("delete from sv_shop where id='$hid'")) 
		echo "Deleted";
}  

?>
<?php
ob_start();
@session_start();
include('../database/connection.php');
$name=mysqli_real_escape_string($con, $_POST['name']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$pho_no=mysqli_real_escape_string($con, $_POST['phone_no']);
$message=mysqli_real_escape_string($con, $_POST['message']);
$vendor_id=mysqli_real_escape_string($con, $_POST['vendor_id']);
require("../smtp/class.phpmailer.php");
mysqli_query($con, "insert into  sv_contact_vendor(name,phone_no,email,message,vendor_id)values('$name','$pho_no','$email','$message','$vendor_id')");
$query1=mysqli_fetch_array(mysqli_query($con, "select * from sv_admin_login"));
$site_url=mysqli_real_escape_string($con, $query1['site_url']);
$logo=mysqli_real_escape_string($con, $query1['logo']);
$imgSrc=$site_url."admincp/admin-logo/$logo";
$mail_option= mysqli_real_escape_string($con, $query1['mail_option']);
$contact=mysqli_fetch_array(mysqli_query($con, "select * from sv_contact_vendor order by id DESC limit 1"));		
$site_name = mysqli_real_escape_string($con, $query1['site_name']);
$subject= 'New Enquiry Received'; 
$name=mysqli_real_escape_string($con, $contact['name']); 
$email= mysqli_real_escape_string($con, $contact['email']); 
$pho_no=mysqli_real_escape_string($con, $contact['phone_no']); 
$msg=mysqli_real_escape_string($con, $contact['message']); 
$contact_vendor=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$vendor_id'"));
$vendor_pno=$contact_vendor['phone_no'];
$vendor_email=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$vendor_pno'"));
$vendor_email=$vendor_email['email'];

$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'</head>'. 
'<body>'. 
'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: #E0E0E0;font-family: Open Sans,Arial,sans-serif;">'. 
'<img height="50" width="220" style="border-width:0" src="'.$imgSrc.'" title="'.$site_name.'">'. 
'</div>'. 
'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
'<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
'<h3>'.$site_name.' - '.$subject.'</h3>'.
'<p> Name - '.$name.'</p>'. 
'<p> Email - '.$email.'</p>'.
'<p> Phone No - '.$pho_no.'</p>'.
'<p> Message - '.$msg.'</p>'.
'</div>'.   
'</div>'. 
'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
'All rights reserved @ '.$site_name. 
'</div>'. 
'</body>'; 


$to      = mysqli_real_escape_string($con, $vendor_email);              
$subject = 'New Enquiry Received - '.$site_name; 
$from    = mysqli_real_escape_string($con, $query1['email_id']);                              
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
				$msg="send";
				header("Location:shop.php?msg=".$msg);
			}
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				$msg="send";
				header("Location:shop.php?msg=".$msg);
			} 
		}
	

?>

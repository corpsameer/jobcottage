<?php
ob_start();
include('../database/connection.php');
require("../smtp/class.phpmailer.php");

$user_name=mysqli_real_escape_string($con, $_POST['user_name']);
$phone_no=mysqli_real_escape_string($con, $_POST['phone_no']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$password=mysqli_real_escape_string($con, $_POST['password']); 
$pwd=md5($password);
$gender=mysqli_real_escape_string($con, $_POST['gender']);
$user_type=mysqli_real_escape_string($con, $_POST['user_type']);

$cur_date=date("Y-m-d");
 $res=mysqli_query($con, "select * from sv_users where phone_no='$phone_no'");
$numrow=mysqli_num_rows($res);
if($numrow=="")
{
  mysqli_query($con, "insert into sv_users(user_name,phone_no,email,password,gender,user_type,curr_date)values('$user_name','$phone_no','$email','$pwd','$gender','$user_type','$cur_date')");
?>	
<!---------Mail function ------------>
<?php 

$subject = 'Account Details'; 
$message = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'</head>'. 
'<body>'. 
'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: #E0E0E0;font-family: Open Sans,Arial,sans-serif;">'. 
'<img height="50" width="220" style="border-width:0" src="'.$logo.'" title="'.$site_name.'">'. 
'</div>'. 
'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
'<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
'<h3> '.$subject.'</h3>'.
'<p> User Name - '.$phone_no.'</p>'. 
'<p> Password - '.$password.'</p>'. 	
   
'</div>'.   
'</div>'. 

'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
'All rights reserved @ '.$site_name. 
'</div>'. 
'</body>'; 
/*EMAIL TEMPLATE ENDS*/ 
$to      = mysqli_real_escape_string($con, $email);             // give to email address 
$subject = 'Account Details - '.$site_name;  //change subject of email 
$from    =  mysqli_real_escape_string($con, $admin_email);     
                     // give from email address 
// mandatory headers for email message, change if you need something different in your setting. 
$headers  = "From: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
// Remember, mail function may not work in PHP localhost setup but the email template can be used anywhere like (PHPmailer, swiftmailer, PHPMail classes etc.) 
// Sending mail 
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
		header("Location:login.php?msg=".$msg);	
}
else
{
	$msg="Exist";
	header("Location:login.php?msg=".$msg);	

}
?>

<?php
@session_start();
include('../database/connection.php');
//$phone_no=$_SESSION['phone_no'];
require("../smtp/class.phpmailer.php");

$name=mysql_real_escape_string($_REQUEST['name']);
$email=mysql_real_escape_string($_REQUEST['email']);
$pho_no=mysql_real_escape_string($_REQUEST['pho_no']);
$msg=mysql_real_escape_string($_REQUEST['msg']);
$type=mysql_real_escape_string($_REQUEST['action']);
if($type=='add')
{
mysql_query("insert into  sv_contact(name,email,contact_no,msg)values('$name','$email','$pho_no','$msg')");
$query1=mysql_fetch_array(mysql_query("select * from sv_admin_login"));
$site_url=mysql_real_escape_string($query1['site_url']);
$logo=mysql_real_escape_string($query1['logo']);
$imgSrc=$site_url."admincp/admin-logo/$logo";
$mail_option= mysql_real_escape_string($query1['mail_option']);
$contact=mysql_fetch_array(mysql_query("select * from sv_contact order by id DESC limit 1"));		
$site_name = mysql_real_escape_string($query1['site_name']);
$subject= 'New Enquiry Received'; 
$name=mysql_real_escape_string($contact['name']); 
$email= mysql_real_escape_string($contact['email']); 
$pho_no=mysql_real_escape_string($contact['contact_no']); 
$msg=mysql_real_escape_string($contact['msg']); 
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

$to      = mysql_real_escape_string($query1['email_id']);              
$subject = 'New Enquiry Received - '.$site_name; 
$from    = mysql_real_escape_string($query1['email_id']);                             
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
				echo 'success';
			}
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				echo 'success'; 
			} 
		}

}
else
echo "Error";
?>

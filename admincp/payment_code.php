<?php
include('../database/connection.php');
$type=mysql_real_escape_string($_REQUEST['action']);
require("../smtp/class.phpmailer.php");
 
if($type=='update')
{
	$hid=mysql_real_escape_string($_REQUEST['hid']);
	mysql_query("update sv_withdraw_request set status='completed' where id='$hid'");
	
	$sv_bal= mysql_fetch_array(mysql_query("select * from sv_withdraw_request where id='$hid'"));
	$final_bal=$sv_bal['shop_balance']-$sv_bal['withdraw_amt'];	
	
	mysql_query("update sv_withdraw_request set shop_balance='$final_bal' where id='$hid'");
	
	
	
		$subject = 'Withdrawal Request Approved'; 
			$sv_withdraw = mysql_fetch_array(mysql_query("select * from sv_withdraw_request where id='$hid'"));
			$shop_id=$sv_withdraw['shop_id'];
			$sv_shop = mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id'"));
			$pno=$sv_shop['phone_no'];			
			$sv_email= mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$pno' "));
			$vendor_email=$sv_email['email'];
			
		$subject = 'Withdrawal Request Approved'; 		
			 
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
			'<p> Withdraw Amount- '.$sv_withdraw['withdraw_amt'].' '.$currency_mode.'</p>'. 
			'<p> Withdraw Mode - '.$sv_withdraw['withdraw_mode'].'</p>'. 	
			'<p> Paypal Id - '.$sv_withdraw['paypal_id'].'</p>'. 	
			'<p> Bank Account No - '.$sv_withdraw['bank_acc_no'].'</p>'. 	
			'<p> Bank Details - '.$sv_withdraw['bank_info'].'</p>'. 	
			'<p> IFSC Code - '.$sv_withdraw['ifsc_code'].'</p>'. 	
			'<p> Shop Name - '.$sv_shop['shop_name'].'</p>'. 	
			

   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$to      = mysql_real_escape_string($vendor_email);            
$subject = 'Withdrawal Request Approved- '.$site_name;  
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
				//echo "sent";
			}								
		}
		else 
		{
			if(mail($to, $subject, $message, $headers)) 
			{ 
				//echo "sent";
			}
		}
	

		echo "Updated";
	
}
else 
		echo "Error";  
?>
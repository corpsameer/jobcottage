<?php
ob_start();
include('../database/connection.php');
@session_start();
require("../smtp/class.phpmailer.php");
$user_name=$_SESSION['phone_no'];	
$current_shop_id= mysql_fetch_array(mysql_query("select * from sv_shop where phone_no='$user_name' "));
$sv_current_shop_id=$current_shop_id['id'];

$type=mysql_real_escape_string($_REQUEST['action']);
if($type=='add')
{
	$shop_balance=$_REQUEST['shop_balance'];
	$withdraw_amt=$_REQUEST['withdraw_amt'];
	$withdraw_mode=$_REQUEST['withdraw_mode'];
	$paypal_id=$_REQUEST['paypal_id'];
	$payu_id=$_REQUEST['payu_id'];
	$stripe_id=$_REQUEST['stripe_id'];
	$bank_acc_no=$_REQUEST['bank_acc_no'];
	$bank_name=$_REQUEST['bank_name'];
	$ifsc_code=$_REQUEST['ifsc_code'];
	$shop_id=$_REQUEST['shop_id'];
	$total_bal=$shop_balance;
	if($admin_withdraw_amt<=$withdraw_amt && $shop_balance>=$withdraw_amt)
	{
				
		mysql_query("insert into sv_withdraw_request(shop_balance,withdraw_amt,total_bal,withdraw_mode,paypal_id,payu_id,stripe_id,
		bank_acc_no,bank_info,ifsc_code,shop_id,status)values('$shop_balance','$withdraw_amt','$total_bal','$withdraw_mode',
		'$paypal_id','$payu_id','$stripe_id','$bank_acc_no','$bank_name','$ifsc_code','$shop_id','pending')");
		echo "Inserted";
						
			$subject = 'Withdrawal Request'; 
			$sv_withdraw = mysql_fetch_array(mysql_query("select * from sv_withdraw_request where shop_id='$sv_current_shop_id' order by id DESC limit 1"));
			$shop_id=$sv_withdraw['shop_id'];
			$sv_shop = mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id'"));
			
		$subject = 'Withdrawal Request'; 		
			 
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
            '<p> Payumoney Id - '.$sv_withdraw['payu_id'].'</p>'.	
            '<p> Stripe Id - '.$sv_withdraw['stripe_id'].'</p>'.			
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
$to      = mysql_real_escape_string($admin_email);            
$subject = 'New Withdrawal Request- '.$site_name;  
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
			
	
		
		}	
		else
		{
			echo "error";
		}	
	}
	
?>
<?php
include ('../database/connection.php');
 include("../header.php");
 $phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);		
 $logo=$res['site_url'] . "admincp/img/$logo1"; 
?>
<section class="teaser bg-top ">
 <div class="min-space"></div><div class="min-space"></div><div class="min-space"></div>
 <h3 class="sub-title">Payment Success</h3>
<div class="min-space"></div>
<div class="min-space"></div>
</section>
<?php
//Store transaction information from Payumoney
$item_number = $_GET['cid']; 
$txn_id = $_GET['txnid'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['currency'];
$payment_status = $_GET['st'];

	mysqli_query($con, "update sv_booking set status='paid',currency='$currency_code',payu_token='$txn_id' where id='$item_number'");
	
		$fet=mysqli_fetch_array(mysqli_query($con, "select * from sv_booking where phone_no='$phone_no' order by id DESC limit 1"));
	$last_id=$fet['id'];
	
	$last_shop_id=$fet['shop_id'];
		$fet1=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$last_shop_id'"));
		$pno=$fet1['phone_no'];
		$fet2=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$pno'"));
		$seller_email=$fet2['email'];
		
		require("../smtp/class.phpmailer.php");
		/*----------------------------user email--------------------------*/
		 $subject = 'Payment Details'; 
			$booking_query = mysqli_fetch_array(mysqli_query($con, "select * from sv_booking where phone_no='$phone_no' order by id DESC limit 1"));
			$sid=$booking_query['services_id'];
			$booking_time=$booking_query['booking_time'];
			if($booking_time>12)
			{
				$final_time=$booking_time-12;
				$final_time=$final_time."PM";
			}
			else
			{
				$final_time=$booking_time."AM";
			}
			$query2=mysqli_fetch_array(mysqli_query($con, "select * from sv_services where id='$sid'"));
			 $sel=explode("," , $sid);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";
			for($i=0;$i<$lev;$i++)
			{
				 $id=$sel[$i];	
                
					if($lang==$en)
						{
							$ser_id="id";
							}
							else
							{
							$ser_id="page_parent";
							}

				
				$res1=mysqli_query($con, "select * from sv_services where $ser_id='$id'");
				$fet1=mysqli_fetch_array($res1);
				$ser_name.=$fet1['services_name'].'<br>';
				$ser_name.=",";
				$ser_name=trim($ser_name,",");
			}
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
			'<p> Booking Id - '.$last_id.'</p>'. 	
			'<p> Services Name - '.$ser_name.'</p>'. 
			'<p> Booking Date - '.$booking_query['booking_date'].'</p>'. 	
			'<p> Booking Time - '.$final_time.'</p>'. 	
			'<p> Address - '.$booking_query['address'].'</p>'. 
			'<p> City - '.$booking_query['city'].'</p>'. 
			'<p> Pin Code - '.$booking_query['pin_code'].'</p>'. 
			'<p> Total Amount - '.$booking_query['total_amt'].' '.$booking_query['currency'].'</p>'. 	
			   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
		
$user_det = mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no' order by id DESC limit 1"));
$to      = mysqli_real_escape_string($con, $user_det['email']);            
$subject = 'Booking Details - '.$site_name;  
$from    =  mysqli_real_escape_string($con, $admin_email);     
                    
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
		/*----------------------admin email--------------------------*/
		$subject = 'Booking Details'; 			
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
			'<p> Booking Id - '.$last_id.'</p>'. 	
			'<p> Services Name - '.$ser_name.'</p>'. 
			'<p> Booking Date - '.$booking_query['booking_date'].'</p>'. 	
			'<p> Booking Time - '.$final_time.'</p>'. 	
			'<p> Address - '.$booking_query['address'].'</p>'. 
			'<p> City - '.$booking_query['city'].'</p>'. 
			'<p> Pin Code - '.$booking_query['pin_code'].'</p>'. 
			'<p> Total Amount - '.$booking_query['total_amt'].' '.$booking_query['currency'].'</p>'. 	
			   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$to      = mysqli_real_escape_string($con, $admin_email);            
$subject = 'New Payment Received  - '.$site_name;  
$from    =  mysqli_real_escape_string($con, $admin_email);     
                    
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
		/*------------------------seller email------------------------*/
		$subject = 'Booking Details'; 
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
			'<p> Booking Id - '.$last_id.'</p>'. 	
			'<p> Services Name - '.$ser_name.'</p>'. 
			'<p> Booking Date - '.$booking_query['booking_date'].'</p>'. 	
			'<p> Booking Time - '.$final_time.'</p>'. 	
			'<p> Address - '.$booking_query['address'].'</p>'. 
			'<p> City - '.$booking_query['city'].'</p>'. 
			'<p> Pin Code - '.$booking_query['pin_code'].'</p>'. 
			'<p> Total Amount - '.$booking_query['total_amt'].' '.$booking_query['currency'].'</p>'. 	
			   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$to      = mysqli_real_escape_string($con, $seller_email);            
$subject = 'New Payment Received - '.$site_name;  
$from    =  mysqli_real_escape_string($con, $admin_email);     
                    
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
	
?>
<div class="min-space"></div>
	<div class="container text-center">
	<h1 class="success-msg">Your payment has been successful.</h1>
    <h1 class="success-msg">Your Payment ID - <?php echo $txn_id; ?>.</h1>
	</div>
	<div class="min-space"></div>

<?php include("../footer.php")?>
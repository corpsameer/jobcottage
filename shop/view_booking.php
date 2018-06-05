<?php 
include('../header.php');
?>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
	$phone_no=mysqli_real_escape_string($_SESSION['phone_no']);			
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no'"));
}
if(isset($_REQUEST['id']))
	{		
		$id=mysqli_real_escape_string($con, $_REQUEST['id']);	
	}
	else
	{$id="";}
if(isset($_REQUEST['service_id']))
	{		
		$sv_service_id=mysqli_real_escape_string($con, $_REQUEST['service_id']);	
	}
	else
	{$service_id="";}
?>


<div class="container">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		
		if($msg=="Inserted")
		{
		     echo '<div class="succ-msg"> Your Account Details Inserted Successfully.</div>';		
		}
		else if($msg=="Exist")
		{
			echo '<div class="succ-msg">Password changed successfully</div>';
		}
		else if($msg=="error")
		{
			echo '<div class="succ-msg">Plese select services </div>';
		}
			
				
}
else
	$msg="";
?>
</div>
<?php 
$shop_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$id'"));
$id=$shop_query['id'];
$pno=$shop_query['phone_no'];
?>

<?php
if(!isset($_REQUEST['book_info']) && !isset($_REQUEST['total']))
	{
?>
<div class="container">
<div class="col-md-12">
<div class="row">

<?php
if($shop_query['cover_photo']=="")
{
?>
	<div class="cover_pic col-md-12" style="background-image:url(<?php echo $site_url; ?>shop/shop-img/shop-default.jpg);"></div>
<?php } else { ?>
	<div class="cover_pic col-md-12" style="background-image:url(<?php echo $site_url; ?>shop/shop-img/<?php echo $shop_query['cover_photo']; ?>);"></div>
<?php } ?>
<div class="shop_name col-md-12"><?php echo $shop_query['shop_name']; ?></div>
</div>
</div>
</div>
<?php } ?>



	
	<?php
if(isset($_REQUEST['book_info']) )
	{
?>
<div class="container payment-main">
<h2><?php echo get_record(234,$lang,$en,$con);?></h2>
	<div class="col-md-6">
		<h4><?php echo $shop_query['shop_name']; ?></h4>
		<?php 
		$book_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_booking where status='pending' order by id DESC"));
		$sid=$book_query['services_id'];
		 $booking_time=$book_query['booking_time'];
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}

		?>
				
			<p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_record(235,$lang,$en,$con);?> - <?php echo $book_query['booking_date']; ?></p>
			<p> <i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo get_record(236,$lang,$en,$con);?> - <?php echo $final_time; ?></p>
		
	</div>
	
	<div class="col-md-6 service_style">
		<?php 
			//$service_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_services where id='$sid'"));
			
			$ser_id=mysqli_real_escape_string($book_query['services_id']);
			$sel=explode("," , $ser_id);
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

				
				$res1=mysqli_query($con, "select * from sv_services where $ser_id='$id' and lang_code='$lang'");
				$fet1=mysqli_fetch_array($res1);
				$ser_name.=$fet1['services_name'].'<br>';
				$ser_name.=",";
								
				$res2=mysqli_query($con, "select * from sv_seller_services where services_id='$id'");
				$fet2=mysqli_fetch_array($res2);
				 $price.=$fet2['price'].'<br>';
				$price.=","; 
				
				$ser_name=trim($ser_name,",");
				$price=trim($price,",");	
				$sum+=$fet2['price'];
			}
			
			 if($commission_mode=="fixed")
				{
					$sum=$sum+$commission_amt;
				}
				else if($commission_mode=="percentage")
				{
					$sum1=($commission_amt * $sum) / 100;
					$sum=$sum+$sum1;
				}
				else
				{
					$sum+=$fet2['price'];
				} 
				
			$_SESSION['sum']=$sum;	
		?>
		
		  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th><?php echo get_record(237,$lang,$en,$con);?></th>
					<th><?php echo get_record(196,$lang,$en,$con);?></th>
					 <th><?php echo get_record(238,$lang,$en,$con);?></th>
                </tr>
            </thead>
			<tbody>			
			<tr>
				<td><?php echo $ser_name; ?></td>
				<td><?php echo $price; ?></td>
				<td> <?php echo $commission_amt; ?> (<?php echo $commission_mode; ?>)</td>

			</tr>
			<td class="total-charge" colspan="2"><?php echo get_record(239,$lang,$en,$con);?></td><td class="total-charge"><?php echo $sum; ?>&nbsp;<?php echo $currency_mode; ?></td>
			</tbody>
															
            </table>
			
	</div>
	
	
	
	</div>
<br>

<div class="container">
<div class="col-md-8"></div>
<!--<a href="view_booking.php?total=<?php echo $sum; ?>"><button type="submit" value="PROCEED TO CHECKOUT" class="booknow right">PROCEED TO CHECKOUT</button></a>-->
<div class="col-md-4">
<a href="view_booking.php?total"><button type="submit" value="PROCEED TO CHECKOUT" class="booknow right"><?php echo get_record(240,$lang,$en,$con);?></button></a>
</div>
</div>
<?php } ?>

<?php
if(isset($_SESSION['sum'])) {
if(isset($_REQUEST['total']))
	{	
		//$total_amt = $_REQUEST['total'];
		$total_amt=mysqli_real_escape_string($_SESSION['sum']);
		
		$fet=mysqli_fetch_array(mysqli_query($con, "select * from sv_booking  where phone_no='$phone_no' order by id DESC limit 1"));
		$last_id=$fet['id'];
		
		$res=mysqli_query($con, "update sv_booking set total_amt='$total_amt' where phone_no='$phone_no' and id='$last_id'");	
		
		$last_shop_id=$fet['shop_id'];
		$fet1=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$last_shop_id'"));
		$pno=$fet1['phone_no'];
		$fet2=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$pno'"));
		$seller_email=$fet2['email'];
		
		
		require("../smtp/class.phpmailer.php");
		/*----------------------------user email--------------------------*/
		 $subject = 'Booking Details'; 
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
			'<p> Total Amount - '.$booking_query['total_amt'].' '.$booking_query['currency'].' </p>'. 	
			   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
		
		
$user_det = mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no'"));
$to      = mysqli_real_escape_string($user_det['email']);            
$subject = 'Booking Details - '.$site_name;  
$from    =  mysqli_real_escape_string($admin_email);     
                    
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
			'<p> Booking Time - '.$final_time.' </p>'. 	
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
$to      = mysqli_real_escape_string($admin_email);            
$subject = 'New Order Received  - '.$site_name;  
$from    =  mysqli_real_escape_string($admin_email);     
                    
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
			'<p> Total Amount - '.$booking_query['total_amt'] .' '.$booking_query['currency'].'</p>'. 	
			   
		'</div>'.   
		'</div>'. 

		'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
		'All rights reserved @ '.$site_name. 
		'</div>'. 
		'</body>'; 
$to      = mysqli_real_escape_string($seller_email);            
$subject = 'New Order Received - '.$site_name;  
$from    =  mysqli_real_escape_string($admin_email);     
                    
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

/*---------------Email end-----------------*/
	$last_id=$fet['id'];
		$_SESSION['id'] = $last_id;
		$payment_mode=$fet['payment_mode'];
		if($payment_mode=='cash')
		{
			mysqli_query($con, "update sv_booking set status='paid' where id='$last_id'");
		}
		if($payment_mode=='paypal')
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=payment.php">';	
		}
		if($payment_mode=='payumoney')
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=payupayment.php">';	
		}
		
		if($payment_mode=='stripe')
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=stripepayment.php">';	
		}
		
		

?>
<?php if($payment_mode=='cash') {
mysqli_query($con, "update sv_booking set status='paid' id='$last_id' where phone_no='$phone_no'");
	?>
<div class="container">
	<div class="succ-msg">
	Your booking was saved successfully.<br>
	Booking Id - <?php echo $last_id; ?>
	</div>
	</div>
<?php } ?>


<?php } }?>
	
	
<?php
if(!isset($_REQUEST['book_info']) && !isset($_REQUEST['total']))
	{
?>

<?php 
$sv_count="";
$sv_per_hour=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$id'"));
$booking_per_hour=$sv_per_hour['booking_per_hour'];
	
	
?>



<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="booking_add.php">
<input type="hidden" id="hid" name="hid" value="<?php echo $id; ?>">
<div class="container booking-main">
<div class="col-md-12">
<div class="col-md-4">
<h5><strong><?php echo get_record(100,$lang,$en,$con);?><span class="star">*</span></strong></h5>
<?php 
$result=mysqli_query($con, "select * from sv_seller_services where phone_no='$pno'");
while($query=mysqli_fetch_array($result))
{
	$services_id=$query['services_id'];
	$services_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_services where id='$services_id'"));
?>
	<div class="col-md-6">
	<div class="booking list">
  <!--  <input class="" type="checkbox" name="services_id" id="<?php echo $services_id; ?>service">-->
	<input type="checkbox" id="services[]" name="services[]" value="<?php echo $services_id; ?>" <?php if($sv_service_id==$services_id) echo "checked"; ?> 	>
	
		<label><?php echo $services_query['services_name']; ?></label>
    </div>	
	</div>
	
<?php } ?>

</div>

<?php 
$opening_days=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$id'"));
$booking_days=$opening_days['booking_opening_days'];
$cur_date=date("Y-m-d");
$exp_date=date("Y-m-d",strtotime($cur_date.'+'.$booking_days.'days'));
$start_time=$opening_days['start_time'];
$end_time=$opening_days['end_time'];

$shop_days=$opening_days['shop_date'];
$days="";
$sel=explode("," , $shop_days);
$lev=count($sel);
for($i=0;$i<$lev;$i++)
{
	$date_id=$sel[$i];
	$days.="day==".$date_id;
	$days.="||";		
}
 $days=trim($days,"||");
?>
<div class="col-md-4">
<input type="hidden" id="booking_per_hour" name="booking_per_hour" value="<?php echo $booking_per_hour; ?>">
<input type="hidden" id="start_time" name="start_time" value="<?php echo $start_time; ?>">
<input type="hidden" id="end_time" name="end_time" value="<?php echo $end_time; ?>">


<input type="hidden" id="shop_id" name="shop_id" value="<?php echo $id; ?>">

<input type="hidden" id="services_id" name="services_id" value="<?php echo $services_id; ?>">


<h5><strong><?php echo get_record(101,$lang,$en,$con);?><span class="star">*</span></strong></h5>
<script type="text/javascript">
  $(function() {

 $('#datepicker').datepicker({

changeMonth: true,
changeYear: true,
minDate: 0,
beforeShowDay: function (date) {
     var day = date.getDay();
	return [(<?php echo $days; ?>)];
    }
	
});

var date = new Date('<?php echo $exp_date; ?>');

var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();
$("#datepicker").datepicker( "option", "maxDate", new Date(currentYear, currentMonth, currentDate));
});   

 </script>
 
 
    
<input type="" class="form-control" required id="datepicker" name="datepicker" > 

</div>
<div class="col-md-4">

<h5><strong><?php echo get_record(102,$lang,$en,$con);?><span class="star">*</span></strong></h5>

<select id="time" name="time" class="form-control time" required onchange="javascript:time_function(this.value)">

<option value="">None</option>
<?php 
for($i=$start_time;$i<=$end_time;$i++)
{
	if($i>12)
	{
		$d=$i-12;
		$ss=$d."PM";
	}
	else
	{
		$ss=$i."AM";
	}
	?>
	<option value="<?php echo $i; ?>"> <?php echo $ss; ?></option>
	<?php
		$i+1;
}
?>

</select>
</div>
</div>


<div class="col-md-12">
<div class="col-md-3">
<label><?php echo get_record( 381, $lang,$en);?><span class="star">*</span></label>
<input type="text" id="address" required name="address" class="form-control">
</div>

<div class="col-md-3">
<label><?php echo get_record( 382, $lang,$en);?><span class="star">*</span></label>
<input type="text" id="city" required name="city" class="form-control">
</div>

<div class="col-md-3">
<label><?php echo get_record( 383, $lang,$en);?><span class="star">*</span></label>
<input type="text" id="pin_code" required name="pin_code" class="form-control">
</div>
<div class="col-md-3">
<h5><strong><?php echo get_record(103,$lang,$en,$con);?><span class="star">*</span></strong></h5>
<select id="payment_mode" name="payment_mode" class="form-control" required>
	<option value="">None</option>
	<!--<option value="cash">Cash</option>
	<option value="paypal">Paypal</option>-->
	
	<?php 
					$set_id=1;
		$row = mysqli_fetch_array(mysqli_query($con, "select * from sv_admin_login where id='$set_id'"));	
						
							$catid=$row['payment_option'];
							$sel= explode(",",$catid); 
							$lev= count($sel);
							for($i=0;$i<$lev;$i++)
							{
								 $ad_cat= $sel[$i];
							
						?>
						<option value="<?php echo $ad_cat; ?>" ><?php echo $ad_cat; ?></option>
						<?php 
						} 
						?> 
</select>

</div>
</div>

</div>


<?php 
if(!isset($_SESSION['phone_no'])) {
	?>
<div class="container">
<h3 class="left"><?php echo get_record(136,$lang,$en,$con);?></h3>

<div class="form-group col-md-3">
<label><?php echo get_record(132,$lang,$en,$con);?><span class="star">*</span></label>
<input type="text" id="name" required name="name" class="form-control">
</div>

<div class="form-group col-md-3">
<label><?php echo get_record(93,$lang,$en,$con);?><span class="star">*</span></label>
<input type="number" id="pno" name="pno" required class="form-control">
</div>

<div class="form-group col-md-3">
<label><?php echo get_record(94,$lang,$en,$con);?><span class="star">*</span></label>
<input type="password" id="pwd" name="pwd" required class="form-control">
</div>

<div class="form-group col-md-3">
<label><?php echo get_record(97,$lang,$en,$con);?><span class="star">*</span></label>
<input type="email" id="email" name="email" required class="form-control">
</div>

<div class="form-group col-md-3">
<label><?php echo get_record(98,$lang,$en,$con);?><span class="star">*</span></label>
<select id="gender" name="gender" class="form-control" required>
	<option value="male">Male</option>	
	<option value="female">Female</option>
	<option value="unisex">Unisex</option>
</select>
</div>

<div class="form-group col-md-3">
<label><?php echo get_record(99,$lang,$en,$con);?><span class="star">*</span></label>
<select id="user_type" name="user_type" class="form-control" required>
	<option value="">None</option>
	<option value="customer">Customer</option>	
	<option value="seller">Seller</option>
</select>
</div>
<?php } ?>
</div>

<div class="container">
<div class="col-md-2">
<input type="submit"  value="<?php echo get_record(137,$lang,$en,$con);?>" name="submit" class="booknow right">
</div>
</div>
</form>


<?php } ?>
	<div class="min-space"></div>
	
	
	<?php include("../footer.php"); ?>
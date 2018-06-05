<?php
session_start();
include ('../database/connection.php');
include ('../header.php');
if(isset($_SESSION['phone_no']))
{
$order_id=  mysql_real_escape_string($_SESSION["id"]);

$getuser = mysql_fetch_array(mysql_query("select * from sv_users where phone_no='".$_SESSION['phone_no']."'"));



$query=mysql_fetch_array(mysql_query("select * from sv_admin_login"));
$site_mode=$query['payu_mode'];
$cur_code=$query['currency_mode'];
$merchant = $query['merchant_id'];
		$salt = $query['salt_id'];

		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$email = $getuser['email'];
        $name = $getuser['user_name'];
		$phone = $_SESSION['phone_no'];


if($site_mode=="test")
	$payu_url = 'https://test.payu.in/_payment'; //Test Payumoney API URL
else if($site_mode=="live")
	$payu_url = 'https://secure.payu.in/_payment'; //Live Payumoney API URL
$success_url = $query['site_url'].'/payusuccess?cid='.$row['id'].'/'.$txnid;
		$fail_url = $query['site_url'].'/payu_failed/'.$booking_id;
?>
 <section class="teaser bg-top ">
 <div class="min-space"></div><div class="min-space"></div><div class="min-space"></div>
 <h3 class="sub-title"><?php echo get_record(241,$lang,$en);?></h3>
<div class="min-space"></div>
<div class="min-space"></div>
</section>
<!--fetch products from the database--->
<?php
		$results = mysql_query("select * from sv_booking where id='$order_id'");
		while($row=mysql_fetch_array($results))
		{
			$services_id=mysql_real_escape_string($row['services_id']);
			$sel=explode("," , $services_id);
			$lev=count($sel);
			$ser_name="";
			for($i=0;$i<$lev;$i++)
			{
				$catid=$sel[$i];	
                 if($lang==$en)
						{
							$ser_id="id";
							}
							else
							{
							$ser_id="page_parent";
							}				
				$res2=mysql_query("select * from sv_services where $ser_id='$catid' and lang_code='$lang'");
				
				$fet2=mysql_fetch_array($res2);
				$ser_name.=$fet2['services_name'];				
				$ser_name.=" , ";
			}	
			$ser_name=trim($ser_name," , ");	
					
			$price=$row['total_amt'];			
			$payment_mode=$row['payment_mode'];
			$booking_date=$row['booking_date'];
			
			
			$hash_string = $merchant."|".$txnid."|".$price."|".$ser_name."|".$name."|".$email."|||||||||||".$salt;
$hash = strtolower(hash('sha512', $hash_string));
?>

	
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order</title>

</head>
<body>
<div class="user-login-container">

<div class="container text-center">
<div class="min-space"></div>
	<label><?php echo get_record(183,$lang,$en);?> </label> - <?php echo $ser_name; ?><br>
     <label><?php echo get_record(235,$lang,$en);?></label> -  <?php echo $booking_date; ?><br>
    <label><?php echo get_record(196,$lang,$en);?></label> - <?php echo $price; ?> <?php echo $cur_code; ?>
   
	
	
	<form action="<?php echo $payu_url; ?>" method="post" name="payuForm" id="payuForm">
	<input type= "hidden" name= "currencyCode" value= "<?php echo $cur_code; ?>" >
	<input type="hidden" name="cid" value="<?php echo $row['id'];?>">
    <input type="hidden" name="key" value="<?php echo $merchant ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="hidden" value="<?php echo $price; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $ser_name; ?>">
    <input type="hidden" name="surl" value="<?php echo $query['site_url'];?>shop/payusuccess.php?cid=<?php echo $row['id'];?>&txnid=<?php echo $txnid;?>&currency=<?php echo $cur_code; ?>" />
    <input type="hidden" name="furl" value="<?php echo $query['site_url'];?>shop/payufailed.php"/>
    <input type="hidden" name="service_provider" value=""/>
    <input type="submit" name="submit" value="<?php echo get_record(242,$lang,$en);?>" class="paynow">
</form>
	
    <?php } ?>
	</div>
	
</div>	
</body>

<?php include('../footer.php'); ?>
</html>
<?php } else { header('Location:sign_in.php'); }?>

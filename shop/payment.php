<?php
session_start();
include ('../database/connection.php');
include ('../header.php');
if(isset($_SESSION['phone_no']))
{
$order_id=  mysql_real_escape_string($_SESSION["id"]);
//Set useful variables for paypal form 
$query=mysql_fetch_array(mysql_query("select * from sv_admin_login"));
$site_mode=$query['paypal_site_mode'];
$cur_code=$query['currency_mode'];

$paypal_id = $query['paypal_id']; //Business Email

if($site_mode=="test")
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
else if($site_mode=="live")
	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; //Live PayPal API URL

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
    <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $ser_name; ?>">
        <input type="hidden" name="item_number" value="<?php echo $row['id'];?>">
        <input type="hidden" name="amount" value="<?php echo $price; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $cur_code; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $query['site_url'];?>shop/cancel.php'>
		<input type='hidden' name='return' value='<?php echo $query['site_url'];?>shop/success.php'>
		<input type="submit" name="submit" value="<?php echo get_record(242,$lang,$en);?>" class="paynow">
     
    
    </form>
    <?php } ?>
	</div>
	
</div>	
</body>

<?php include('../footer.php'); ?>
</html>
<?php } else { header('Location:sign_in.php'); }?>

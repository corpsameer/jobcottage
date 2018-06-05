<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php"); ?>

<?php 
	$res=mysqli_query($con, "select * from sv_admin_login");
	$row=mysqli_num_rows($res);
		if($row==0)
	 	{
			$admin_id="";
			$email_id="";	
			$admin_name="";
			$site_name="";
			$logo="";
			$favicon="";
			$site_desc="";
			$keyword="";
			$site_url="";	
			$smtp_host="";
			$smtp_uname="";
			$smtp_pwd="";
			$smtp_port="";
			$mail_option="";
			$cmode="";	$paypal_id="";		
			$smode="";	
			$withdraw_amt="";
			$withdraw_option="";
			$commission_mode="";
			$commission_amt="";			
			}
		else
		{			
			$fet=mysqli_fetch_array($res);	
			$admin_id=mysqli_real_escape_string($con, $fet['id']);
			$email_id=mysqli_real_escape_string($con, $fet['email_id']);
			$admin_name=mysqli_real_escape_string($con, $fet['user_name']);	
			$site_name=mysqli_real_escape_string($con, $fet['site_name']);
			$logo=mysqli_real_escape_string($con, $fet['logo']);	
			$favicon=mysqli_real_escape_string($con, $fet['favicon']);	
			$site_desc=mysqli_real_escape_string($con, $fet['site_desc']);	
			$keyword=mysqli_real_escape_string($con, $fet['keyword']);
			$site_url=mysqli_real_escape_string($con, $fet['site_url']);	
			$smtp_host=mysqli_real_escape_string($con, $fet['smtp_host']);
			$smtp_uname=mysqli_real_escape_string($con, $fet['smtp_uname']);
			$smtp_pwd=mysqli_real_escape_string($con, $fet['smtp_pwd']);
			$smtp_port=mysqli_real_escape_string($con, $fet['smtp_port']);
			$mail_option=mysqli_real_escape_string($con, $fet['mail_option']);
			$cmode=mysqli_real_escape_string($con, $fet['currency_mode']);
			$paypal_id=mysqli_real_escape_string($con, $fet['paypal_id']);
			
			$salt_id=mysqli_real_escape_string($con, $fet['salt_id']);
			$merchant_id = mysqli_real_escape_string($con, $fet['merchant_id']);
			$payu_mode = mysqli_real_escape_string($con, $fet['payu_mode']);
			
			
			
			$stripe_mode = mysqli_real_escape_string($con, $fet['stripe_mode']);
			$live_publish_key = mysqli_real_escape_string($con, $fet['live_publish_key']);
			$live_secret_key = mysqli_real_escape_string($con, $fet['live_secret_key']);
			$test_publish_key = mysqli_real_escape_string($con, $fet['test_publish_key']);
			$test_secret_key = mysqli_real_escape_string($con, $fet['test_secret_key']);
						
						
						
						
			
			$smode=mysqli_real_escape_string($con, $fet['paypal_site_mode']);
			$withdraw_amt=mysqli_real_escape_string($con, $fet['withdraw_amt']);
			$withdraw_option=mysqli_real_escape_string($con, $fet['withdraw_option']);
			$commission_mode=mysqli_real_escape_string($con, $fet['commission_mode']);
			$commission_amt=mysqli_real_escape_string($con, $fet['commission_amt']);
			
		}	
		$page = 'setting';
?>

<body>
    <div id="wrapper">
        <?php include("top_menu.php") ?>
        <!--/. NAV TOP  -->
        <?php include("side_menu.php") ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		  <div class="header"> 
             <h1 class="page-header">
                            Setting
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Setting</a></li>
					</ol>		
		</div>
            <div id="page-inner">
			    <div class="panel-body">
			<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{  echo '<div class="succ-msg">Inserted Successfully</div>'; }
		else if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Updated Successfully</div>';		
		}
		else if($msg=="error")
		{
		      echo '<div class="err-msg">Select only png,jpg or jpeg image format in Logo and Favicon</div>';		
		}
		else if($msg=="error1")
		{
		      echo '<div class="err-msg">Both Logo and favicon are greather than 1 MB. please choose lessthan 1 MB</div>';		
		}
		else if($msg=="error2")
		{
		      echo '<div class="err-msg">Favicon is grather than 1 MB, select only png,jpg or jpeg image format in Logo </div>';		
		}
		else if($msg=="error3")
		{
		      echo '<div class="err-msg">Logo is grather than 1 MB, select only png,jpg or jpeg image format in Favicon</div>';		
		}
		else if($msg=="error4")
		{
		      echo '<div class="err-msg">Select only png,jpg or jpeg image format in Logo</div>';		
		}
		else if($msg=="error5")
		{
		      echo '<div class="err-msg">Logo is greather than 1 MB</div>';		
		}
		else if($msg=="error6")
		{
		      echo '<div class="err-msg">Select only png,jpg ,ico or jpeg image format in favicon</div>';		
		}
		else if($msg=="error7")
		{
		      echo '<div class="err-msg">selected Favicon is greater than 1 MB</div>';		
		}
}
else
	$msg="";
?>					
	</div>
		<input type="hidden" id="id" name="id" value="<?php echo $admin_id;?>">
		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="admin_setting_addcode.php">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>User Name</label>				
						<input type="text" id="admin_name" required="" class="form-control" name="admin_name" value="<?php echo $admin_name;?>">
					</div>
					<div class="err" id="admin_name_err"></div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Email ID</label>				
						<input type="text" id="email_id" class="form-control" name="email_id" value="<?php echo $email_id;?>">
					</div>
					<div class="err" id="email_err"></div>
				</div>
							
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site Name</label>				
						<input type="text" id="site_name" class="form-control" name="site_name" value="<?php echo $site_name;?>">
					</div>
					<div class="err" id="site_name_err"></div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site Logo</label>		
							<div class="err" style="padding:10px;" id="">[Please select an image 160px / 40px]</div>
							<input type="file" id="logo" class="form-control" name="logo" value="<?php echo $fet['logo'];?>">
						<?php
						if($logo=="") { ?>	
						<a href="#"><img class="site_logo" src="<?php echo $site_url; ?>/admincp/img/default-logo.png" alt="" ></a>
	
						<?php
							}
							else
							{
							?>
						<a href="images/<?php echo $logo;?>" target="blank"><img class="site_logo" src="<?php echo $site_url; ?>/admincp/img/<?php echo $logo;?>" alt="" ></a>
						<?php } ?>							
					</div>
					<div class="err" id="logo_err"></div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site  Favicon</label>	
						<div style="padding:10px;" class="err"  id="">[Please select an image 16px / 24px]</div>			
						<input type="file" id="favicon" class="form-control" name="favicon" value="<?php echo ""?>">
						<?php
						if($favicon=="") { 	?>				
						<?php } else { ?>
					<a href="img/<?php echo $favicon;?>" target="blank"><img src="img/<?php echo $favicon;?>" alt=""  style="margin-top:20px;"></a>
					<?php
						}
					?>	
					</div>
					<div class="err" id="favicon_err"></div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site  Description</label>				
						<input type="text" id="site_desc" class="form-control" name="site_desc" value="<?php echo $site_desc?>">
					</div>
					<div class="err" id="site_desc_err"></div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site Keyword</label>				
						<input type="text" id="keyword" class="form-control" name="keyword" value="<?php echo $keyword;?>">
					</div>
					<div class="err" id="site_kwd_err"></div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4"></div>
								<div class="col-lg-4 col-md-4 col-sm-4"></div>

				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Site Url</label>				
						<input type="text" id="site_url" class="form-control" name="site_url" value="<?php echo $site_url;?>">
					</div>
					<div class="err" id="site_url_err"></div>
				</div>
						
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center">Mail Setting</h3>
					<div class="col-lg-4 col-md-4 col-sm-4 "></div>
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Mail Option</strong></label>
							<select id="mail_option" name="mail_option" class="form-control">
								<option value="smtp"  <?php { if($mail_option=="smtp") echo "selected='selected'"; }?>>SMTP</option>
								<option value="mail"  <?php { if($mail_option=="mail") echo "selected='selected'"; }?>>Mail</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4"></div>

				
				<div class="col-lg-12 col-md-12 col-sm-12 ">
						<div class="col-lg-3 col-md-3 col-sm-3"><div class="form-group">
						<label>Host Name</label>	
							<input type="text" id="smtp_host" class="form-control" name="smtp_host" value="<?php echo $smtp_host;?>">
						</div>		</div>				
						<div class="col-lg-3 col-md-3 col-sm-3"><div class="form-group">
							<label>User Name</label>	
								<input type="text" id="smtp_uname" class="form-control" name="smtp_uname" value="<?php echo $smtp_uname;?>">
						</div></div>
						<div class="col-lg-3 col-md-3 col-sm-3"><div class="form-group">
						<label>Password</label>	
							<input type="password" id="smtp_pwd" class="form-control" name="smtp_pwd" value="<?php echo $smtp_pwd;?>">
						</div></div>
						<div class="col-lg-3 col-md-3 col-sm-3"><div class="form-group">
						<label>Port</label>	
							<input type="text" id="smtp_port" class="form-control" name="smtp_port" value="<?php echo $smtp_port;?>">
						</div></div>
				</div>

				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
				<h3 class="text-center">Currency Setting</h3>
				<div class="col-lg-4 col-md-4 col-sm-4"></div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
						<label>Select Currency</label>	
						<select id="cmode" name="cmode" class="form-control">
							<option value="">Select currency</option>
							<option value="USD" <?php { if($cmode=="USD") echo "selected='selected'"; }?>>USD</option>
							<option value="CZK" <?php { if($cmode=="CZK") echo "selected='selected'"; }?>>CZK</option>
							<option value="DKK" <?php { if($cmode=="DKK") echo "selected='selected'"; }?>>DKK</option>
							<option value="HKD" <?php { if($cmode=="HKD") echo "selected='selected'"; }?>>HKD</option>
							<option value="HUF" <?php { if($cmode=="HUF") echo "selected='selected'"; }?>>HUF</option>
							<option value="ILS" <?php { if($cmode=="ILS") echo "selected='selected'"; }?>>ILS</option>
							<option value="JPY" <?php { if($cmode=="JPY") echo "selected='selected'"; }?>>JPY</option>
							<option value="MXN" <?php { if($cmode=="MXN") echo "selected='selected'"; }?>>MXN</option>
							<option value="NZD" <?php { if($cmode=="NZD") echo "selected='selected'"; }?>>NZD </option>
							<option value="NOK" <?php { if($cmode=="NOK") echo "selected='selected'"; }?>>NOK</option>
							<option value="PHP" <?php { if($cmode=="PHP") echo "selected='selected'"; }?>>PHP</option>
							<option value="PLN" <?php { if($cmode=="PLN") echo "selected='selected'"; }?>>PLN</option>
							<option value="SGD" <?php { if($cmode=="SGD") echo "selected='selected'"; }?>>SGD</option>
							<option value="SEK" <?php { if($cmode=="SEK") echo "selected='selected'"; }?>>SEK</option>
							<option value="CHF" <?php { if($cmode=="CHF") echo "selected='selected'"; }?>>CHF</option>																
							<option value="THB" <?php { if($cmode=="THB") echo "selected='selected'"; }?>>THB</option>
							<option value="AUD" <?php { if($cmode=="AUD") echo "selected='selected'"; }?>>AUD</option>
							<option value="CAD" <?php { if($cmode=="CAD") echo "selected='selected'"; }?>>CAD</option>
							<option value="EUR" <?php { if($cmode=="EUR") echo "selected='selected'"; }?>>EUR</option>
							<option value="GBP" <?php { if($cmode=="GBP") echo "selected='selected'"; }?>>GBP</option>
							
							<option value="AFN" <?php { if($cmode=="AFN") echo "selected='selected'"; }?>>AFN</option>
							<option value="DZD" <?php { if($cmode=="DZD") echo "selected='selected'"; }?>>DZD</option>
							<option value="AOA" <?php { if($cmode=="AOA") echo "selected='selected'"; }?>>AOA</option>
							<option value="XCD" <?php { if($cmode=="XCD") echo "selected='selected'"; }?>>XCD</option>
							<option value="ARS" <?php { if($cmode=="ARS") echo "selected='selected'"; }?>>ARS</option>
							<option value="AMD" <?php { if($cmode=="AMD") echo "selected='selected'"; }?>>AMD</option>
							<option value="AWG" <?php { if($cmode=="AWG") echo "selected='selected'"; }?>>AWG</option>
							<option value="SHP" <?php { if($cmode=="SHP") echo "selected='selected'"; }?>>SHP</option>
							<option value="AZN" <?php { if($cmode=="AZN") echo "selected='selected'"; }?>>AZN</option>
							<option value="BSD" <?php { if($cmode=="BSD") echo "selected='selected'"; }?>>BSD</option>
							<option value="BHD" <?php { if($cmode=="BHD") echo "selected='selected'"; }?>>BHD</option>
							<option value="BDT" <?php { if($cmode=="BDT") echo "selected='selected'"; }?>>BDT</option>
							<option value="ZAR" <?php { if($cmode=="ZAR") echo "selected='selected'"; }?>>ZAR</option>
						</select>
						</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4"></div>
						</div>
						
						
						
					<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center space">Paypal Setting</h3>	
					
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
						<label>Paypal Id</label>	
							<input type="text" id="paypal_id" class="form-control" name="paypal_id" value="<?php echo $paypal_id;?>">
						</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>Paypal site Mode</label>	
								<select id="smode" name="smode" class="form-control">
									<option value="">Select</option>
									<option value="test" <?php { if($smode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($smode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
								</div>
						</div>
				</div>
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center space">Stripe Setting</h3>	
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Stripe Site Mode</label>	
								<select id="stripe_mode" name="stripe_mode" class="form-control">
									<option value="">Select</option>
									<option value="test" <?php { if($stripe_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($stripe_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
								</div>
						</div>
						
						
						<div class="col-lg-4 col-md-4 col-sm-4" id="stripe_test_publish" <?php if($stripe_mode!="test"){?>style="display:none;"<?php } ?>>
						<div class="form-group">
						<label>Test Publishable key</label>	
							<input type="text" id="test_publish_key" class="form-control" name="test_publish_key" value="<?php echo $test_publish_key;?>" required>
						</div>
						</div>
						
						
						
						<div class="col-lg-4 col-md-4 col-sm-4" id="stripe_test_secret" <?php if($stripe_mode!="test"){?>style="display:none;"<?php } ?>>
						<div class="form-group">
						<label>Test Secret key</label>	
							<input type="text" id="test_secret_key" class="form-control" name="test_secret_key" value="<?php echo $test_secret_key;?>" required>
						</div>
						</div>
						
						
						
						<div class="col-lg-4 col-md-4 col-sm-4" id="stripe_live_publish" <?php if($stripe_mode!="live"){?>style="display:none;"<?php } ?>>
						<div class="form-group">
						<label>Live Publishable key</label>	
							<input type="text" id="live_publish_key" class="form-control" name="live_publish_key" value="<?php echo $live_publish_key;?>" required>
						</div>
						</div>
						
						
						
						<div class="col-lg-4 col-md-4 col-sm-4" id="stripe_live_secret" <?php if($stripe_mode!="live"){?>style="display:none;"<?php } ?>>
						<div class="form-group">
						<label>Live Secret key</label>	
							<input type="text" id="live_secret_key" class="form-control" name="live_secret_key" value="<?php echo $live_secret_key;?>" required>
						</div>
						</div>
						
						
						
						
						
						
				</div>
				
				
				
				
				
				
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center space">Payumoney Setting</h3>	
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Payumoney Site Mode</label>	
								<select id="payu_mode" name="payu_mode" class="form-control">
									<option value="">Select</option>
									<option value="test" <?php { if($payu_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($payu_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
								</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
						<label>Merchant Key</label>	
							<input type="text" id="merchant_id" class="form-control" name="merchant_id" value="<?php echo $merchant_id;?>">
						</div>
						</div>
						
						
						
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
						<label>Salt</label>	
							<input type="text" id="salt_id" class="form-control" name="salt_id" value="<?php echo $salt_id;?>">
						</div>
						</div>
						
						
				</div>
				
				
				
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center">Payment Mode Setting</h3>					
						
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>Payment Option</label>	
								<select name="paymentopt[]" multiple id="paymentopt" class="sv_multiselect">
								<?php	
										$reser=mysqli_query($con, "select * from sv_admin_login");
										while($rower=mysqli_fetch_array($reser))
										{
											$catider=$rower['payment_option'];
											$seler=explode(",",$catider);
											$lever=count($seler);
									?>
									<option value="paypal" <?php for($i=0;$i<$lever;$i++){ if($seler[$i]=="paypal") echo "selected=='selected'"; }?> >Paypal</option>
									<option value="payumoney" <?php for($i=0;$i<$lever;$i++){ if($seler[$i]=="payumoney") echo "selected=='selected'"; }?>>Payumoney</option>
									<option value="stripe" <?php for($i=0;$i<$lever;$i++){ if($seler[$i]=="stripe") echo "selected=='selected'"; }?>>Stripe</option>
										<?php } ?>
								</select>
							</div>
						</div>
				</div>
				
				
				
				
				
				
				
				
				


				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center">Withdraw Setting</h3>					
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
						<label>Min. Withdraw Amount</label>	
							<input type="text" id="withdraw_amt" class="form-control" name="withdraw_amt" value="<?php echo $withdraw_amt;?>">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>Withdraw Option</label>	
								<select name="langOpt[]" multiple id="langOpt" class="sv_multiselect">
								<?php	
										$res=mysqli_query($con, "select * from sv_admin_login");
										while($row=mysqli_fetch_array($res))
										{
											$catid=$row['withdraw_option'];
											$sel=explode(",",$catid);
											$lev=count($sel);
									?>
									<option value="paypal" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="paypal") echo "selected=='selected'"; }?> >Paypal</option>
									<option value="payumoney" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="payumoney") echo "selected=='selected'"; }?>>Payumoney</option>
									<option value="stripe" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="stripe") echo "selected=='selected'"; }?>>Stripe</option>
									<option value="bank" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="bank") echo "selected=='selected'"; }?>>Bank</option>
										<?php } ?>
								</select>
							</div>
						</div>
				</div>
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center">Commission Setting</h3>					
						
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>Select Commission Mode</label>	
								<select name="commission_mode" id="commission_mode" class="form-control" required>
									<option value="fixed" <?php { if($commission_mode=="fixed") echo "selected='selected'"; }?>>Fixed</option>
									<option value="percentage" <?php { if($commission_mode=="percentage") echo "selected='selected'"; }?>>Percentage</option>
								</select>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
						<label>Enter Amout / percentage</label>	
							<input type="text" id="commission_amt" class="form-control" name="commission_amt" value="<?php echo $commission_amt;?>">
						</div>
						</div>
						
				</div>
				
				
				
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 space smtp-bg">
					<h3 class="text-center">Language Setting</h3>					
						
						<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
						<?php 
						$all_lang=mysqli_query($con, "select * from sv_language order by lang_id asc");
						while($rowlang=mysqli_fetch_array($all_lang)){
						?>
							<div style="line-height:30px;">
							<input type="checkbox" name="choose_language[]" value="<?php echo $rowlang['lang_id'];?>" <?php if($rowlang['lang_id']==1){?> onclick="return false" onkeydown="return false" <?php } ?> <?php if($rowlang['lang_status']==1){?> checked <?php } ?>> <span style="top:-1px; position:relative;"><?php echo $rowlang['lang_name'];?></span><br/>
							</div>
							
						<?php } ?>	
							</div>
						</div>
				</div>
				
				
				
						
				<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="col-lg-4 col-md-4 col-sm-4">
				   <?php if($demo_mode=="off") { ?>
					<button type="button" class="btn btn-primary" onclick="javascript:admin_function()">Save</button>
					 <?php } else { ?>
			    <button type="button" class="btn btn-primary" disabled="disabled">Save</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>

				</div>
				</div>
			</form>

		<script src="<?php echo $site_url; ?>/js/jquery.multiselect.js"></script>
<script>
$('#langOpt').multiselect({
    columns: 1,
    placeholder: 'Select Category'
});
$('#paymentopt').multiselect({
    columns: 1,
    placeholder: 'Select Category'
});


$('#stripe_mode').on('change', function() {
		
		if ( this.value == 'test')
      {
		  $("#stripe_test_publish").show();
		  $("#stripe_test_secret").show();
		  $("#stripe_live_publish").hide();
		  $("#stripe_live_secret").hide();
	  }
	  else if(this.value == 'live')
      {
		  $("#stripe_test_publish").hide();
		  $("#stripe_test_secret").hide();
		  $("#stripe_live_publish").show();
		  $("#stripe_live_secret").show();
	  }
	  else
	  {
		  $("#stripe_test_publish").hide();
		  $("#stripe_test_secret").hide();
		  $("#stripe_live_publish").hide();
		  $("#stripe_live_secret").hide();
	  }
		
	
	});
</script>
            <div id="page-inner"> 
               
                               </div>
							 <?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
       
</body>


</html>

<?php 
include("../header.php");
?>

<script>
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
</script>
<div class="loginbg">

<div class="min-space"></div>
<div class="container text-center">
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-6">

<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
	if($msg=="Inserted")
	{
	   echo '<div class="succ-msg">Account created successfully. Please Login Your Account. </div>';
	}
	else if($msg=="Exist")
	{
	     echo '<div class="err-msg">Phone No Already Exist </div>';
	}
	else if($msg=="Invalid")
	{
	     echo '<div class="err-msg">Invalid username or Password </div>';
	}
	
}
else
	$msg="";
?>
</div>
<div class="col-lg-3"></div>
</div>
</div>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
							<div class="col-xs-6 login_right_brdr">
								<a href="#" class="active" id="login-form-link"><?php echo get_record(79,$lang,$en,$con);?></a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link"><?php echo get_record(92,$lang,$en,$con);?></a>
							</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="javascript:login();" method="post" role="form" style="display: block;">
									<div class="form-group col-lg-12">
										<label><?php echo get_record(93,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="phone_no" required="" id="phone_no" class="form-control" value="">
									</div>
									<div class="form-group col-lg-12">
										<label><?php echo get_record(94,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="password" name="password" required="" id="password" class="form-control" >
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(79,$lang,$en,$con);?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="<?php echo $site_url;?>login/forgot.php" tabindex="5" class="forgot-password"><?php echo get_record(95,$lang,$en,$con);?></a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="<?php echo $site_url;?>login/registration_code.php" method="post" role="form" style="display: none;">
								<div class="form-group col-md-6">
									<label><?php echo get_record(96,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="user_name" required="" id="user_name" class="form-control" value="">
									</div>
									<div class="form-group col-md-6">
										<label><?php echo get_record(93,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="phone_no" required="" id="phone_no" class="form-control" value="">
									</div>									
									<div class="form-group col-md-6">
										<label><?php echo get_record(94,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="password" name="password" required="" id="password" class="form-control" >
									</div>
									<div class="form-group col-md-6">
										<label><?php echo get_record(97,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="email" name="email" id="email" required="" class="form-control"  value="">
									</div>
									<div class="form-group col-md-6">
										<label><?php echo get_record(98,$lang,$en,$con);?><span class="star">*</span></label>
										<select id="gender" name="gender" class="form-control" required>
											<option value="male">Male</option>	
											<option value="female">Female</option>
											
										</select>
									</div>	
									<div class="form-group col-md-6">
										<label><?php echo get_record(99,$lang,$en,$con);?><span class="star">*</span></label>
										<select id="user_type" name="user_type" class="form-control" required>
											<option value="">None</option>
											<option value="customer">Customer</option>	
											<option value="seller">Seller</option>
										</select>
									</div>								
																	
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(104,$lang,$en,$con);?>">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>	
	<?php include("../footer.php"); ?>
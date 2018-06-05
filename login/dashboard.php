<title>Dashboard</title>


<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
$phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);		
	
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no'"));
?>
<?php 
include('../header.php');
?>
<div class="min-space"></div>
<div class="container">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Your Profile has been updated Successfully.</div>';
		}
		else if($msg=="Error")
		{
		     echo '<div class="err-msg">Server Error</div>';		
		}
		else if($msg=="Success")
		{
			echo '<div class="succ-msg">Password changed successfully</div>';
		}
		else if($msg=="Invalid")
		{
			echo '<div class="err-msg">Enter valid current password</div>';
		}		
}
else
	$msg="";
?>
</div>
<div class="container">
           <div class="col-md-12 profile_main bgcolo">            
				<div class="profile text-center min-space">
                     <div class="profile-name"><?php echo $query['user_name']; ?></div>
                    <div class="profile-number"><?php echo $query['phone_no']; ?></div>

				</div>
             </div>			 
 </div>
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

 <!-----------------------form start here----------------->
 <div class="container">
    	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-login">
					<div class="panel-heading">
							<div class="col-xs-6 login_right_brdr">
								<a href="#" class="active" id="login-form-link"><?php echo get_record(174,$lang,$en,$con);?></a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link"><?php echo get_record(175,$lang,$en,$con);?></a>
							</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="javascript:edit_profile('add')" method="post" role="form" style="display: block;">
								<div class="form-group col-lg-6">
										<label><?php echo get_record(96,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="user_name" value="<?php echo $query['user_name']; ?>" required="" id="user_name" class="form-control" >
									</div>
									<div class="form-group col-lg-6">
										<label><?php echo get_record(93,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="phone_no" disabled="disabled" required="" id="phone_no" class="form-control" value="<?php echo $query['phone_no']; ?>">
									</div>
									<div class="form-group col-lg-6">
										<label><?php echo get_record(97,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="text" name="email" required="" id="email" class="form-control" value="<?php echo $query['email']; ?>">
									</div>
									<div class="form-group col-lg-6">
										<label><?php echo get_record(98,$lang,$en,$con);?><span class="star">*</span></label>
										<select id="gender" name="gender" class="form-control" required>
											<option value="male" <?php { if($query['gender']=="male") echo "selected='selected'"; }?>>Male</option>	
											<option value="female" <?php { if($query['gender']=="female") echo "selected='selected'"; }?>>Female</option>
											<option value="unisex" <?php { if($query['gender']=="unisex") echo "selected='selected'"; }?>>Unisex</option>
										</select>
									</div>									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-2">
											   <?php if($demo_mode=="off") { ?>
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(180,$lang,$en,$con);?>">
												 <?php } else { ?>
												 <input type="button" disabled="disabled" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(180,$lang,$en,$con);?>"> <span class="demomode">[Demo Mode Enabled]</span>
												 <?php } ?>
											</div>
										</div>
									</div>									
								</form>
								<form id="register-form" action="javascript:change_pwd();" method="post" role="form" style="display: none;">
								<div class="form-group col-lg-4">
									<label><?php echo get_record(176,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="password" required="" name="cur_pwd" id="cur_pwd" class="form-control" value="">
									</div>
									<div class="form-group col-md-4">
										<label><?php echo get_record(177,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="password" name="new_pwd" id="new_pwd" required="" class="form-control" value="">
									</div>									
									<div class="form-group col-md-4">
										<label><?php echo get_record(178,$lang,$en,$con);?><span class="star">*</span></label>
										<input type="password" required="" name="confirm_pwd" id="confirm_pwd" class="form-control" >
									</div>
																									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-2">
											   <?php if($demo_mode=="off") { ?>
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="<?php echo get_record(179,$lang,$en,$con);?>">
											   <?php } else { ?>
											   <input type="button" disabled="disabled" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(179,$lang,$en,$con);?>"><span class="demomode">[Demo Mode Enabled]</span>
											   <?php } ?>
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
	<div class="min-space"></div>
<?php } else { header('Location:login.php'); }?>
	<?php include("../footer.php"); ?>
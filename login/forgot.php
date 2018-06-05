  <?php include("../header.php")?>
  
   <div class="loginbg"> 
    <div class="container">
	<div class="col-lg-3"></div>
		<div class="col-lg-6">

      <?php
if(isset($_REQUEST['msg']))
{
$msg=$_REQUEST['msg'];
if($msg=="Invalid")
{
echo '<div class="err-msg">Please Enter the Registered Phone No</div>';
}
else if($msg=="success")
{
echo '<div class="succ-msg">Your Password details has send your Email</div>';		
}
}
else
$msg="";
?>
</div>
	<div class="col-lg-3"></div>

    </div>
   
<div class="min-space"></div>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="" id="login-form-link"><h3><?php echo get_record(168,$lang,$en);?></h3> </a>
							</div>
						</div>
						<hr>
					</div>
											
					<div class="panel-body">
					<div class="row">
					<p class="text-center forgot"><?php echo get_record(169,$lang,$en);?></p>	
					</div>
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="javascript:forgot();" method="post" role="form">
									<div class="form-group">
									<label><?php echo get_record(93,$lang,$en);?><span class="star">*</span></label>
										<input type="text" name="pno" id="pno" tabindex="1" class="form-control"  required="" value="">
									</div>																	
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="" id="" class="form-control btn btn-login" value="<?php echo get_record(170,$lang,$en);?>">
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
	
	</div>	
			<?php include("../footer.php") ?>

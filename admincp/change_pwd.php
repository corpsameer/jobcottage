<!DOCTYPE html>
  <?php include("../database/connection.php");
$page = 'change password'; ?>
    <div id="wrapper">
      <?php include("top_menu.php") ?>
      <!--/. NAV TOP  -->
      <?php include("side_menu.php") ?>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper" >
        <div class="header"> 
          <h1 class="page-header">
            Change Password
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">Home
              </a>
            </li>
            <li>
              <a href="#">Change Password
              </a>
            </li>
          </ol>		
        </div>
        <div id="page-inner">
          <div class="panel-body">
            <div class="text-center">
              <?php
if(isset($_REQUEST['msg']))
{
$msg=$_REQUEST['msg'];
if($msg=="Invalid")
{
echo '<div class="err-msg">Enter the valid current password</div>';
}
else if($msg=="success")
{
echo '<div class="succ-msg">Password Changed Successfully</div>';		
}
}
else
$msg="";
?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label>Current Password
                </label>				
                <input type="password" id="curpwd" class="form-control" name="curpwd" onblur="javascript:currpass(this.value);" value="">
				<div id="cur_pwd_err" class="err"></div>
               <div id="curpwd1" class="err" >
                </div>
              </div>
              <div class="form-group">
                <label>New Password
                </label>				
                <input type="password" id="newpwd" class="form-control" name="newpwd" onblur="javascript:newpwd(this.value);" value="">
                <div id="newpwd1" class="err"> 
                </div>
              </div>
              <div class="form-group">
                <label>Confirm Password
                </label>				
                <input type="password" id="conpwd" class="form-control" name="conpwd" onblur="javascript:conpwd(this.value);" value="">
                <div id="conpwd1" class="err">
                </div>
              </div>
           
            </div>
			  <div class="col-lg-12 col-md-12 col-sm-12">
				<div class="form-group">
				  <?php if($demo_mode=="off") { ?>
                <button type="submit" class="btn btn-primary" onclick="javascript:change_pass()">Set New Password
				 <?php } else { ?>
			    <button type="button" class="btn btn-primary" disabled="disabled">Set New Password</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>
                </button>
              </div></div>
          </div>
        
          <?php include("footer.php") ?>
        </div>
        <!-- /. PAGE INNER  -->
      </div>
      
<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php
if(isset($_REQUEST['uid']))
	{
		$uid=mysqli_real_escape_string($con, $_REQUEST['uid']);
		$res=mysqli_query($con, "select * from sv_users where id='$uid'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $uname="";
		  $email="";
		  $phone_no="";
		  $gender="";
		  $user_type="";
		}
		else
		{
			$fet=mysqli_fetch_array($res);
			$id=mysqli_real_escape_string($con, $fet['id']);
			$name=mysqli_real_escape_string($con, $fet['user_name']);
			$email=mysqli_real_escape_string($con, $fet['email']);
			$phone_no=mysqli_real_escape_string($con, $fet['phone_no']);
			$gender=mysqli_real_escape_string($con, $fet['gender']);
			$user_type=mysqli_real_escape_string($con, $fet['user_type']);

			$typ="update";
		}
	}
	else
	{
		$id="";
		$uname="";
		$email="";
		$phone_no="";
		$gender="";
		$user_type="";
	}
	$page = 'users';

?>


  <body class="splash-index">

<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >

		  <div class="header">
                        <h1 class="page-header">
                            User Details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">User</a></li>

					</ol>
		</div>
            <div id="">
			    <div class="panel-body">
				<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">User details Updated Successfully.</div>';
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg"> User details Deleted Successfully</div>';
		}
}
else
	$msg="";
?>

			<?php if(isset($_REQUEST['uid'])) { ?>
				<form class="form-large" action="user_add.php" accept-charset="UTF-8" method="post">

				<div class="col-lg-3 col-md-3 col-sm-3"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 table-bg">
				<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
                <input type="hidden" id="hid" name="hid" value="<?php echo $uid;?>">

				<div class="col-lg-4 col-md-4 col-sm-4" >
					<div class="form-group">
						<label>User Name</label>
					<input type="text" id="name" required="required" class="form-control" name="name" value="<?php echo $name; ?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4" >
					<div class="form-group">
						<label>Phone_no</label>
					<input type="text" id="pho_no" required="required" disabled="disabled" class="form-control" name="pho_no" value="<?php echo $phone_no; ?>"></div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="form-group">
					<label>Email</label>
					<input type="email" id="email_id" required="required" class="form-control" name="email_id" value="<?php echo $email;?>"></div>
				</div>
				<div class="form-group col-md-6" >
					<label>Gender</label>
						<select id="gender" name="gender" class="form-control" required>
							<option value="male" <?php if($gender=="male") echo "selected='selected'";  ?>>Male</option>
							<option value="female" <?php  if($gender=="female") echo "selected='selected'";  ?>>Female</option>
							<option value="unisex" <?php  if($gender=="unisex") echo "selected='selected'"; ?>>Unisex</option>
						</select>
				</div>
				<div class="form-group col-md-6" id="" >
					<label>User Type</label>
						<select id="user_type" name="user_type" class="form-control" required>
							<option value="customer" <?php  if($user_type=="customer") echo "selected='selected'";  ?>>Customer</option>
							<option value="seller" <?php  if($user_type=="seller") echo "selected='selected'"; ?>>Seller</option>
						</select>
				</div>
				<div class="min-space"></div>
					<div class="up-button">
					   <?php if($demo_mode=="off") { ?>
						<button type="submit" class="btn btn-primary" onclick="">Update</button>
						<?php } else { ?>
						<button type="button" class="btn btn-primary" disabled="disabled">Update</button> <span class="demomode">[Demo Mode Enabled]</span>
						<?php } ?>
					</div>
				</div>
					</form>
					<?php } ?>
				<div class="col-lg-3 col-md-3 col-sm-3"></div>
				</div>

			<div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Users
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
											<th>User_Name</th>
											<th>Phone_no</th>
											<th>Email</th>
											<th>Gender</th>
											<th>User_Type</th>
											<th>Update</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
									$sno=0;
									$res=mysqli_query($con, "select * from sv_users ORDER BY id DESC");
									while($row=mysqli_fetch_array($res))
									{
										$sno++;
										$id=mysqli_real_escape_string($con, $row['id']);
										$user_name=mysqli_real_escape_string($con, $row['user_name']);
									?>

										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $user_name; ?></td>
											<td><?php echo $row['phone_no']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['gender']; ?></td>
											<td><?php echo $row['user_type']; ?></td>
											<td><a href="users.php?uid=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="javascript:user_del('<?php echo $id;?>');"><img src="img/delete.png" alt="" title="delete"></a></td>
											 <?php } else { ?>
											 <td><img src="img/delete.png" alt="" title="delete"><span class="demomode">[Demo Mode Enabled]</span></td>
											 <?php } ?>
										</tr>
										<?php } ?>
									</tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                   </div>
				   				<?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->


   </html>

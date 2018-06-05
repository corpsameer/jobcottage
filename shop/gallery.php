<title>Gallery</title>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
	$phone_no=mysql_real_escape_string($_SESSION['phone_no']);			
	$query=mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$phone_no'"));
	$shop_query=mysql_fetch_array(mysql_query("select * from sv_shop where phone_no='$phone_no'"));
$shop_id=$shop_query['id'];
?>
<?php 
include('../header.php');
?>
<div class="profile_main">
<h1 class="text-center"><?php echo get_record(109,$lang,$en);?></h1>
</div>

<div class="min-space"></div>
<div class="container">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="select-img")
		{
		      echo '<div class="err-msg">Please Select Shop Image</div>';
		}
		else if($msg=="Inserted")
		{
		     echo '<div class="succ-msg"> Shop Gallery Image Inserted Successfully.</div>';		
		}
		else if($msg=="Updated")
		{
		     echo '<div class="succ-msg"> Shop Gallery Image Updated Successfully.</div>';		
		}		
		else if($msg=="Deleted")
		{
			echo '<div class="succ-msg">Deleted Successfully</div>';
		}		
		else if($msg=="imgerr")
		{
		    echo '<div class="err-msg">Select only jpeg, jpg, png image format</div>';		
		}
		else if($msg=="size-err")
		{
		    echo '<div class="err-msg">Gallery image is greather than 1 MB</div>';		
		}
}
else
	$msg="";
?>
</div>

<div class="container">
<?php 
		if(isset($_REQUEST['gid']))
		{		
		$gid=mysql_real_escape_string($_REQUEST['gid']);
		$res=mysql_query("select * from sv_shop_gallery where id='$gid'");
		$row=mysql_num_rows($res);
		if($row==0)
	 	{
		  $gallery_id="";
		  $image="";		 
		   $typ="add";
		}
		else
		{			
			$fet=mysql_fetch_array($res);
			$gallery_id=mysql_real_escape_string($fet['id']);	
			$image=mysql_real_escape_string($fet['image']);	
			$shop_id=mysql_real_escape_string($fet['shop_id']);
			$typ="update";	
		}		
	}
	else
	{
		$gallery_id="";
		$image="";
		$typ="add";
	}

?>
    <div class="col-md-12">
      <div class="col-md-6">

		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="gallery_add.php">
		<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="id" name="id" value="<?php echo $gallery_id;?>">
			<?php
			$sql=mysql_fetch_array(mysql_query("select * from sv_shop where phone_no='$phone_no'"));
			$sid=$sql['id']; ?>
			<input type="hidden" id="shopid" name="shopid" value="<?php echo $sid;?>">

			
			<div class="col-md-12 col-md-12 col-sm-12 form-group">					
				<label><?php echo get_record(159,$lang,$en);?></label>							
				<input type="file" id="gallery" class="form-control" name="gallery" value="">	
				<?php if(isset($_REQUEST['gid'])) { if($image=="") { } else { ?>						
						  <img src="<?php echo $site_url; ?>shop/shop-img/<?php echo $image;?>" class="col-md-6">
						<?php } }?>				
			</div>
			<input type="hidden" name="old_image" value="<?php echo $image;?>">
			<div class="col-md-2 col-md-2 col-sm-2 form-group">		
			<label></label>
			   <?php if($demo_mode=="off") { ?>
				<button type="submit" class="form-control btn btn-register"><?php echo get_record(156,$lang,$en);?></button>
			   <?php } else { ?>
			   <button type="button" class="form-control btn btn-login" disabled="disabled"><?php echo get_record(156,$lang,$en);?></button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>
			</div>
			
		</form>
		
		</div>
		
		
                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default" style="clear:both;">
                        <div class="panel-heading">
                           <?php echo get_record(109,$lang,$en);?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo get_record(200,$lang,$en);?></th>
											<th><?php echo get_record(201,$lang,$en);?></th>
											<th><?php echo get_record(180,$lang,$en);?></th>
											<th><?php echo get_record(198,$lang,$en);?></th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysql_query("select * from sv_shop_gallery where shop_id='$shop_id'");
										while($row=mysql_fetch_array($res))
										{
											$sno++;
											$id=mysql_real_escape_string($row['id']);	
											$img=mysql_real_escape_string($row['image']);
			
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><img class="gallery-pic img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $img;?>" ></td>
											<td><a href="gallery.php?gid=<?php echo $id;?>"><img src="<?php echo $site_url; ?>img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="gallery_add.php?hid=<?php echo $id;?>&simage=<?php echo $img;?>&type=delete"><img src="<?php echo $site_url; ?>img/delete.png" alt="" title="delete"></a></td>
											 <?php } else { ?>
											 <td><img src="<?php echo $site_url; ?>img/delete.png" alt="" title="delete"> <span class="demomode">[Demo Mode Enabled]</span></td>
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

</div>
<div class="min-space"></div>
<?php } else { header('Location:../login/login.php'); }?>

	<?php include("../footer.php"); ?>


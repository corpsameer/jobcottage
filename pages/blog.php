<title>Blog</title>
<?php 
include('../header.php');
 include("../database/connection.php");
?>
<div class="profile_main">
<h1 class="text-center"> <?php echo get_record(45,$lang,$en,$con);?> </h1>
</div>
<div class="min-space"></div>
<div class="container">
<div class="col-md-12">
<div class="col-md-8">

<?php
$sql=mysqli_query($con, "select * from sv_blog where lang_code='$lang'");
while($result=mysqli_fetch_array($sql))
{
	if($lang==$en)
		{
		$ser_id=$result['id'];
		}
		else
		{
			$ser_id=$result['page_parent'];
		}
	$full_desc=$result['description'];
	$desc = substr($full_desc, 0, 250);
 ?>
 <div class="blog">
<h2><?php echo $result['title']; ?></h2>
<p><?php echo $desc; ?></p>
<a href="<?php echo $site_url; ?>pages/single_blog.php?id=<?php echo $ser_id; ?>"><button class="blog-button"> <?php echo get_record(68,$lang,$en,$con);?>&nbsp; <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
</button></a>
</div>
<?php } ?>
</div>


<div class="col-md-4 widget-sidebar rtlimg">
<?php 
	$widget=mysqli_fetch_array(mysqli_query($con, "select * from sv_widget"));
	$widget_img=$widget['image'];
	echo $widget_img;
	?>
	<div class="blog-search">
	<h3> <?php echo get_record(69,$lang,$en,$con);?></h3>
	<a href="<?php echo $site_url; ?>shop/search.php"><button class="form-control btn btn-login"> <?php echo get_record(70,$lang,$en,$con);?></button></a>
	</div>
</div>
</div>
</div>


<div class="min-space"></div>


<?php include('../footer.php'); ?>	

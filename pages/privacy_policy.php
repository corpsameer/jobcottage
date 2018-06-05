<?php 
 include("../header.php");
?>
<?php 

if($lang==$en)
{
$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=5 and lang_code='$lang' and page_parent='0'"));
}
else
{
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='5'"));
}	

$content=$query['page_content'];
$page_name=$query['page_name'];
?>
  
 <div class="profile_main">
<h1 class="text-center"><?php echo $page_name;?></h1>
</div>
<div class="min-space"></div>
 <div class="container">
 <div class="terms-condition-bg">
 <?php echo $content;?>
</div>
</div>
<div class="min-space"></div>
<?php include('../footer.php'); ?>
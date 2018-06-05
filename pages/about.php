<title>About Us</title>

<?php 
 include("../header.php");
?>
<?php 
if($lang==$en)
{
$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=2 and lang_code='$lang' and page_parent='0'"));
}
else
{
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='2'"));
}	


$content=$query['page_content'];
$page_name=$query['page_name'];
?>
<div class="profile_main">
<h1 class="text-center"><?php echo $page_name;?></h1>
</div>
  <div class="min-space"></div>
 
 <?php echo $content;?>



<?php include('../footer.php'); ?>
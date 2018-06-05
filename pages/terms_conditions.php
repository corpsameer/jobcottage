<?php 
 include("../header.php");
?>
<?php 
$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=4"));
$content=$query['page_content'];
$page_name=$query['page_name'];
?>
  <div class="min-space"></div>
 
 <div class="container">
 <div class="terms-condition-bg">
 <?php echo $content;?>
</div>
</div>
<div class="min-space"></div>
<?php include('../footer.php'); ?>
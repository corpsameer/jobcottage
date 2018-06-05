<?php 
include('../header.php');
 include("../database/connection.php");
?>

<div class="min-space"></div>
<div class="container">
<?php
if (isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
	if($lang==$en)
		{
		$ser_id="id";
		}
		else
		{
			$ser_id="page_parent";
		}
	$sql=mysql_query("select * from sv_blog where lang_code='$lang' and ".$ser_id."=".$id);
	
	while($result=mysql_fetch_array($sql))
	{
 ?>
<div class="col-md-12 blog">
<h2><?php echo $result['title']; ?></h2>
<p><?php echo $result['description']; ?></p>
</div>

<?php } } ?>
</div>

<div class="min-space"></div>

<?php include('../footer.php'); ?>	

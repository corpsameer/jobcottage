<?php
include('../database/connection.php');
mysqli_query($con, "SET NAMES utf8");
mysqli_query($con, "SET CHARACTER SET utf8");
$pname=$_POST['pname'];

$type=$_POST['typ'];
if($type=='add')
{	
	/*if(mysqli_query($con, "insert into sv_pages(page_name)values('$pname')"))
		echo "Inserted";
	else
		echo "Server Error";
		header("Location:pages.php");*/

}
else if($type=='update')
{
	
	
	$page_content=$_POST['page_content'];
	$id=$_POST['id'];
		//mysqli_query($con, "update sv_pages set page_name='$pname', page_content='$page_content' where id='$id'");
		foreach($_POST['code'] as $index => $code)
		{
			$pagename=$pname[$index];
			$pagedesc=$page_content[$index];
			if($code==$en)
			{
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				mysqli_query($con, "update sv_pages set page_name='$pagename', page_content='$pagedesc', lang_code='$en' where id='$id'");
			}
			else
			{
				
               mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
                
				$numqry=mysqli_query($con, "select * from sv_pages where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysqli_num_rows($numqry);
				
				if($numrows==0)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "insert into sv_pages (page_name,page_content,lang_code,page_parent) values ('$pagename','$pagedesc','$code','$id')");
				}
				if($numrows==1)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "update sv_pages set page_name='$pagename', page_content='$pagedesc' where page_parent='$id' and lang_code='$code'");
				}
			}
		}
		
		?>
		<script type="text/javascript">
		var msg="Updated";
		window.location="pages.php?msg="+msg;				
		</script>
<?php		
}


?>
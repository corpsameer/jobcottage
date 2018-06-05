<?php
include('../database/connection.php');
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
$pname=$_POST['pname'];

$type=$_POST['typ'];
if($type=='add')
{	
	/*if(mysql_query("insert into sv_pages(page_name)values('$pname')"))
		echo "Inserted";
	else
		echo "Server Error";
		header("Location:pages.php");*/

}
else if($type=='update')
{
	
	
	$page_content=$_POST['page_content'];
	$id=$_POST['id'];
		//mysql_query("update sv_pages set page_name='$pname', page_content='$page_content' where id='$id'");
		foreach($_POST['code'] as $index => $code)
		{
			$pagename=$pname[$index];
			$pagedesc=$page_content[$index];
			if($code==$en)
			{
				mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
				mysql_query("update sv_pages set page_name='$pagename', page_content='$pagedesc', lang_code='$en' where id='$id'");
			}
			else
			{
				
               mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
                
				$numqry=mysql_query("select * from sv_pages where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysql_num_rows($numqry);
				
				if($numrows==0)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("insert into sv_pages (page_name,page_content,lang_code,page_parent) values ('$pagename','$pagedesc','$code','$id')");
				}
				if($numrows==1)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("update sv_pages set page_name='$pagename', page_content='$pagedesc' where page_parent='$id' and lang_code='$code'");
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
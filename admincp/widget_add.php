<?php
include('../database/connection.php');
@session_start();
$image=$_POST['image'];
$res=mysql_query("select * from sv_widget");
$row=mysql_num_rows($res);
$fet=mysql_fetch_array($res);
$id=$fet['id'];
if($row=="0")
{
	if(mysql_query("insert into sv_widget(image)values('$image')"))
		{
			$msg="Inserted";
			header("Location:widget.php?msg=".$msg);			
		}			
}
else
{	
	if(mysql_query("update sv_widget set image='$image' where id='$id'")) 
	{
		$msg="Updated";
		header("Location:widget.php?msg=".$msg);
	}		
}

?>
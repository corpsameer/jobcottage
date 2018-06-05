<?php
include('../database/connection.php');
@session_start();
$image=$_POST['image'];
$res=mysqli_query($con, "select * from sv_widget");
$row=mysqli_num_rows($res);
$fet=mysqli_fetch_array($res);
$id=$fet['id'];
if($row=="0")
{
	if(mysqli_query($con, "insert into sv_widget(image)values('$image')"))
		{
			$msg="Inserted";
			header("Location:widget.php?msg=".$msg);			
		}			
}
else
{	
	if(mysqli_query($con, "update sv_widget set image='$image' where id='$id'")) 
	{
		$msg="Updated";
		header("Location:widget.php?msg=".$msg);
	}		
}

?>
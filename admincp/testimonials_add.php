<?php
ob_start();
include('../database/connection.php');
$type=$_REQUEST['typ'];
if($type=='add')
{
	$file_name = $_FILES['testi_img']['name'];	
	$desc=$_POST['desc'];
	$name=$_POST['name'];
	if($file_name=="")
	{
		echo "select-img";
			header("Location:home-testimonials.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:home-testimonials.php?msg="."imgerr");
		}
		else if($_FILES['testi_img']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:home-testimonials.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "../testi-img/" .$file_name;
				move_uploaded_file($_FILES['testi_img']["tmp_name"],$path);
			}
			else 
				$file_name="";	
			
			
			
			
			
			 foreach($_POST['code'] as $index => $code)
		    {
				$pagename=$name[$index];
				$pagedesc=$desc[$index];
				
				if($code==$en)
			   {
				   $page_parent=0;
			   }
			   else
			   {
				    $checkwel=mysqli_query($con, "select * from sv_testimonials where testi_img='$file_name' and page_parent='0'");
					$rowline=mysqli_fetch_array($checkwel);
					$checkrow=mysqli_num_rows($checkwel);
					$checkid=$rowline['id'];
					if($checkrow==0)
					{
				    $page_parent=mysqli_insert_id();
					}
					else
					{
						$page_parent=$checkid;
					}
				  
			   }
			   
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				mysqli_query($con, "insert into sv_testimonials(testi_img,description,name,lang_code,page_parent)values('$file_name','$pagedesc','$pagename','$code','$page_parent')");
				
			   
			}
			
			
					$msg="Inserted";				
				header("Location:home-testimonials.php?msg=".$msg);
		}
	}
}
else if($type=='update')
{
	$flag=0;
	$id=$_POST['id'];
	$desc=$_POST['desc'];
	$name=$_POST['name'];
	$res=mysqli_query($con, "select * from sv_testimonials where id='$id'");
	$fet=mysqli_fetch_array($res);
	$old_file="../testi-img/".$fet['testi_img'];
	$file_name = $_FILES['testi_img']['name'];
	$random_digit=rand(0000,9999);
	
	if($file_name!="")
	{		
		$file_name= $random_digit.$file_name;
 		$path= "../testi-img/" .$file_name;
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$flag="1";
			$msg1="error1";					
		}
		else if($_FILES['testi_img']['size'] > 1048576)
		{
			$flag="1";
			$msg1="error2";					
		}	
		else {
		move_uploaded_file($_FILES['testi_img']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   	 		unlink($old_file);
		} }
	}
	else 
	{
		$old_file=mysqli_real_escape_string($con, $fet['testi_img']);
		$file_name=mysqli_real_escape_string($old_file);
	}
	if($flag=="0")
	{		


        foreach($_POST['code'] as $index => $code)
		{
		$pagename=$name[$index];
		$pagedesc=$desc[$index];
			if($code==$en)
			{
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				mysqli_query($con, "update sv_testimonials set testi_img='$file_name',description='$pagedesc',name='$pagename',lang_code='$en' where id='$id'");
			}
			else
			{
				
				
				
				$numqry=mysqli_query($con, "select * from sv_testimonials where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysqli_num_rows($numqry);
				
				if($numrows==0)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "insert into sv_testimonials (testi_img,description,name,lang_code,page_parent) values ('$file_name','$pagedesc','$pagename','$code','$id')");
				}
				if($numrows==1)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "update sv_testimonials set testi_img='$file_name',description='$pagedesc',name='$pagename' where page_parent='$id' and lang_code='$code'");
				}
				
				
				
			
			}
		
		}
		

		
			$msg="Updated";		
		header("Location:home-testimonials.php?msg=".$msg);	
	}
	else {
		$error="";
		if($flag=="1") 
		{
			if($msg1=="error1") 
				$error="imgerr";
			else if($msg1=="error2")
				$error="size-err";	
		}
		header("Location:home-testimonials.php?msg=".$error);	
	}
}

if($_REQUEST['type']=='delete')
{
	$hid=mysqli_real_escape_string($con, $_REQUEST["hid"]);
    unlink('../testi-img/'.$_REQUEST['simage']);
mysqli_query($con, "delete from sv_testimonials where id='$hid'");
	mysqli_query($con, "delete from sv_testimonials where page_parent='$hid'");	
	
	$msg="Deleted";	
		header("Location:home-testimonials.php?msg=".$msg);
}

?>
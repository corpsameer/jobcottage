<?php
include('../database/connection.php');
@session_start();

$parent=$_POST['parent'];
$word=$_POST['sname'];
$code=$_POST['code'];
$eword=$_POST['eword'];

	foreach($_POST['parent'] as $index => $parent)
		{
			//$parent_id=$parent[$index];
			$pageword=mysqli_real_escape_string($word[$index]);
			$aeeword=mysqli_real_escape_string($eword[$index]);
			
			
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
                
				$numqry=mysqli_query($con, "select * from sv_translate where lang_code='$code' and page_parent='$parent'");
				
				$numrows=mysqli_num_rows($numqry);
				
				if($numrows==0)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "insert into sv_translate (word,lang_code,page_parent) values ('$pageword','$code','$parent')");
				}
				if($numrows==1)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "update sv_translate set word='$pageword' where page_parent='$parent' and lang_code='$code'");
				}
				
				mysqli_query($con, "update sv_translate set word='$aeeword' where id='$parent' and lang_code='$en'");
			
			$msg="Updated";
			header("Location:translate.php?section=".$code."&msg=".$msg);
			
			
			
		}
?>
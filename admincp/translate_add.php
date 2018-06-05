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
			$pageword=mysql_real_escape_string($word[$index]);
			$aeeword=mysql_real_escape_string($eword[$index]);
			
			
				mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
                
				$numqry=mysql_query("select * from sv_translate where lang_code='$code' and page_parent='$parent'");
				
				$numrows=mysql_num_rows($numqry);
				
				if($numrows==0)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("insert into sv_translate (word,lang_code,page_parent) values ('$pageword','$code','$parent')");
				}
				if($numrows==1)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("update sv_translate set word='$pageword' where page_parent='$parent' and lang_code='$code'");
				}
				
				mysql_query("update sv_translate set word='$aeeword' where id='$parent' and lang_code='$en'");
			
			$msg="Updated";
			header("Location:translate.php?section=".$code."&msg=".$msg);
			
			
			
		}
?>
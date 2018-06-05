<?php
include('../database/connection.php');
@session_start();

for($i=234;$i<245;$i++)
{
	 mysql_query("insert into sv_translate (word,lang_code,page_parent) values ('','$en','')");
}
?>
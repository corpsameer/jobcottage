<?php
function get_record($idd,$lang,$en)
{

	if($lang==$en)
	{
		$query_value=mysql_fetch_array(mysql_query("select * from sv_translate where id='$idd' and lang_code='$lang' and page_parent='0'"));
		
	}
	else
	{
		$query_value=mysql_fetch_array(mysql_query("select * from sv_translate where lang_code='$lang' and page_parent='$idd'"));
		
		
	}
	return $query_value['word'];
	
}	
?>
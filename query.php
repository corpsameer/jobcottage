<?php
function get_record($idd,$lang,$en,$con=false)
{

	if($lang==$en)
	{
		$query_value=mysqli_fetch_array(mysqli_query($con, "select * from sv_translate where id='$idd' and lang_code='$lang' and page_parent='0'"));

	}
	else
	{
		$query_value=mysqli_fetch_array(mysqli_query($con, "select * from sv_translate where lang_code='$lang' and page_parent='$idd'"));


	}
	return $query_value['word'];

}
?>

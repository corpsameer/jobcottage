<?php
	include("../database/connection.php");	
	
	$type=$_REQUEST['type'];
	$booking_date=date("Y-m-d",strtotime($_REQUEST['booking_date']));
	   
	$booking_time=$_REQUEST['time'];
	$booking_per_hour=$_REQUEST['booking_per_hour'];
	$start_time=$_REQUEST['start_time'];
	$end_time=$_REQUEST['end_time'];
	

	   $name='';
		$id='';
		$res=mysql_query("select * from sv_booking where booking_date='$booking_date' and booking_time='$booking_time'");
		$sv_num_row=mysql_num_rows($res);
		if($sv_num_row<$booking_per_hour)
		{
			for($i=$start_time;$i<=$end_time;$i++)
			{
				if($i>12)
				{
					$d=$i-12;
					$ss=$d."PM";
				}
				else
				{
					$ss=$i."AM";
				} 
			
			 //$name.= $i;	
			//$name.="#";
			echo $name=$ss.'#'; 
			}
	    }
		else
		{
			/* $name.= "";		
			name.="#";
			echo $name; */
		}	
	
	
	
?>
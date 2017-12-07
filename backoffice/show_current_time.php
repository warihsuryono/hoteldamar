<?php	
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$sql="SELECT NOW()";
	$hsltemp=mysql_query($sql,$db);
	list($now)=mysql_fetch_array($hsltemp);
	$arr=explode(" ",$now);
	$time=$arr[1];
	$arr=explode("-",$arr[0]);
	$date=$arr[2]."-".$arr[1]."-".substr($arr[0],2,2);
	echo $date;
	echo ";";
	echo $time;
?>
<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$discname=$_GET["discname"];
	$sql="SELECT disc FROM mst_discount WHERE name='$discname'";
	$hsltemp=mysql_query($sql,$db);
	list($disc)=mysql_fetch_array($hsltemp);
	echo $disc;
?>
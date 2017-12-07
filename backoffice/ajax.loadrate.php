<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$room=$_GET["room"];
	$roomtipe=$_GET["roomtipe"];
	if($room){$sql="SELECT price,price2 FROM mst_room WHERE kode='$room'";}
	if($roomtipe){$sql="SELECT price,price2 FROM mst_room WHERE nama LIKE '$roomtipe'";}
	$hsltemp=mysql_query($sql,$db);
	list($price,$price2)=mysql_fetch_array($hsltemp);
	echo $price."|||".$price2;
?>
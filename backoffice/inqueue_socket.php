<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	$_message=$_GET["message"];
	$_msisdn=$_GET["msisdn"];
	if($_message && $_msisdn){
		$sql="INSERT INTO inqueue (modem_id,msisdn,qtime,message,status) VALUES (1,'$_msisdn',NOW(),'$_message',0)";
		mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){echo "1";}else{echo "0";}
	}
?>
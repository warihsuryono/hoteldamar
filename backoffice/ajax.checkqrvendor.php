<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$qrno=$_GET["qrno"];
	$vendorid=$_GET["vendorid"];
	$mode=$_GET["mode"];
	if($mode=="logistik"){$sql="SELECT qrno FROM logistik_qr_vendor WHERE qrno='$qrno' AND vendorid='$vendorid'";}
	if($mode=="workshop"){$sql="SELECT qrno FROM logistik_workshop_qr_vendor WHERE qrno='$qrno' AND vendorid='$vendorid'";}
	$hsltemp=mysql_query($sql,$db);
	if(mysql_affected_rows($db)>0){echo "1";}else{echo "0";}
?>
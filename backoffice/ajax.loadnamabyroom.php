<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$room=$_GET["room"];
	$tanggal=$_GET["tanggal"];
	$_periodetrx=substr($tanggal,0,8);
	$sql="SELECT kode FROM trx_booking WHERE room='$room' AND checkin='1' AND arrival<='$tanggal' AND departure>='$tanggal' AND kode NOT IN (SELECT booking FROM trx_billing WHERE tanggal LIKE '".$_periodetrx."%') ORDER BY tanggal DESC LIMIT 1";
	$hsltemp=mysql_query($sql,$db);
	list($kodebooking)=mysql_fetch_array($hsltemp);
	
	$sql="SELECT title,nama FROM trx_booking WHERE kode='$kodebooking'";
	$hsltemp=mysql_query($sql,$db);
	list($title,$namacustomer)=mysql_fetch_array($hsltemp);
	$namacustomer=$title." ".$namacustomer;
	echo $namacustomer;
?>
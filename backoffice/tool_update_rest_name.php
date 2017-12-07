<?php
	include_once "header.php";
	$sql="SELECT kode FROM trx_restaurant_bill WHERE nama=''";
	$hslrest=mysql_query($sql,$db);
	while(list($kode)=mysql_fetch_array($hslrest)){
		$sql="SELECT title,nama FROM trx_booking WHERE kode IN (SELECT kodebooking FROM trx_restaurant_bill WHERE kode='$kode')";
		$hsltemp=mysql_query($sql,$db);
		list($title,$namacustomer)=mysql_fetch_array($hsltemp);
		$namacustomer=$title." ".$namacustomer;
		$sql="UPDATE trx_restaurant_bill SET nama='$namacustomer' WHERE kode='$kode'";
		mysql_query($sql,$db);
		echo "<br>$sql => ".mysql_error();
	}
?>
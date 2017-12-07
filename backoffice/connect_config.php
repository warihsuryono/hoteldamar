<?php
	$host="localhost";
	$user="hotr9431_damar";
	$pass="hotr9431_damar";
	$dbname="hotr9431_damar";
	$mysqlbinpath="";
	//$mysqlbinpath="/opt/lampp/bin/";
	
	$host2="192.168.1.163";
	$user2="guest";
	$pass2="guest123";
	$dbname2="hoteldamar";
	function sanitasi($str){
		$strclear = addslashes(stripslashes(strip_tags($str)));
		return $strclear;
	}
?>

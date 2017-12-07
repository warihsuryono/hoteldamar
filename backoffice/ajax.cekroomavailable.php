<?php
	include_once "connect_config.php";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	$kode=$_GET["kode"];
	$room=$_GET["room"];
	$arrival=$_GET["arrival"];
	$departure=$_GET["departure"];
	$nowdate="";
	$looping=true;
	$available=1;
	$arrtgl=explode("-",$arrival);
	$tahun=$arrtgl[0];
	$bln=$arrtgl[1];
	$tgl=$arrtgl[2];
	$alertmessage="";
	
	while($nowdate!=$departure && $looping){
		$nowdate=date("Y-m-d",mktime(0,0,0,$bln,$tgl,$tahun));
		$sql="SELECT kode,arrival,departure FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival='$nowdate' OR departure='$nowdate')";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($kodebooking,$_arrival,$_departure)=mysql_fetch_array($hsltemp);
			if($kodebooking!=$kode){
				$looping=false;
				$available=0;
			}
		}
		
		if(!$available){//apakah departure==_arrival atau _departure==arrival
			if($nowdate==$departure && $departure==$_arrival){$available=1;}//departure==_arrival
			if($nowdate==$arrival && $arrival==$_departure){$available=1;}//_departure==arrival
		}
		
		$sql="SELECT kode,arrival,departure FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival<='$nowdate' AND departure>='$nowdate')";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($kodebooking,$_arrival,$_departure)=mysql_fetch_array($hsltemp);
			if($kodebooking!=$kode){
				$looping=false;
				$available=0;
			}
		}
			
		if(!$available){//apakah departure==_arrival atau _departure==arrival
			if($nowdate==$departure && $departure==$_arrival){$available=1;}//departure==_arrival
			if($nowdate==$arrival && $arrival==$_departure){$available=1;}//_departure==arrival
		}
		$tgl++;
	}
	if(!$available){
		$sql="SELECT title,nama,person,arrival,departure FROM trx_booking WHERE kode='$kodebooking'";
		$hsltemp=mysql_query($sql,$db);
		list($title,$nama,$person,$arrival,$departure)=mysql_fetch_array($hsltemp);
		$sql="SELECT description FROM mst_name_title WHERE kode='$title'";$hsltemp=mysql_query($sql,$db);
		list($title)=mysql_fetch_array($hsltemp);
		echo "Room not available, booked by $title $nama ( $person person) Arrival:$arrival Departure:$departure";
	}
?>
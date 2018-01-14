<?php
	function funccekroomavailable($kode,$room,$arrival,$departure){
		global $db;
		$nowdate="";
		$looping=true;
		$available=1;
		$arrtgl=explode("-",$arrival);
		$tahun=$arrtgl[0];
		$bln=$arrtgl[1];
		$tgl=$arrtgl[2];
		$alertmessage="";
		
		$sql="SELECT grup FROM trx_booking WHERE kode='$kode'";
		$hsl = mysql_query($sql,$db);
		list($grup) = mysql_fetch_array($hsl);
		if(!$grup){
			$kodes[$kode] = 1;
		} else {
			$sql = "SELECT kode FROM trx_booking WHERE grup = '$grup' ORDER BY kode";
			$hsl = mysql_query($sql,$db);
			while(list($kodeBooking) = mysql_fetch_array($hsl)){
				$kodes[$kodeBooking] = 1;
			}
		}
		
		while($nowdate!=$departure && $looping){
			$nowdate=date("Y-m-d",mktime(0,0,0,$bln,$tgl,$tahun));
			$sql="SELECT kode,arrival,departure FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival='$nowdate' OR departure='$nowdate') AND kode NOT IN (SELECT booking FROM trx_billing WHERE booking=trx_booking.kode AND paid='1') ORDER BY arrival DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			// echo "1. $sql<br>";
			if(mysql_affected_rows($db)>0){//arrival atau departure persis sama dengan bookingan lain
				list($kodebooking,$_arrival,$_departure)=mysql_fetch_array($hsltemp);
				if(!$kodes[$kodebooking]){
					$looping=false;
					$available=0;
				}
			}
			
			if(!$available){//apakah departure==_arrival atau _departure==arrival
				if($nowdate==$departure && $departure==$_arrival){$available=1;}//departure==_arrival
				if($nowdate==$arrival && $arrival==$_departure){$available=1;}//_departure==arrival
			}
			
			$sql="SELECT kode,arrival,departure FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival<='$nowdate' AND departure>='$nowdate') AND kode NOT IN (SELECT booking FROM trx_billing WHERE booking=trx_booking.kode AND paid='1') ORDER BY arrival DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			//echo "2. $sql<br>";
			if(mysql_affected_rows($db)>0){//diantara arrival dan departure bookingan lain
				list($kodebooking,$_arrival,$_departure)=mysql_fetch_array($hsltemp);
				if(!$kodes[$kodebooking]){
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
		/* if(!$available){
			$sql="SELECT kode FROM trx_billing WHERE booking='$kodebooking' AND paid='1'";mysql_query($sql,$db);
			if(mysql_affected_rows($db) > 0) $available = 1;
		} */
		
		return $available;
	}
?>
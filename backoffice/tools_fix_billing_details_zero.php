<?php
	include_once "connect_config.php";exit();//once only
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	$sql = "SELECT * FROM `trx_billing_details` WHERE description LIKE 'Room Charge%' AND debit+credit = 0;";
	$hslBilling = mysql_query($sql,$db);
	while($billings = mysql_fetch_array($hslBilling)){
		$kode = $billings["kode"];
		$sql = "SELECT rate,rate2 FROM trx_billing WHERE kode = '$kode'";
		$hsltemp = mysql_query($sql,$db);
		list($rate1,$rate2) = mysql_fetch_array($hsltemp);
		$sql="DELETE FROM trx_billing_details WHERE kode='".$billings["kode"]."'";
		mysql_query($sql,$db);
		echo $sql." => ".mysql_error()."<br>";
		
		$multiroom = false;
		$sql="SELECT kode,grup,booking FROM trx_billing WHERE grup IN (SELECT grup FROM trx_billing WHERE kode = '".$billings["kode"]."') ORDER BY booking";
		$hsl=mysql_query($sql,$db);
		$affectted_row = mysql_affected_rows($db);
		if($affectted_row > 1){
			$_arrtemp = mysql_fetch_array($hsl);
			$_grupBilling = $_arrtemp["grup"];
			if(strtolower(substr($_grupBilling,0,4)) == "bill"){
				$multiroom = $affectted_row;
				$_parentBooking = $_arrtemp["booking"];
			} else {
				$multiroom = false;
			}
		}
		
		if($multiroom) $sql = "SELECT booking FROM trx_billing WHERE grup='$_grupBilling' ORDER BY booking";
		else $sql = "SELECT booking FROM trx_billing WHERE kode='$kode' ORDER BY booking";
		$hslBookings = mysql_query($sql,$db);
		while(list($kodebooking) = mysql_fetch_array($hslBookings)){
			//deposits
			$sql="SELECT dp,dptype,dpbank,dpdate,refno,dp2,dptype2,dpbank2,dpdate2,refno2,dp3,dptype3,dpbank3,dpdate3,refno3,dp4,dptype4,dpbank4,dpdate4,refno4,dp5,dptype5,dpbank5,dpdate5,refno5 FROM trx_booking WHERE kode='".$kodebooking."'";
			$hsltemp=mysql_query($sql,$db);
			list($dp,$dptype,$dpbank,$dpdate,$refno,$dp2,$dptype2,$dpbank2,$dpdate2,$refno2,$dp3,$dptype3,$dpbank3,$dpdate3,$refno3,$dp4,$dptype4,$dpbank4,$dpdate4,$refno4,$dp5,$dptype5,$dpbank5,$dpdate5,$refno5)=mysql_fetch_array($hsltemp);
			$arrdp[1]=$dp ;$arrdptype[1]=$dptype; $arrdpbank[1]=$dpbank; $arrdpdate[1]=$dpdate; $arrrefno[1]=$refno;
			$arrdp[2]=$dp2;$arrdptype[2]=$dptype2;$arrdpbank[2]=$dpbank2;$arrdpdate[2]=$dpdate2;$arrrefno[2]=$refno2;
			$arrdp[3]=$dp3;$arrdptype[3]=$dptype3;$arrdpbank[3]=$dpbank3;$arrdpdate[3]=$dpdate3;$arrrefno[3]=$refno3;
			$arrdp[4]=$dp4;$arrdptype[4]=$dptype4;$arrdpbank[4]=$dpbank4;$arrdpdate[4]=$dpdate4;$arrrefno[4]=$refno4;
			$arrdp[5]=$dp5;$arrdptype[5]=$dptype5;$arrdpbank[5]=$dpbank5;$arrdpdate[5]=$dpdate5;$arrrefno[5]=$refno5;
			foreach($arrdp as $xx => $dp){
				if($dp > 0){
					$sql = "SELECT description FROM mst_pay_type WHERE kode = '".$arrdptype[$xx]."'";$hsltemp = mysql_query($sql,$db);
					list($paytype) = mysql_fetch_array($hsltemp);
					if($arrdptype[$xx] != "01"){
						$sql = "SELECT description FROM acc_mst_coa WHERE coa = '".$arrdpbank[$xx]."'";$hsltemp = mysql_query($sql,$db);
						list($bank) = mysql_fetch_array($hsltemp);
						$paytype .= " -- ".$bank;
					}
					$description = "Deposit [$paytype]";
					if($arrrefno[$xx]) $description .= " ;Refno: ".$arrrefno[$xx];
					$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,credit) VALUES ('$kode','".$arrdpdate[$xx]."','$description','$dp')";
					mysql_query($sql,$db);
					echo $sql." => ".mysql_affected_rows($db)."|".mysql_error()."<br>";
				}
			}
			
			//room
			$sql="SELECT DATE(checkindate),departure FROM trx_booking WHERE kode='$kodebooking'";
			$hsltemp=mysql_query($sql,$db);
			list($arrival,$departure)=mysql_fetch_array($hsltemp);
			$sql = "SELECT kode,nama FROM mst_room WHERE kode IN (SELECT room FROM trx_booking WHERE kode='$kodebooking')";$hsltemp = mysql_query($sql,$db);
			list($_kdroom,$roomname) = mysql_fetch_array($hsltemp);
			echo $sql." => ".mysql_affected_rows($db)."<br>";
			$_tanggalxx=$arrival;
			$tanggal = $departure;
			while($_tanggalxx!=$tanggal){
				$arrtgl=explode("-",$_tanggalxx);
				$_tgl=$arrtgl[2]; $_bln=$arrtgl[1]; $_thn=$arrtgl[0];
				$tipeday=date("N",mktime(0,0,0,$_bln,$_tgl,$_thn));
				if($tipeday==7 || $tipeday==1 || $tipeday==2 || $tipeday==3 || $tipeday==4){//weekdays minggu - kamis
					$description = "Room Charge -- $roomname (Week Days)";
					$nominal = $rate1;
				}else{
					$description = "Room Charge -- $roomname (Week Ends)";
					$nominal = $rate2;
				}
				// $nominal = $rates[$_kdroom][$_tanggalxx];
				$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$_tanggalxx."','$description',$nominal)";
				mysql_query($sql,$db);
				echo $sql." => ".mysql_affected_rows($db)."|".mysql_error()."<br>";
				$_tanggalxx=date("Y-m-d",mktime(0,0,0,$_bln,$_tgl+1,$_thn));
			}
			//miscellaneous
			$sql="SELECT kode FROM trx_additional_detail WHERE kode IN (SELECT kode FROM trx_additional WHERE kodebooking='$kodebooking' AND (paid='0' OR paid='2')) ORDER BY kode,seqno";
			$hslrest=mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
			}
			$sql="SELECT kode,tanggal,paid,refno FROM trx_additional WHERE kodebooking='$kodebooking' ORDER BY kode";
			$hsladditionals = mysql_query($sql,$db);
			while(list($kode_additional,$additionalDate,$paid,$refno) = mysql_fetch_array($hsladditionals)){
				$sql="SELECT kode,kode_add,qty,price,keterangan FROM trx_additional_detail WHERE kode='$kode_additional'  ORDER BY kode,seqno";
				$hsladditionaldetail=mysql_query($sql,$db);
				while(list($billno,$addid,$qty,$price,$keterangan)=mysql_fetch_array($hsladditionaldetail)){
					$sql="SELECT description FROM mst_additional WHERE kode='$addid'";$hsltemp=mysql_query($sql,$db);
					list($additional)=mysql_fetch_array($hsltemp);
					$description = "Miscellaneous -- $additional";
					if($keterangan != "") $description .= " ($keterangan)";
					if($refno) $description .= " ;Refno: ".$refno;
					$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$additionalDate."','$description','$price')";
					mysql_query($sql,$db);
					echo $sql." => ".mysql_affected_rows($db)."|".mysql_error()."<br>";
					if($paid == 1){
						$description = "Miscellaneous Paid -- $additional";
						$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,credit) VALUES ('$kode','".$additionalDate."','$description','$price')";
						mysql_query($sql,$db);
						echo $sql." => ".mysql_affected_rows($db)."|".mysql_error()."<br>";
					}
				}
			}
		}
		//latecheckout
		$latecheckout = 0;
		if($multiroom) $sql="SELECT tanggal,latecheckoutFee FROM trx_billing WHERE grup='$_grupBilling' AND latecheckoutFee > 0 LIMIT 1";
		else $sql="SELECT tanggal,latecheckoutFee FROM trx_billing WHERE kode='$kode' AND latecheckoutFee > 0 LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($latecheckoutDate,$latecheckout) = mysql_fetch_array($hsltemp);
			$description = "Late Checkout Fee";
			$sql = "INSERT INTO trx_billing_details (kode,tanggal,description,debit) VALUES ('$kode','".$latecheckoutDate."','$description','$latecheckout')";
			mysql_query($sql,$db);
			echo $sql." => ".mysql_affected_rows($db)."|".mysql_error()."<br>";
		}
		echo "=======================================================================<br>";
	}
?>
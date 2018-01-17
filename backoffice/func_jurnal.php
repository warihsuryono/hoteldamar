<?php
	function getRoomName($id){
		global $db;
		$sql = "SELECT nama FROM mst_room WHERE kode='$id'";
		$hsl = mysql_query($sql,$db);
		list($nama) = mysql_fetch_array($hsl);
		return $nama;
	}
	
	function generateMutasi($date1,$date2){
		global $db,$__username;
		$affected = 0;
		mysql_query("DELETE FROM trx_mutasi WHERE trxDate BETWEEN '$date1' AND '$date2' AND byGenerated = '1'",$db);
		//DEPOSIT KAMAR
		for($i=1;$i<6;$i++){
			if($i == 1) $x = "";
			else $x = $i;
			$sql = "SELECT kode,grup,title,nama,room,arrival,departure,dp".$x.",dptype".$x.",dpbank".$x.",dpdate".$x.",refno".$x." FROM trx_booking WHERE dpdate".$x." BETWEEN '".$date1."' AND '".$date2."' AND dp".$x." > 0 ORDER BY dpdate".$x;
			$hsl = mysql_query($sql,$db);
			while(list($kode,$grup,$title,$nama,$room,$arrival,$departure,$dp,$dptype,$dpbank,$dpdate,$refno) = mysql_fetch_array($hsl)){
				$rooms = "";
				if($grup == "0"){
					$rooms = getRoomName($room);
				} else {
					$sql = "SELECT room FROM trx_booking WHERE grup = '$grup'";
					$hslRooms = mysql_query($sql,$db);
					while(list($room) = mysql_fetch_array($hslRooms)){
						$rooms .= getRoomName($room).",";
					}
					$rooms = substr($rooms,0,-1);
				}
				
				$depositType = "";
				if($dptype == "01") $depositType = "Cash";
				if($dptype == "02") $depositType = "Credit";
				if($dptype == "03") $depositType = "Debit Card";
				if($dptype == "04") $depositType = "Bank Transfer";
				if($dpbank != ""){
					$sql = "SELECT description FROM acc_mst_coa WHERE coa = '".$dpbank."'";
					$hsltemp = mysql_query($sql,$db);
					list($bankname) = mysql_fetch_array($hsltemp);
					$depositType .= " -- ".$bankname;
				} else {
					$dpbank = "1.0.00";
				}
				$description = "Ref No: ".$refno." -- Deposit [".$depositType."] ($rooms) ".format_tanggal($arrival)." s/d ".format_tanggal($departure)."  a/n ".$title.". ".$nama;
				$sql = "INSERT INTO trx_mutasi (trxDate,byGenerated,coa,refno,debit,description,created_at,created_by) VALUES ";
				$sql .= "('".$dpdate."','1','".$dpbank."','".$refno."','".$dp."','".$description."',NOW(),'".$__username."')";
				mysql_query($sql,$db);
				if(mysql_affected_rows($db) > 0) $affected++;
			}
		}
		
		//PAID
		if($dptype == "01") $depositType = "Cash";
		if($dptype == "02") $depositType = "EDC";
		if($dptype == "04") $depositType = "Bank Transfer";
		$sql = "SELECT * FROM trx_billing_payments WHERE paid_at BETWEEN '".$date1."' AND '".$date2."'";
		$hsl = mysql_query($sql,$db);
		while($payments = mysql_fetch_array($hsl)){
			$rooms = "";
			$_title = "";
			$_nama = "";
			$_arrival = "";
			$_departure = "";
			$sql = "SELECT kode,grup FROM trx_booking WHERE kode IN (SELECT booking FROM trx_billing WHERE kode = '".$payments["kodeBilling"]."') LIMIT 1";
			$hslBookingGrup = mysql_query($sql,$db);
			list($bookingKode,$bookingGrup) = mysql_fetch_array($hslBookingGrup);
			if($bookingGrup == "0"){
				$sql = "SELECT title,nama,arrival,departure,room FROM trx_booking WHERE kode='".$bookingKode."'";
			} else {
				$sql = "SELECT title,nama,arrival,departure,room FROM trx_booking WHERE grup='".$bookingGrup."'";
			}
			echo $sql."<br>";
			$hslRooms = mysql_query($sql,$db);
			while(list($title,$nama,$arrival,$departure,$kodeRoom) = mysql_fetch_array($hslRooms)){
				$rooms .= getRoomName($kodeRoom).",";
				$_title = $title;
				$_nama = $nama;
				$_arrival = $arrival;
				$_departure = $departure;
			}
			$rooms = substr($rooms,0,-1);
			
			
			$depositType = "";
			if($payments["paymenttype"] == "01") $depositType = "Cash";
			if($payments["paymenttype"] == "02") $depositType = "EDC";
			if($payments["paymenttype"] == "04") $depositType = "Bank Transfer";
			$dpbank = $payments["coabank"];
			if($dpbank != ""){
				$sql = "SELECT description FROM acc_mst_coa WHERE coa = '".$dpbank."'";
				$hsltemp = mysql_query($sql,$db);
				list($bankname) = mysql_fetch_array($hsltemp);
				$depositType .= " -- ".$bankname;
			} else {
				$dpbank = "1.0.00";
			}
			
			$description = "Room Payment [".$depositType."] ($rooms) ".format_tanggal($_arrival)." s/d ".format_tanggal($_departure)."  a/n ".$_title.". ".$_nama;
			
			if($payments["nominal"] >= 0){
				$debit = $payments["nominal"];
				$credit = 0;
			} else {
				$debit = 0;
				$credit = $payments["nominal"] * -1;
				$description = "(Change) ".$description;
			}
			
			$sql = "INSERT INTO trx_mutasi (trxDate,byGenerated,coa,refno,debit,credit,description,created_at,created_by) VALUES ";
			$sql .= "('".$payments["paid_at"]."','1','".$dpbank."','','".$debit."','".$credit."','".$description."',NOW(),'".$__username."')";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db) > 0) $affected++;
		}
		return $affected;
	}
	
	function add_mutasi_uang($tanggal,$mode,$coabank,$cardno,$modul,$kode_trx,$kodejurnal,$coa,$notes,$debit,$kredit,$refno = ""){
		global $db,$__username;
		if($modul == "acc_jurnal_detail.php"){
			$kodetrx="TRX/".date("ymd")."/";
			$sql="SELECT idseqno FROM trx_mutasi_uang WHERE kode LIKE '$kodetrx%' ORDER BY idseqno DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			list($idseqno)=mysql_fetch_array($hsltemp);
			$idseqno++;
			$kodetrx.=substr("000",0,3-strlen($idseqno)).$idseqno;
			$createby=$__username;
			$sql="INSERT INTO trx_mutasi_uang (kode,idseqno,tanggal,mode,coabank,cardno,modul,kode_trx,kodejurnal,coa,notes,debit,kredit,createby,createdate) VALUES ";
			$sql.="('$kodetrx','$idseqno','$tanggal','$mode','$coabank','$cardno','$modul','$kode_trx','$kodejurnal','$coa','$notes','$debit','$kredit','$createby',NOW())";
			mysql_query($sql,$db);
			return $kodetrx;
		}
		if($modul == "trx_additionalview.php" && $refno!=""){
			$sql="UPDATE trx_additional SET refno='".$refno."' WHERE kode='".$kode_trx."'";
			mysql_query($sql,$db);
			return 1;
		}
	}
	function add_jurnal($tanggal,$norek,$vendor,$notes){
		global $db,$__username;
		/* $kodejurnal="JURNAL/".date("ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		//INSERT ACCOUNTING			
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','$vendor','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);			
		//echo "<br>$sql => ".mysql_error(); */
		return $kodejurnal;
	}
	
	function add_jurnal_detail($kodejurnal,$coa,$keterangan,$debit,$kredit){
		global $db;
		/* $sql="SELECT seqno FROM acc_jurnal_detail WHERE kodejurnal='$kodejurnal' ORDER BY seqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($seqno)=mysql_fetch_array($hsltemp);
			$seqno++;
		}else{
			$seqno=0;
		}
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa','$koder','$keterangan','$debit','$kredit')";
		mysql_query($sql,$db); */
		//echo "<br>$sql => ".mysql_error();
	}
?>
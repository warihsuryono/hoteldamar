<?php
	include_once "connect_config.php";
	$dbnamekf="kagfactory";
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db); 
	
	function cekroomavailable ($kode,$room,$arrival,$departure){
		global $db;
		$nowdate="";
		$looping=true;
		$available=1;
		$arrtgl=explode("-",$arrival);
		$tahun=$arrtgl[0];
		$bln=$arrtgl[1];
		$tgl=$arrtgl[2];
		$alertmessage="";
		$kodebooking="";
		while($nowdate!=$departure && $looping){
			$nowdate=date("Y-m-d",mktime(0,0,0,$bln,$tgl,$tahun));
			$sql="SELECT kode FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival='$nowdate' OR departure='$nowdate')";
			$hsltemp=mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				list($kodebooking)=mysql_fetch_array($hsltemp);
				if($kodebooking!=$kode){
					$looping=false;
					$available=0;
				}
			}
			$sql="SELECT kode FROM trx_booking WHERE room='$room' AND confirmasi=1 AND (arrival<='$nowdate' AND departure>='$nowdate')";
			$hsltemp=mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				list($kodebooking)=mysql_fetch_array($hsltemp);
				if($kodebooking!=$kode){
					$looping=false;
					$available=0;
				}
			}
			$tgl++;
		}
		if($available==1){return $available;}else{return $kodebooking;}
		
	}
	
	$tanggal=date("Y-m-d");
	$recvby="SMS";
	$sql="SELECT id,modem_id,destmsisdn,msisdn,qtime,message FROM inqueue WHERE status='0' ORDER BY id";
	$hslqueue=mysql_query($sql,$db);
	while(list($id,$modem_id,$destmsisdn,$msisdn,$qtime,$message)=mysql_fetch_array($hslqueue)){
		$reply="FORMAT SALAH! Silakan Ulangi Lagi!";
		if(substr($msisdn,0,1)=="0"){$_msisdn=substr($msisdn,1,strlen($msisdn)-1);}
		if(substr($msisdn,0,2)=="62"){$_msisdn=substr($msisdn,2,strlen($msisdn)-2);}
		if(substr($msisdn,0,3)=="+62"){$_msisdn=substr($msisdn,3,strlen($msisdn)-3);}
		//echo $message;
		$arrmessage=explode(".",$message);
		$operand=strtoupper($arrmessage[0]);
		$namatamu=strtoupper($arrmessage[1]);
		$tgldatang=$arrmessage[2];
		$lamainap=$arrmessage[3];
		$room=$arrmessage[4];
		$rate1=$arrmessage[5];
		$rate2=$arrmessage[6];
		$operand=str_ireplace(" ","",$operand);
		$tgldatang=str_ireplace(" ","",$tgldatang);
		$lamainap=str_ireplace(" ","",$lamainap);
		$room=str_ireplace(" ","",$room);
		$rate1=str_ireplace(" ","",$rate1);
		$rate2=str_ireplace(" ","",$rate2);
		//echo $operand;
		if($operand=="CEK"){
			$reply="SMS OK!";
		}
		if($operand=="BOOKING"){//booking.[namatamu].[tgldatang].[lamainap].[room].[rateweekend].[rateweekdays]
			if(count($arrmessage)>=5 && is_numeric($lamainap)){
				$sql="SELECT username,nama FROM user_account WHERE hp1 LIKE '%".$_msisdn."' OR hp2 LIKE '%".$_msisdn."'";
				$hsltemp=mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
					list($username,$namakaryawan)=mysql_fetch_array($hsltemp);
					
					$noroom=substr($room,strlen($room)-2,2);
					$reply="";
					if(is_numeric(substr($noroom,0,1))){
						$room=substr($room,0,strlen($room)-2)."%".$noroom;
					}else if(is_numeric(substr($noroom,1,1))){
						$room=substr($room,0,strlen($room)-1)."%".substr($noroom,1,1);
					}

					$sql="SELECT kode,nama,price,price2 FROM mst_room WHERE nama LIKE '$room'";
					$hsltemp=mysql_query($sql,$db);
					if(mysql_affected_rows($db)>0){
						list($room,$namaroom,$price,$price2)=mysql_fetch_array($hsltemp);
					}else{
						$reply="Room tidak dikenal, Silakan Ulangi Lagi!";
					}
					
					if($reply==""){
						if(strlen($tgldatang)==6){
							$tgldatang="20".substr($tgldatang,0,2)."-".substr($tgldatang,2,2)."-".substr($tgldatang,4,2);
						}
						if(strlen($tgldatang)==8){
							$tgldatang=substr($tgldatang,0,4)."-".substr($tgldatang,4,2)."-".substr($tgldatang,6,2);
						}
						
						$tanggal=date("Y-m-d");
						$kode="BOOK/".date("ymd")."/";
						$sql="SELECT idseqno FROM trx_booking WHERE kode LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
						$hsltemp=mysql_query($sql,$db);
						list($idseqno)=mysql_fetch_array($hsltemp);
						$idseqno++;
						$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
						
						$createby=$username;
						$createdate=$__now;						
						
						$departure=date("Y-m-d",mktime(0,0,0,substr($tgldatang,5,2),substr($tgldatang,8,2)+$lamainap,substr($tgldatang,0,4)));
						
						$cekroomavailable=cekroomavailable ($kode,$room,$tgldatang,$departure);
						
						if($cekroomavailable == 1){
							if($rate1<=0 || !$rate1){$rate1=$price;}else{$rate1=str_ireplace(" ","",$rate1)*1;}
							if($rate2<=0 || !$rate2){$rate2=$price2;}else{$rate2=str_ireplace(" ","",$rate2)*1;}
							
							$sql="INSERT INTO trx_booking (kode,idseqno,tanggal,nama,room,arrival,departure,rate1,rate2,confirmasi,checkin,createby,createdate) VALUES ";
							$sql.="('$kode','$idseqno','$tanggal','$namatamu','$room','$tgldatang','$departure','$rate1','$rate2','1','0','$createby',NOW())";
							mysql_query($sql,$db);
							
							$reply="Booking atas nama $namatamu di kamar $namaroom telah tercatat, dan telah KONFIRMASI dengan nomor booking $kode";
						}else{
							$sql="SELECT title,nama,person,arrival,departure FROM trx_booking WHERE kode='$cekroomavailable'";
							$hsltemp=mysql_query($sql,$db);
							list($title,$nama,$person,$arrival,$departure)=mysql_fetch_array($hsltemp);
							$sql="SELECT description FROM mst_name_title WHERE kode='$title'";$hsltemp=mysql_query($sql,$db);
							list($title)=mysql_fetch_array($hsltemp);
							$reply="Room $namaroom NOT AVAILABLE, booked by $title $nama Arrival:$arrival Departure:$departure";
						}
					}
				}else{
					$reply="No HP Anda tidak dikenal, Silakan gunakan No HP yang telah didaftarkan!";
				}
			}else{
				$reply="FORMAT SALAH! Silakan Ulangi Lagi!";
			}
		}
		
		$modem_id=1;
		$msisdn="0".$_msisdn;
		if($reply!=""){
			$sql="INSERT INTO outqueue(modem_id,msisdn,qtime,message,status) VALUES ('$modem_id','$msisdn',NOW(),'$reply','1')";
			mysql_query($sql,$db);
			
			mysql_select_db($dbnamekf,$db); 
			$sql="INSERT INTO outqueue(modem_id,msisdn,qtime,message,status) VALUES ('$modem_id','$msisdn',NOW(),'$reply','0')";
			mysql_query($sql,$db);
			mysql_select_db($dbname,$db); 
			
		}
		$sql="UPDATE inqueue SET exectime=NOW(),status='1' WHERE id='$id'";
		mysql_query($sql,$db);
	}
?>
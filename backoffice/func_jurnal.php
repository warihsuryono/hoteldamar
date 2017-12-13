<?php
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
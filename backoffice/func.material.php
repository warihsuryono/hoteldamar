<?php
	function material_kodebynama($namabarang,$satuan,$harsat,$generate){
		global $db;
		$sql="SELECT kode FROM mst_material_part WHERE nama LIKE '$namabarang'";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($kodebarang)=mysql_fetch_array($hsltemp);
		}else{
			if($generate){
				$kodebarang="GEN";
				$sql="SELECT kode FROM mst_material_part WHERE kode LIKE '$kodebarang%' ORDER BY kode DESC LIMIT 1";
				$hsltemp=mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
					list($kodebarang)=mysql_fetch_array($hsltemp);
					$seqno=str_ireplace("GEN","",$kodebarang);
					$seqno=$seqno*1;
					$seqno++;
					$kodebarang="GEN".substr("0000000",0,7-strlen($seqno)).$seqno;
				}else{
					$kodebarang="GEN0000001";
				}
				$sql="INSERT INTO mst_material_part (kode,nama,satuan) VALUES ('$kodebarang','$namabarang','$satuan')";
				mysql_query($sql,$db);
			}else{
				$kodebarang="";
			}
		}
		return $kodebarang;
	}
?>
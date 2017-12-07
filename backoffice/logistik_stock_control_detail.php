<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sign=$_GET["sign"];
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($sign){
		$signby=$sign."by";
		$signdate=$sign."date";
		if($sign=="security"){//perbaikan nominal stock
			$sql="SELECT tanggal,gudang FROM $tablename WHERE $kodename='$kode'";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
			list($histdate,$gudang)=mysql_fetch_array($hsltemp);
			$modulfilename=basename($__phpself);
			$sql="SELECT kodebarang,systemqty,realqty,satuan,keterangan FROM $tabledetailname WHERE $kodename='$kode'";
			$hsldet=mysql_query($sql,$db);			
			$createby=$__username;
			while(list($kodebarang,$systemqty,$realqty,$satuan,$notes)=mysql_fetch_array($hsldet)){
				//cari qty di system
				//qtymasuk
				$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE destid='$gudang' AND kodebarang='$kodebarang'";
				$hsltemp=mysql_query($sql,$db);
				list($qtymasuk)=mysql_fetch_array($hsltemp);
				//qtykeluar
				$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE sourceid='$gudang' AND kodebarang='$kodebarang'";
				$hsltemp=mysql_query($sql,$db);
				list($qtykeluar)=mysql_fetch_array($hsltemp);
				$systemqty=$qtymasuk-$qtykeluar;
				if($systemqty<=$realqty){//tambah qty
					$in_out="1";
					$sourcetype="{kontrol}";
					$sourceid="{kontrol}";
					$desttype="gudang";
					$destid=$gudang;
					$qty=$realqty-$systemqty;
				}else{//kurangi qty
					$in_out="2";
					$sourcetype="gudang";
					$sourceid=$gudang;
					$desttype="{kontrol}";
					$destid="{kontrol}";
					$qty=$systemqty-$realqty;
				}
				if($qty!=0){
					$sql="INSERT INTO logistik_hist_stok (in_out,histdate,modulfilename,mrno,pono,wrno,sourcetype,sourceid,desttype,destid,kodebarang,qty,satuan,notes,createby,createdate) VALUES ";
					$sql.="('$in_out','$histdate','$modulfilename','$mrno','$pono','$kode','$sourcetype','$sourceid','$desttype','$destid','$kodebarang','$qty','$satuan','$notes','$createby',NOW())";
					mysql_query($sql,$db);
					//echo "<br>$sql => ".mysql_error();
				}
				$sql="SELECT seqno FROM logistik_stok WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
				mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){//sudah ada
					$sql="UPDATE logistik_stok SET stock=$realqty,createby='$createby',createdate=NOW() WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
				}else{//belum ada
					$sql="INSERT INTO logistik_stok (branchtype,branchid,kodebarang,stock,createby,createdate) VALUES ";
					$sql.="('gudang','$gudang','$kodebarang','$realqty','$createby',NOW())";
				}
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
		}
		$sql="UPDATE $tablename SET $signby='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					// alert(returnvalue);
					idnamabarang=textid.replace("kodebarang","namabarang");
					idsystemqty=textid.replace("kodebarang","systemqty");
					idrealqty=textid.replace("kodebarang","realqty");
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idsatuan).value=arrreturnvalue[1];
					document.getElementById(idsystemqty).value=arrreturnvalue[2];
					document.getElementById(idrealqty).value=arrreturnvalue[2];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename=logistik_stock_control&value="+textvalue+"&gudang="+document.getElementById("gudang").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename=logistik_stock_control&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>STOCK CONTROL</b></h3></td></tr></table>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Kode Kontrol</td>
							<td>:</td>
							<td id="kodecek"></td>
						</tr>
						<!--tr>
							<td>Gudang</td>
							<td>:</td>
							<td id="gudang"></td>
						</tr-->
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Tanggal Kontrol</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td>:</td>
							<td id="notes"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1"><b>No</b></td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<td><b>Qty Tercatat</b></td>
				<td><b>Qty Sebenarnya</b></td>
				<td><b>Satuan</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="kodebarang[0]"></td>
				<td id="namabarang[0]"></td>
				<td id="systemqty[0]"></td>
				<td id="realqty[0]"></td>
				<td id="satuan[0]"></td>
				<td id="keterangan[0]"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
<?php
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	$fieldselect="";
	while(list($fieldname)=mysql_fetch_array($hsltemp)){
		if($fieldname!=$kodename){
			$fieldselect.="`$fieldname`,";
		}
	}
	$fieldselect=substr($fieldselect,0,strlen($fieldselect)-1);
	$sql="SELECT $fieldselect FROM $tablename WHERE $kodename='$kode'";
	$hsltemp=mysql_query($sql,$db);
	$tablevalues=mysql_fetch_assoc($hsltemp);
	foreach ($tablevalues as $varname => $value){
		eval("\$$varname = $value;");
		$sql="SELECT nama,signature FROM user_account WHERE username='$value'";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($nama,$signature)=mysql_fetch_array($hsltemp);
			eval("\$_$varname = \"$nama\";");
			eval("\$__$varname = \"$signature\";");
		}
		
		$value=str_ireplace(chr(13).chr(10)," ",$value);
		if($varname=="gudang"){
			$sql="SELECT kode,nama,alamat FROM mst_gudang WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($_kodegudang,$_nama,$_alamat)=mysql_fetch_array($hsltemp);
			$value=$_nama." ".$_alamat;
		}
		?><script language="javascript">document.getElementById("<?php echo $varname; ?>").innerHTML="<?php echo $value; ?>";</script><?php
	}
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
	//LOAD DETAIL
	$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($jumlahdetail)=mysql_fetch_array($hsltemp);
	for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
	
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	$selectdetail="";
	while(list($fieldname)=mysql_fetch_array($hsltemp)){
		if($fieldname!=$kodename){
			$selectdetail.="`$fieldname`,";
		}
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
		if($fieldtype=="double"){$istypedouble[$fieldname]=1;}
	}
	$selectdetail=substr($selectdetail,0,strlen($selectdetail)-1);
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
	$hsldet=mysql_query($sql,$db);
	$no=-1;
	while($detailvalues=mysql_fetch_assoc($hsldet)){
		$no++;
		$kodebarang="";
		foreach ($detailvalues as $vardetailname => $valuedetail){
			if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
			$valuedetail=str_ireplace("\"","''",$valuedetail);
			if($vardetailname=="kodebarang"){$kodebarang=$valuedetail;}
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
		}
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$namabarang=str_ireplace(chr(34),"''",$namabarang);
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").innerHTML="<?php echo $namabarang; ?>";</script><?php
	}
	
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__cekby)){$__cekby=$imgnull;}
	if(!is_file("signature/".$__securityby)){$__securityby=$imgnull;}
	if(!is_file("signature/".$__dirutby)){$__dirutby=$imgnull;}
	if(!$_cekby){$_cekby=$null;}
	if(!$_securityby){$_securityby=$null;}
	if(!$_dirutby){$_dirutby=$null;}
	if($cekby && !$securityby){$_securityby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=security&kode=$kode';}\">";}
	if($securityby && !$dirutby){$_dirutby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=dirut&kode=$kode';}\">";}
?>
	<table width="100%">
		<tr style="text-align:center;">
			<td>Dikontrol,</td>
			<td>Security,</td>
			<td>Dirut,</td>
		</tr>
		<tr style="text-align:center;vertical-align:bottom;height:80px">
			<td align="center"><img src="signature/<?php echo $__cekby; ?>" width="100" height="50" border='0'></td>
			<td align="center"><img src="signature/<?php echo $__securityby; ?>" width="100" height="50" border='0'></td>
			<td align="center"><img src="signature/<?php echo $__dirutby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:center;">
			<td>(<?php echo $_cekby; ?>)</td>
			<td>(<?php echo $_securityby; ?>)</td>
			<td>(<?php echo $_dirutby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
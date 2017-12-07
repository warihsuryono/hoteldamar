<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<4;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
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
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idsatuan).value=arrreturnvalue[1];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue+"&kode_pekerjaan="+document.getElementById("kode_pekerjaan").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>PERMINTAAN QUOTATION</b></h3></td></tr></table>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>QR No</td>
							<td>:</td>
							<td id="qrno"</td>
						</tr>
						<tr>
							<td>Tanggal QR</td>
							<td>:</td>
							<td id="tanggalqr"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr-->
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Periode</td>
							<td>:</td>
							<td id="periode"></td>
						</tr>
						<tr>
							<td>Tanggal Terima</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td>:</td>
							<td id="vendorid"></td>
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
				<td><b>Qty</b></td>
				<td><b>Satuan</b></td>
				<td><b>Harga</b></td>
				<td><b>Jumlah</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="kodebarang[0]"></td>
				<td id="namabarang[0]"></td>
				<td id="qty[0]" align="right"></td>
				<td id="satuan[0]"></td>
				<td id="harsat[0]" align="right"></td>
				<td id="jumlah[0]" align="right"></td>
				<td id="keterangan[0]"></td>
			</tr>
			<tr id="rowdetail_footer">
				<td valign="top" colspan="6" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><b>SUB TOTAL</b></td>
						</tr>
						<tr>
							<td align="right"><b>PPN</b></td>
						</tr>
						<tr>
							<td align="right"><b>TOTAL</b></td>
						</tr>
					</table>
				</td>
				<td valign="top" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right" id="subtotal"></td>
						</tr>
						<tr>
							<td align="right" id="ppn"></td>
						</tr>
						<tr>
							<td align="right" id="total"></td>
						</tr>
					</table>
				</td>
				<td></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
<?php
	$kode=$_GET["kode"];
	$vendorid=$_GET["vendorid"];
	//load dari qr
	$sql="SELECT kode_pekerjaan,tanggal,periode FROM logistik_qr WHERE qrno='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($kode_pekerjaan,$tanggalqr,$periode)=mysql_fetch_array($hsltemp);
	$tanggalqr=substr($tanggalqr,8,2)."/".substr($tanggalqr,5,2)."/".substr($tanggalqr,0,4);
	$periode=date("F Y",mktime(0,0,0,substr($periode,5,2),1,substr($periode,0,4)));
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
	?><script language="javascript">
		//document.getElementById("kode_pekerjaan").innerHTML="<?php echo $kode_pekerjaan; ?>";
	</script><?php
	?><script language="javascript">document.getElementById("tanggalqr").innerHTML="<?php echo $tanggalqr; ?>";</script><?php
	?><script language="javascript">document.getElementById("periode").innerHTML="<?php echo $periode; ?>";</script><?php
	
	//load dari qr vendor
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	$fieldselect="";
	while(list($fieldname)=mysql_fetch_array($hsltemp)){
		if($fieldname!=$kodename){
			$fieldselect.="`$fieldname`,";
		}
	}
	$fieldselect=substr($fieldselect,0,strlen($fieldselect)-1);
	$sql="SELECT $fieldselect FROM $tablename WHERE $kodename='$kode' and vendorid='$vendorid'";
	$hsltemp=mysql_query($sql,$db);
	$tablevalues=mysql_fetch_assoc($hsltemp);
	foreach ($tablevalues as $varname => $value){
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
		if($varname=="vendorid"){
			$sql="SELECT nama FROM mst_vendor WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($value)=mysql_fetch_array($hsltemp);
		}
		?><script language="javascript">document.getElementById("<?php echo $varname; ?>").innerHTML="<?php echo $value; ?>";</script><?php
		//echo "<br> document.getElementById('$varname').value='$value';</script>";
	}
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
	//LOAD DETAIL
	$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode' and vendorid='$vendorid'";
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
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode' and vendorid='$vendorid'";
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
			?><script language="javascript">hitungjumlah_inner('qty[<?php echo $no; ?>]','harsat[<?php echo $no; ?>]','jumlah[<?php echo $no; ?>]');sumnumber_inner('jumlah','input','subtotal');</script><?php
		}
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$namabarang=str_ireplace(chr(34),"''",$namabarang);
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").innerHTML="<?php echo $namabarang; ?>";</script><?php
	}
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__receiveby)){$__receiveby=$imgnull;}
	if(!$_receiveby){$_receiveby=$null;}
?>
	<table width="100%">
		<tr style="text-align:left;">
			<td>Dibuat Oleh</td>
		</tr>
		<tr style="text-align:left;vertical-align:bottom;height:80px">
			<td align="left"><img src="signature/<?php echo $__receiveby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:left;">
			<td>(<?php echo $_receiveby; ?>)</td>
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
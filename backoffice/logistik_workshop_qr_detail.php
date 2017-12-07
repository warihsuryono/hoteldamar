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
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
	
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		
		function loaddetailpr(prno){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnval=xmlHttp.responseText;
					arrreturnvaltemp=returnval.split("<field1>");
					//kode_pekerjaan=arrreturnvaltemp[0];
					//document.getElementById("kode_pekerjaan").value=kode_pekerjaan;
					returnval=arrreturnvaltemp[1];
					arrreturnval=returnval.split("<br>");
					maxrow=arrreturnval.length;
					for(jj=0;jj<maxrow;jj++){
						contentrow=arrreturnval[jj];
						contentrow_1=arrreturnval[jj+1];
						try{
							arrcontent=contentrow.split("|||");						
							arrcontent_1=contentrow_1.split("|||");						
							kode=arrcontent[0];
							nama=arrcontent[1];
							qty=arrcontent[2];
							satuan=arrcontent[3];
							keterangan=arrcontent[4];
							//alert(kode+":"+nama+":"+qty+":"+satuan+":"+harga+":"+jumlah+":"+keterangan);
							if(kode!="undefined" && kode !=""){
								if(arrcontent_1[0]!="undefined" && arrcontent_1[0]!=""){addrow('0','tabledetail','rowdetail','+');}
								document.getElementById("kodebarang["+jj+"]").value=kode;
								document.getElementById("namabarang["+jj+"]").value=nama;
								document.getElementById("qty["+jj+"]").value=qty;
								document.getElementById("satuan["+jj+"]").value=satuan;
								document.getElementById("keterangan["+jj+"]").value=keterangan;
							}
						} catch (e) {
						}
					}
				}
			}
			xmlHttp.open("GET","ajax.loaddetailpr.php?prno="+prno,true);
			xmlHttp.send(null);	
		}
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					// alert(returnvalue);
					idnamabarang=textid.replace("partno","namabarang");
					idsatuan=textid.replace("partno","satuan");
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
							<td>PR No</td>
							<td>:</td>
							<td id="mrno"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr-->
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Periode</td>
							<td>:</td>
							<td id="periode"></td>
						</tr>
						<!--tr>
							<td>Gudang</td>
							<td>:</td>
							<td id="gudang"></td>
						</tr-->
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
				<td><b>Qty</b></td>
				<td><b>Satuan</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="partno[0]"></td>
				<td id="namabarang[0]"></td>
				<td id="qty[0]"></td>
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
	foreach ($tablevalues as $varname => $value){eval("\$$varname = $value;");
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
		//echo "<br> document.getElementById('$varname').value='$value';</script>";
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
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!$_createby){$_createby=$null;}
?>
	<table width="100%">
		<tr style="text-align:left;">
			<td>Dibuat Oleh</td>
		</tr>
		<tr style="text-align:left;vertical-align:bottom;height:80px">
			<td align="left"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:left;">
			<td>(<?php echo $_createby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
				<input type="button" value="Daftar Penerimaan Quotation" id="btnrecvqrlist" onclick="window.open('logistik_workshop_qr_vendorlist.php?qrno='+qrno.innerHTML,'logistik_workshop_qr_vendorlist','width=1000,height=800,scrollbars=yes');">
				<input type="button" value="Terima Quotation" id="btnrecvqr" onclick="window.open('logistik_workshop_qr_vendoradd.php?qrno='+qrno.innerHTML,'logistik_workshop_qr_vendoradd','width=1000,height=800,scrollbars=yes');">
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
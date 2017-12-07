<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$_GET["editing"]=1;
	$sign=$_GET["sign"];
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($sign){
		$signdate=$sign."date";
		$sql="UPDATE $tablename SET $sign='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
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
					//idrap=textid.replace("kodebarang","rap");
					idtot_ming_lalu=textid.replace("kodebarang","tot_ming_lalu");
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idsatuan).value=arrreturnvalue[1];
					//document.getElementById(idrap).value=arrreturnvalue[2];
					document.getElementById(idtot_ming_lalu).value=arrreturnvalue[3];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue+"&kode_pekerjaan="+document.getElementById("kode_pekerjaan").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<!--table width="100%"><tr><td align="center"><h3><b>PERMINTAAN BARANG</b></h3></td></tr></table-->
		<?php $__captiontitle="PERMINTAAN BARANG";include_once "header_document.php"; ?>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>MR No</td>
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
						<tr>
							<td>Periode</td>
							<td>:</td>
							<td id="periode"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<!--tr>
							<td>Peruntukan</td>
							<td>:</td>
							<td id="peruntukan"></td>
						</tr-->
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
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1"><b>No</b></td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<!--td><b>Qty RAP</b></td>
				<td><b>Qty Terambil</b></td-->
				<td><b>Qty Permintaan</b></td>
				<td><b>Satuan</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="kodebarang[0]"></td>
				<td id="namabarang[0]"></td>
				<!--td id="rap[0]"></td>
				<td id="tot_ming_lalu[0]"></td-->
				<td id="jumlah[0]"></td>
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
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__kadivkonstruksi)){$__kadivkonstruksi=$imgnull;}
	if(!is_file("signature/".$__qqc)){$__qqc=$imgnull;}
	if(!is_file("signature/".$__kalogistik)){$__kalogistik=$imgnull;}
	if(!is_file("signature/".$__sitemgr)){$__sitemgr=$imgnull;}
	if(!is_file("signature/".$__sitelogistik)){$__sitelogistik=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_kadivkonstruksi){$_kadivkonstruksi=$null;}
	if(!$_qqc){$_qqc=$null;}
	if(!$_kalogistik){$_kalogistik=$null;}
	if(!$_sitemgr){$_sitemgr=$null;}
	if(!$_sitelogistik){$_sitelogistik=$null;}
	if($createby && !$kadivkonstruksi){$_kadivkonstruksi="<span id=\"approvebtn\"><input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=kadivkonstruksi&kode=$kode';}\"></span>";}
	if($kadivkonstruksi && !$qqc){$_qqc="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=qqc&kode=$kode';}\">";}
	if($qqc && !$kalogistik){$_kalogistik="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=kalogistik&kode=$kode';}\">";}
	if($kalogistik && !$sitemgr){$_sitemgr="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=sitemgr&kode=$kode';}\">";}
	if($sitemgr && !$sitelogistik){$_sitelogistik="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=sitelogistik&kode=$kode';}\">";}
?>
	<table width="100%">
		<tr style="text-align:center;">
			<td>Pemohon</td>
			<td>Diketahui/Disetujui,</td>
		</tr>
		<tr style="text-align:center;vertical-align:bottom;height:80px">
			<td align="center"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
			<td align="center"><img src="signature/<?php echo $__kadivkonstruksi; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:center;">
			<td>(<?php echo $_createby; ?>)<hr>Admin Hotel Damar</td>
			<td>(<?php echo $_kadivkonstruksi; ?>)<hr>Manager</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="buttonrowdiv">
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="try{buttonrowdiv.style.visibility='hidden';}catch(err){} try{approvebtn.style.visibility='hidden';}catch(err){} window.print(); try{buttonrowdiv.style.visibility='visible';}catch(err){} try{approvebtn.style.visibility='visible';}catch(err){}">
				</div>
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
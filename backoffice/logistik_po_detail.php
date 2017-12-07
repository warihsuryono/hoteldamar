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
		$sql="UPDATE $tablename SET $signby='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
	
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailpermdana(permno){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnval=xmlHttp.responseText;
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
							harga=arrcontent[4];
							jumlah=arrcontent[5];
							keterangan=arrcontent[6];
							//alert(kode+":"+nama+":"+qty+":"+satuan+":"+harga+":"+jumlah+":"+keterangan);
							if(kode!="undefined" && kode !=""){
								if(arrcontent_1[0]!="undefined" && arrcontent_1[0]!=""){addrow('0','tabledetail','rowdetail','+');}
								document.getElementById("kodebarang["+jj+"]").value=kode;
								document.getElementById("namabarang["+jj+"]").value=nama;
								document.getElementById("qty["+jj+"]").value=qty;
								document.getElementById("satuan["+jj+"]").value=satuan;
								document.getElementById("harsat["+jj+"]").value=harga;
								document.getElementById("harsat["+jj+"]").focus();
								document.getElementById("jumlah["+jj+"]").value=jumlah;
								document.getElementById("jumlah["+jj+"]").focus();
								document.getElementById("keterangan["+jj+"]").value=keterangan;
							}
						} catch (e) {
						}
					}
				}
			}
			xmlHttp.open("GET","ajax.loaddetailpermdana.php?permno="+permno,true);
			xmlHttp.send(null);	
		}
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
		<!--table width="100%"><tr><td align="center"><h3><b>PURCHASE ORDER</b></h3></td></tr></table-->
		<?php $__captiontitle="PURCHASE ORDER";include_once "header_document.php"; ?>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>PO No</td>
							<td>:</td>
							<td id="pono"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr-->
						<tr>
							<td>Kode Permohonan</td>
							<td>:</td>
							<td id="kodepermohonan"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Tanggal PO</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td>:</td>
							<td id="vendorid"></td>
						</tr>
						<tr>
							<td>Keterangan</td>
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
							<td align="right" id="subtotal">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" id="ppn">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" id="total">&nbsp;</td>
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
		if($varname=="vendorid"){
			$sql="SELECT nama FROM mst_vendor WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($value)=mysql_fetch_array($hsltemp);
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
			if($vardetailname=="withtax"){$withtax=$valuedetail;}
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
		}
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$namabarang=str_ireplace(chr(34),"''",$namabarang);
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").innerHTML="<?php echo $namabarang; ?>";</script><?php
	}
	?><script language="javascript">sumnumber_inner('jumlah','input','subtotal','<?php echo !$withtax; ?>');</script><?php
	
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__kalogistik)){$__kalogistik=$imgnull;}
	if(!is_file("signature/".$__tahuby)){$__tahuby=$imgnull;}
	if(!is_file("signature/".$__setujuby)){$__setujuby=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_kalogistik){$_kalogistik=$null;}
	if(!$_tahuby){$_tahuby=$null;}
	if(!$_setujuby){$_setujuby=$null;}
	//if($createby && !$tahuby){$_tahuby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=tahu&kode=$kode';}\">";}
	if($createby && !$setujuby){$_setujuby="<span id=\"approvebtn\"><input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=setuju&kode=$kode';}\"></span>";}
?>
	<table width="100%">
		<tr style="text-align:center;">
			<td>Dibuat,</td>
			<td>Disetujui,</td>
		</tr>
		<tr style="text-align:center;vertical-align:bottom;height:80px">
			<td align="center"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
			<td align="center"><img src="signature/<?php echo $__setujuby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:center;">
			<td>(<?php echo $_createby; ?>)</td>
			<td>(<?php echo $_setujuby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="buttonrowdiv">
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="printbutton" onclick="try{buttonrowdiv.style.visibility='hidden';}catch(err){} try{approvebtn.style.visibility='hidden';}catch(err){} window.print(); try{buttonrowdiv.style.visibility='visible';}catch(err){} try{approvebtn.style.visibility='visible';}catch(err){}">
				</div>
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
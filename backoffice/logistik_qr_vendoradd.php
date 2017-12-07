<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<4;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
	if($modebutton=="simpan"){
		if($_GET["editing"]){
			$kode=$_GET["kode"];
			$sql="DELETE FROM $tablename WHERE $kodename='$kode' AND vendorid='$vendorid'";
			mysql_query($sql,$db);
			$sql="DELETE FROM $tabledetailname WHERE $kodename='$kode' AND vendorid='$vendorid'";
			mysql_query($sql,$db);
		}
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$into="(";
		$values="(";
		$createby=$__username;
		$createdate=$__now;
		$receiveby=$__username;
		$receivedate=$__now;
		$detailfile=$tabledetailname.".php?kode=$qrno&vendorid=$vendorid";
		$actionlink="<a href=''$__phpself?editing=1&kode=$qrno&vendorid=$vendorid''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
		$actionlink.="&nbsp;&nbsp;<a href=''$detailfile''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
			$into.="`$fieldname`,";
			if($fieldtype=="double"){
				eval("\$values .= \"'\".unformated(\$$fieldname).\"',\";");
			}else{
				eval("\$values .= \"'\".\$$fieldname.\"',\";");
			}
		}
		$into=substr($into,0,strlen($into)-1).")";
		$values=substr($values,0,strlen($values)-1).")";
		$sql="INSERT INTO $tablename $into VALUES $values";
		mysql_query($sql,$db);
		//echo "<br>$sql => ".mysql_error();
		//INSERT DETAIL
		eval("\$countrow = count($$kodedetailname);");
		$seqno=-1;
		for($_seqno=0;$_seqno<$countrow;$_seqno++){
			eval("\$isvalue = $$kodedetailname"."[".$_seqno."]".";");
			if($isvalue){//ada isinya
				$seqno++;
				$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
				$hsltemp=mysql_query($sql,$db);
				$intodetail="(";
				$valuesdetail="(";
				while(list($fielddetailname,$fielddetailtype)=mysql_fetch_array($hsltemp)){
					$intodetail.="`$fielddetailname`,";
					if($fielddetailtype=="double"){
						eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".unformated(\$$fielddetailname"."[".$_seqno."]".").\"',\";}else{\$valuesdetail .= \"'\".unformated(\$$fielddetailname).\"',\";}");
					}else{
						eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".\$$fielddetailname"."[".$_seqno."]".".\"',\";}else{\$valuesdetail .= \"'\".\$$fielddetailname.\"',\";}");
					}
				}
				$intodetail=substr($intodetail,0,strlen($intodetail)-1).")";
				$valuesdetail=substr($valuesdetail,0,strlen($valuesdetail)-1).")";
				$sql="INSERT INTO $tabledetailname $intodetail VALUES $valuesdetail";
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
		}
		?>
			<script language="javascript">
				//window.location="<?php echo $tablename."list.php";?>";
				window.close();
			</script>
		<?php
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function checkqrvendor(qrno,vendorid){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					//alert(returnvalue);
					if(returnvalue==1){window.location='<?php echo $__phpself; ?>?editing=1&kode='+qrno+'&vendorid='+vendorid;}
				}
			}
			xmlHttp.open("GET","ajax.checkqrvendor.php?mode=logistik&qrno="+qrno+"&vendorid="+vendorid,true);
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
		<table width="100%"><tr><td align="center"><h3><b>PERMINTAAN QUOTATION</b></h3></td></tr></table>
		<table>
			<tr>
				<td>QR No</td>
				<td>:</td>
				<td><input type="text" id="qrno" name="qrno" readonly size="30"></td>
			</tr>
			<tr>
				<td>Tanggal QR</td>
				<td>:</td>
				<td>
					<input id="tanggalqr" type="text" name="tanggalqr" value="<?php echo $tanggalqr; ?>" size="12" readonly>
				</td>
			</tr>
			<!--tr>
				<td>Kode Pekerjaan</td>
				<td>:</td>
				<td>
					<input type="text" id="kode_pekerjaan" name="kode_pekerjaan" readonly>
				</td>
			</tr-->
			<tr>
				<td>Periode</td>
				<td>:</td>
				<td><input id="periode" type="text" name="periode" value="<?php echo $periode; ?>" size="15" readonly></td>
			</tr>
			<tr>
				<td>Tanggal Terima</td>
				<td>:</td>
				<td>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
			</tr>
			<tr>
				<td>Supplier</td>
				<td>:</td>
				<td>
					<select name="vendorid" id="vendorid" onchange="checkqrvendor(qrno.value,this.value);">
						<option value="">-Pilih Supplier-</option>
						<?php 
							$sql="SELECT kode,nama,alamat FROM mst_vendor ORDER BY nama";
							$hsltemp=mysql_query($sql,$db);
							while(list($_kodevendor,$_nama)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $_kodevendor; ?>"><?php echo $_nama; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1">
					<b>No</b>
					<a onclick="addrow('0','tabledetail','rowdetail','+');"><img src="images/expand.gif" title="Tambah Baris" border="0"></a>
					<a onclick="addrow('0','tabledetail','rowdetail','-');"><img src="images/collapse.gif" title="Kurangi Baris" border="0"></a>
				</td>
				<td><b>Kode Part/Unit</b></td>
				<td><b>Nama Part/Unit</b></td>
				<td><b>Qty</b></td>
				<td><b>Satuan</b></td>
				<td><b>Harga</b></td>
				<td><b>Jumlah</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="kodebarang[0]" type="text" name="kodebarang[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Part/Unit" border="0" width="13" height="13"  onclick="showPartUnit('kodebarang[0]')">
				</td>
				<td><input id="namabarang[0]" type="text" name="namabarang[0]" size="30" readonly></td>
				<td><input id="qty[0]" type="text" name="qty[0]" size="5" style="text-align:right;"></td>
				<td>
					<select name="satuan[0]" id="satuan[0]">
						<?php 
							$sql="SELECT kode,singkatan FROM mst_satuan ORDER BY kode='pcs' DESC";
							$hsltemp=mysql_query($sql,$db);
							while(list($kode,$singkatan)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $kode; ?>"><?php echo $singkatan; ?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td><input id="harsat[0]" type="text" name="harsat[0]" size="8" style="text-align:right;" onblur="hitungjumlah('qty[0]','harsat[0]','jumlah[0]');sumnumber('jumlah','input','subtotal');"></td>
				<td align="right"><input id="jumlah[0]" type="text" name="jumlah[0]" size="10" style="text-align:right;"></td>
				<td><input id="keterangan[0]" type="text" name="keterangan[0]" size="40"></td>
			</tr>
			<tr id="rowdetail_footer">
				<td valign="top" colspan="6" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>SUB TOTAL</b></td>
						</tr>
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>PPN</b></td>
						</tr>
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>TOTAL</b></td>
						</tr>
					</table>
				</td>
				<td valign="top" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><input id="subtotal" type="text" name="subtotal" size="12" readonly style="text-align:right;"></td>
						</tr>
						<tr>
							<td align="right"><input id="ppn" type="text" name="ppn" size="12" readonly style="text-align:right;"></td>
						</tr>
						<tr>
							<td align="right"><input id="total" type="text" name="total" size="12" readonly style="text-align:right;"></td>
						</tr>
					</table>
				</td>
				<td></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Tutup" onclick="window.close();">
				<input type="button" value="Simpan" onclick="modebutton.value='simpan';formsubmit.click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari qrno [QR/M/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode=$_GET["qrno"];
		$sql="SELECT kode_pekerjaan,tanggal,periode FROM logistik_qr WHERE qrno='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($kode_pekerjaan,$tanggalqr,$periode)=mysql_fetch_array($hsltemp);
		$tanggalqr=substr($tanggalqr,8,2)."/".substr($tanggalqr,5,2)."/".substr($tanggalqr,0,4);
		$periode=date("F Y",mktime(0,0,0,substr($periode,5,2),1,substr($periode,0,4)));
		
		// $kode="QR/M/".date("Ymd")."/";
		// $sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		// $hsltemp=mysql_query($sql,$db);
		// list($idseqno)=mysql_fetch_array($hsltemp);
		// $idseqno++;
		// $kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		// $periode=date("Y-m-01");
		
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">
			//document.getElementById("kode_pekerjaan").value="<?php echo $kode_pekerjaan; ?>";
		</script><?php
		?><script language="javascript">document.getElementById("tanggalqr").value="<?php echo $tanggalqr; ?>";</script><?php
		?><script language="javascript">document.getElementById("tanggal").value="<?php echo $tanggal; ?>";</script><?php
		?><script language="javascript">document.getElementById("periode").value="<?php echo $periode; ?>";</script><?php
		//load detail qr
		$sql="SELECT count(kodebarang) FROM logistik_qr_detail WHERE qrno='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($jumlahdetail)=mysql_fetch_array($hsltemp);
		for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
		
		$sql="SELECT kodebarang,seqno,qty,satuan,keterangan FROM logistik_qr_detail WHERE qrno='$kode'";
		$hsldetqr=mysql_query($sql,$db);
		while(list($kodebarang,$seqno,$qty,$satuan,$keterangan)=mysql_fetch_array($hsldetqr)){
			?><script language="javascript">document.getElementById("kodebarang[<?php echo $seqno; ?>]").value="<?php echo $kodebarang; ?>";</script><?php
			?><script language="javascript">document.getElementById("qty[<?php echo $seqno; ?>]").value="<?php echo $qty; ?>";</script><?php
			?><script language="javascript">document.getElementById("satuan[<?php echo $seqno; ?>]").value="<?php echo $satuan; ?>";</script><?php
			?><script language="javascript">document.getElementById("keterangan[<?php echo $seqno; ?>]").value="<?php echo $keterangan; ?>";</script><?php
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$namabarang=str_ireplace(chr(34),"''",$namabarang);
			?><script language="javascript">document.getElementById("namabarang[<?php echo $seqno; ?>]").value="<?php echo $namabarang; ?>";</script><?php
		}
		
	}else{//load editing
		$kode=$_GET["kode"];
		$vendorid=$_GET["vendorid"];
		//load dari qr
		$sql="SELECT kode_pekerjaan,tanggal,periode FROM logistik_qr WHERE qrno='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($kode_pekerjaan,$tanggalqr,$periode)=mysql_fetch_array($hsltemp);
		$tanggalqr=substr($tanggalqr,8,2)."/".substr($tanggalqr,5,2)."/".substr($tanggalqr,0,4);
		$periode=date("F Y",mktime(0,0,0,substr($periode,5,2),1,substr($periode,0,4)));
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">
			//document.getElementById("kode_pekerjaan").value="<?php echo $kode_pekerjaan; ?>";
		</script><?php
		?><script language="javascript">document.getElementById("tanggalqr").value="<?php echo $tanggalqr; ?>";</script><?php
		?><script language="javascript">document.getElementById("periode").value="<?php echo $periode; ?>";</script><?php
		
		//load dari qr vendor
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
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
			$value=str_ireplace(chr(13).chr(10)," ",$value);
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").value="<?php echo $value; ?>";</script><?php
			//echo "<br> document.getElementById('$varname').value='$value';</script>";
		}
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		//LOAD DETAIL
		$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode' and vendorid='$vendorid'";
		$hsltemp=mysql_query($sql,$db);
		list($jumlahdetail)=mysql_fetch_array($hsltemp);
		for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
		
		$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$selectdetail="";
		while(list($fieldname)=mysql_fetch_array($hsltemp)){
			if($fieldname!=$kodename){
				$selectdetail.="`$fieldname`,";
			}
		}
		$selectdetail=substr($selectdetail,0,strlen($selectdetail)-1);
		$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode' and vendorid='$vendorid'";
		$hsldet=mysql_query($sql,$db);
		$no=-1;
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$kodebarang="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="kodebarang"){$kodebarang=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
				?><script language="javascript">hitungjumlah('qty[<?php echo $no; ?>]','harsat[<?php echo $no; ?>]','jumlah[<?php echo $no; ?>]');sumnumber('jumlah','input','subtotal');</script><?php
			}
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$namabarang=str_ireplace("\"","''",$namabarang);
			?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").value="<?php echo $namabarang; ?>";</script><?php
		}
	}
	if($modebutton=="reload" || $modebutton=="simpan"){
		foreach($_POST as $var_id => $postvalue){
			if(is_array($postvalue)){
				if(!$tambahrow){
					for($zz=1;$zz<count($postvalue);$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
					$tambahrow=true;
				}
				foreach($postvalue as $seqno => $postvalue1){
					?><script language="javascript">document.getElementById("<?php echo $var_id; ?>[<?php echo $seqno; ?>]").value="<?php echo $postvalue1; ?>";</script><?php
				}
			}else{
				?><script language="javascript">document.getElementById("<?php echo $var_id; ?>").value="<?php echo $postvalue; ?>";</script><?php
			}
		}
	}
	include_once "footer.php";
?>
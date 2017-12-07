<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($_GET["editing"]){
		$sql="SELECT invoicestat,periksaby FROM $tablename WHERE $kodename='".$_GET["kode"]."'";
		$hsltemp=mysql_query($sql,$db);
		list($__invoicestat,$__approved)=mysql_fetch_array($hsltemp);
		if($__invoicestat || $__approved){ ?> <script language="javascript">alert("Dokumen ini sudah Settled, Sehingga tidak boleh diubah!");window.location="<?php echo $tablename."list.php";?>";</script> <?php }
	}
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
	if($modebutton=="simpan"){
		if($_GET["editing"]){
			$kode=$_GET["kode"];
			$sql="DELETE FROM $tablename WHERE $kodename='$kode'";
			mysql_query($sql,$db);
			$sql="DELETE FROM $tabledetailname WHERE $kodename='$kode'";
			mysql_query($sql,$db);
		}
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$into="(";
		$values="(";
		$createby=$__username;
		$createdate=$__now;
		$recvby=$__username;
		$recvdate=$__now;
		$detailfile=$tabledetailname.".php?kode=$recvkode";
		$actionlink="<a href=''$__phpself?editing=1&kode=$recvkode''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
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
				window.location="<?php echo $tablename."list.php";?>";
				window.close();
			</script>
		<?php
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailpo(pono){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnval=xmlHttp.responseText;
					//testing.innerHTML=returnval;
					arrreturnvaltemp=returnval.split("<field1>");
					//kode_pekerjaan=arrreturnvaltemp[0];
					//document.getElementById("kode_pekerjaan").value=kode_pekerjaan;
					returnval=arrreturnvaltemp[1];
					arrreturnvaltemp=returnval.split("<field2>");
					vendorid=arrreturnvaltemp[0];
					document.getElementById("vendorid").value=vendorid;
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
							poqty=arrcontent[2];
							outstandingqty=arrcontent[3];
							recvqty=arrcontent[4];
							satuan=arrcontent[5];
							harga=arrcontent[6];
							jumlah=arrcontent[7];
							keterangan=arrcontent[8];
							//alert(kode+":"+nama+":"+qty+":"+satuan+":"+harga+":"+jumlah+":"+keterangan);
							if(kode!="undefined" && kode !=""){
								if(arrcontent_1[0]!="undefined" && arrcontent_1[0]!=""){addrow('0','tabledetail','rowdetail','+');}
								document.getElementById("kodebarang["+jj+"]").value=kode;
								document.getElementById("namabarang["+jj+"]").value=nama;
								document.getElementById("poqty["+jj+"]").value=poqty;
								document.getElementById("outstandingqty["+jj+"]").value=outstandingqty;
								document.getElementById("recvqty["+jj+"]").value=recvqty;
								document.getElementById("satuan["+jj+"]").value=satuan;
								document.getElementById("keterangan["+jj+"]").value=keterangan;
							}
						} catch (e) {
						}
					}
				}
			}
			xmlHttp.open("GET","ajax.loaddetailpo.php?pono="+pono,true);
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
	<span id="testing"></span>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>PENERIMAAN BARANG</b></h3></td></tr></table>
		<table>
			<tr>
				<td>Kode Penerimaan</td>
				<td>:</td>
				<td><input type="text" id="recvkode" name="recvkode" readonly size="30"></td>
			</tr>
			<tr>
				<td>PO NO</td>
				<td>:</td>
				<td>
					<input type="text" id="pono" name="pono">
					<!--img src="images/b_search.png" title="Daftar Purchase Order" border="0" width="13" height="13" onclick="showPO('pono',kode_pekerjaan.value,vendorid.value)"-->
					<img src="images/b_search.png" title="Daftar Purchase Order" border="0" width="13" height="13" onclick="showPO('pono','',vendorid.value)">
				</td>
			</tr>
			<!--tr>
				<td>Kode Pekerjaan</td>
				<td>:</td>
				<td>					
					<input type="text" id="kode_pekerjaan" name="kode_pekerjaan">
					<img src="images/b_search.png" title="Daftar Kode Pekerjaan" border="0" width="13" height="13" onclick="showKodePekerjaan('kode_pekerjaan')">
				</td>
			</tr-->
			<tr>
				<td>Supplier</td>
				<td>:</td>
				<td>
					<select name="vendorid" id="vendorid">
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
			<!--tr>
				<td>Gudang</td>
				<td>:</td>
				<td>
					<select name="gudang" id="gudang">
						<option value="">-Pilih Gudang-</option>
						<?php 
							$sql="SELECT kode,nama,alamat FROM mst_gudang ORDER BY nama";
							$hsltemp=mysql_query($sql,$db);
							while(list($_kodegudang,$_nama,$_alamat)=mysql_fetch_array($hsltemp)){
								$gudang=$_nama." ".$_alamat;
						?>
							<option value="<?php echo $_kodegudang; ?>"><?php echo $gudang; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr-->
			<tr>
				<td>Tanggal Penerimaan</td>
				<td>:</td>
				<td>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td><textarea name="notes" id="notes" cols="50" rows="2"></textarea></td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1">
					<b>No</b>
					<a onclick="addrow('0','tabledetail','rowdetail','+');"><img src="images/expand.gif" title="Tambah Baris" border="0"></a>
					<a onclick="addrow('0','tabledetail','rowdetail','-');"><img src="images/collapse.gif" title="Kurangi Baris" border="0"></a>
				</td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<td><b>Qty PO</b></td>
				<td><b>Qty Yg Belum</b></td>
				<td><b>Qty Terima</b></td>
				<td><b>Satuan</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="kodebarang[0]" type="text" name="kodebarang[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showMaterial('kodebarang[0]')">
				</td>
				<td><input id="namabarang[0]" type="text" name="namabarang[0]" size="30" readonly></td>
				<td><input id="poqty[0]" type="text" name="poqty[0]" size="5" style="text-align:right;" readonly></td>
				<td><input id="outstandingqty[0]" type="text" name="outstandingqty[0]" size="5" style="text-align:right;" readonly></td>
				<td><input id="recvqty[0]" type="text" name="recvqty[0]" size="5" style="text-align:right;"></td>
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
				<td><input id="keterangan[0]" type="text" name="keterangan[0]" size="40"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Simpan" onclick="modebutton.value='simpan';formsubmit.click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari kodepermohonan [RECV/M/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode="RECV/M/".date("Ymd")."/";
		$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$periode=date("Y-m-01");
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
		?><script language="javascript">document.getElementById("tanggal").value="<?php echo $tanggal; ?>";</script><?php	
	}else{//load editing
		$kode=$_GET["kode"];
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
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
			$value=str_ireplace(chr(13).chr(10)," ",$value);
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").value="<?php echo $value; ?>";</script><?php
		}
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		//LOAD DETAIL
		$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
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
		$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
		$hsldet=mysql_query($sql,$db);
		$no=-1;
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$kodebarang="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="kodebarang"){$kodebarang=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$namabarang=str_ireplace(chr(34),"''",$namabarang);
			?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").value="<?php echo $namabarang; ?>";</script><?php
		}
		?><script language="javascript">sumnumber('jumlah','input','subtotal');</script><?php
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
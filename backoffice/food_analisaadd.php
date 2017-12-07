<?php
	include_once "header.php";
	include_once "func_number_format.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func.material.php";
	$_GET["editing"]=1;
	$editing=1;
	$kodefood=$_GET["kodefood"];
	
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
	
	$tanggal=date("Y-m-d");
	$kode=$_GET["kodefood"];
	$_GET["kode"]=$kode;
	$periode=date("Y-m-01");
	
	if($modebutton=="simpan" || $modebutton=="simpanupdate"){
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
		$detailfile=$tabledetailname.".php?kode=$kode";
		$actionlink="<a href=''$__phpself?editing=1&kode=$kode''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
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
			//if($isvalue){//ada isinya
			if($isvalue || $_POST["namabarang"][$_seqno]){//ada isinya
				$seqno++;
				if($_POST["kodebarang"][$_seqno]==""){$kodebarang=material_kodebynama($_POST["namabarang"][$_seqno],$_POST["satuan"][$_seqno],0,1);$_POST["kodebarang"][$_seqno]=$kodebarang;}
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
				alert("Analisa Harga Telah Disimpan");
			</script>
		<?php
		if($modebutton=="simpanupdate"){
			$sql="UPDATE mst_food SET price='".un_formated($_POST["hargajual"])."' WHERE kode='".$_POST["kode"]."'";
			mysql_query($sql,$db);			
			?>
				<script language="javascript">
					alert("Harga Jual telah di update!");
				</script>
			<?php
		}
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function hitungharga(){
			sumnumber('jumlah','input','hpp_porsi');
			hpp_porsi=document.getElementById("hpp_porsi").value;
			porsi=document.getElementById("porsi").value;
			margin=document.getElementById("margin").value;
			hpp_porsi=unformat_number(hpp_porsi);
			hpp_porsi=hpp_porsi*1;
			margin=unformat_number(margin);
			margin=margin*1;
			porsi=unformat_number(porsi);
			porsi=porsi*1;
			hpp=hpp_porsi/porsi;
			hargajual=hpp+(hpp*margin/100);
			document.getElementById("hpp").value=format_number(hpp,"");
			document.getElementById("hargajual").value=format_number(hargajual,"");
		}
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					idnamabarang=textid.replace("kodebarang","namabarang");
					//idrap=textid.replace("kodebarang","rap");
					idtot_ming_lalu=textid.replace("kodebarang","tot_ming_lalu");
					idjumlah=textid.replace("kodebarang","jumlah");
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idsatuan).value=arrreturnvalue[3];
					//document.getElementById(idrap).value=arrreturnvalue[1];
					document.getElementById(idtot_ming_lalu).value=arrreturnvalue[2];
					document.getElementById(idjumlah).value=arrreturnvalue[1]-arrreturnvalue[2];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue+"&kode_pekerjaan="+document.getElementById("kode_pekerjaan").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kodefood=<?php echo $_GET["kodefood"]; ?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>ANALISA HARGA</b></h3></td></tr></table>
		<table>
			<tr>
				<td valign="top">
					<table>
						<tr>
							<td>Kode</td>
							<td>:</td>
							<td><input type="text" id="kode" name="kode" readonly size="8"></td>
						</tr>
						<tr>
							<td>Nama Masakan</td>
							<td>:</td>
							<td><input type="text" id="deskripsi" name="deskripsi"readonly size="70"></td>
						</tr>
						<tr>
							<td>Porsi Analisa</td>
							<td>:</td>
							<td><input type="text" id="porsi" name="porsi" size="3" style="text-align:right;" onblur="txtporsi.innerHTML=this.value;txtporsi2.innerHTML=this.value;hitungharga();" value="100"> Porsi</td>
						</tr>
						<tr>
							<td>Margin</td>
							<td>:</td>
							<td><input type="text" id="margin" name="margin" size="3" style="text-align:right;" value="30" onblur="hitungharga();"> %</td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table>
						<tr>
							<td nowrap>HPP (<span id="txtporsi">100</span> Porsi)</td>
							<td>:</td>
							<td><input type="text" id="hpp_porsi" name="hpp_porsi" size="12" style="text-align:right;"></td>
						</tr>
						<tr>
							<td nowrap>HPP / Porsi</td>
							<td>:</td>
							<td><input type="text" id="hpp" name="hpp" size="12" style="text-align:right;"></td>
						</tr>
						<tr>
							<td nowrap>Harga Jual</td>
							<td>:</td>
							<td><input type="text" id="hargajual" name="hargajual" size="12" style="text-align:right;"></td>
						</tr>
					</table>
				</tr>
			</td>
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
				<td><b>Satuan</b></td>
				<td><b>Qty / <span id="txtporsi2">100</span> Porsi</b></td>
				<td><b>Harga Satuan</b></td>
				<td><b>Jumlah</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="kodebarang[0]" type="text" name="kodebarang[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showMaterial('kodebarang[0]')">
				</td>
				<td><input id="namabarang[0]" type="text" name="namabarang[0]" size="30"></td>
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
				<td><input id="qty[0]" type="text" name="qty[0]" size="5" style="text-align:right;"></td>
				<td><input id="harsat[0]" type="text" name="harsat[0]" size="12" style="text-align:right;" onblur="hitungjumlah('qty[0]','harsat[0]','jumlah[0]');hitungharga();"></td>
				<td><input id="jumlah[0]" type="text" name="jumlah[0]" size="12" style="text-align:right;"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" onclick="window.location='mst_foodlist.php';">
				<input type="button" value="Hitung!" onclick="hitungharga();">
				<input type="button" value="Simpan" onclick="modebutton.value='simpan';formsubmit.click();">
				<input type="button" value="Simpan & Update Harga" onclick="modebutton.value='simpanupdate';formsubmit.click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
	?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
	
	$sql="SELECT description FROM mst_food WHERE kode='$kodefood'";
	$hsltemp=mysql_query($sql,$db);
	list($deskripsi)=mysql_fetch_array($hsltemp);
	?><script language="javascript">document.getElementById("deskripsi").value="<?php echo $deskripsi; ?>";</script><?php
	
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
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").value="<?php echo $namabarang; ?>";</script><?php
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
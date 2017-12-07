<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	$tablename="acc_jurnal";
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
	if($modebutton=="simpan"){
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$into="(";
		$values="(";
		$createby=$__username;
		$createdate=$__now;
		$detailfile=$tabledetailname.".php?kode=$kodejurnal";
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
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
		//KAS (kredit)
		$sql="SELECT count(debit),sum(debit) FROM acc_jurnal_detail WHERE kodejurnal='$kodejurnal'";
		$hsltemp=mysql_query($sql,$db);
		list($seqno,$kredit)=mysql_fetch_array($hsltemp);
		$debit=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
		$hsltemp=mysql_query($sql,$db);
		list($coa1)=mysql_fetch_array($hsltemp);
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa1'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Pembiayaan dengan Kas";
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa1','$koder','$keterangan','$debit','$kredit')";
		mysql_query($sql,$db);
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."list.php";?>";
			</script>
		<?php
	}
?>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<input type="hidden" id="posting" name="posting">
		<table width="100%"><tr><td align="center"><h3><b>PEMBIAYAAN DENGAN KAS</b></h3></td></tr></table>
		<table>
			<tr>
				<td>Kode Jurnal</td>
				<td>:</td>
				<td><input type="text" id="kodejurnal" name="kodejurnal" readonly size="30"></td>
			</tr>
			<!--tr>
				<td>Kode Pekerjaan</td>
				<td>:</td>
				<td>
					<input type="text" id="kode_pekerjaan" name="kode_pekerjaan">
					<img src="images/b_search.png" title="Daftar Kode Pekerjaan" border="0" width="13" height="13" onclick="showKodePekerjaan('kode_pekerjaan')">
				</td>
			</tr-->
			<!--tr>
				<td>Posting</td>
				<td>:</td>
				<td><input type="text" id="posting" name="posting" size="30"></td>
			</tr-->
			<?php
				$visibilitivendor1="visible";
				$visibilitivendor2="hidden";
				// if($_GET["kode"]){
					// $sql="SELECT vendor FROM $tablename WHERE $kodename='".$_GET["kode"]."'";
					// $hsltemp=mysql_query($sql,$db);
					// list($_vendorid)=mysql_fetch_array($hsltemp);
					// $sql="SELECT kode FROM mst_vendor WHERE kode='$_vendorid'";
					// mysql_query($sql,$db);
					// if(mysql_affected_rows($db)<=0){$visibilitivendor1="hidden";$visibilitivendor2="visible";$vandorname=$_vendorid;}
				// }
			?>
			<tr>
				<td>Rekanan</td>
				<td>:</td>
				<td>
					<span id="vendor1" style="visibility:<?php echo $visibilitivendor1;?>">
						<select name="vendor" id="vendor">
							<option value="">-Pilih Rekanan-</option>
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
					</span>
					<!--span id="vendor2" style="visibility:<?php echo $visibilitivendor2;?>">
						<input type="text" name="vendor" id="vendor" value="<?php echo $vandorname; ?>">
					</span>
					<input type="checkbox" name="vendorlain" onclick="if(this.checked){vendor.value='';vendor1.style.visibility='hidden';vendor2.style.visibility='visible';}else{vendor.value='';vendor1.style.visibility='visible';vendor2.style.visibility='hidden';}">Lain-lain-->
				</td>
			</tr>
			<tr>
				<td>Tanggal Transaksi</td>
				<td>:</td>
				<td>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
			</tr>
			<tr>
				<td>No Check/BG</td>
				<td>:</td>
				<td><input type="text" id="nocek" name="nocek" size="30"></td>
			</tr>
			<tr>
				<td>Catatan</td>
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
				<td><b>COA</b></td>
				<td><b>Group</b></td>
				<td><b>Rekening</b></td>
				<td><b>Jumlah</b></td>
				<!--td><b>Kredit</b></td-->
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="coa[0]" type="text" name="coa[0]" size="20">
					<img src="images/b_search.png" title="Daftar COA" border="0" width="13" height="13"  onclick="showCOA('coa[0]','koder[0]','rekening[0]')">
				</td>
				<td><input id="koder[0]" type="text" name="koder[0]" size="30" readonly></td>
				<td><input id="rekening[0]" type="text" name="rekening[0]" size="30" readonly></td>
				<td><input id="debit[0]" type="text" name="debit[0]" size="15" style="text-align:right;" onkeyup="this.value=format_number(this.value,'');"></td>
				<!--td><input id="kredit[0]" type="text" name="kredit[0]" size="15" style="text-align:right;" onkeyup="this.value=format_number(this.value,'');"></td-->
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
	if(!$_GET["editing"]){//cari kodejurnal [MR/M/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode="JURNAL/".date("Ymd")."/";
		$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$periode=date("Y-m-01");
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
		?><script language="javascript">document.getElementById("posting").value="kas";</script><?php
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
		
		$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
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
			$coa="";
			$koder="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="coa"){$coa=$valuedetail;}
				if($vardetailname=="koder"){$koder=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}
			if($coa){
				$sql="SELECT description FROM acc_mst_coa WHERE coa='$coa'";
				$hsltemp=mysql_query($sql,$db);
				list($rekening)=mysql_fetch_array($hsltemp);
			}
			?><script language="javascript">document.getElementById("rekening[<?php echo $no; ?>]").value="<?php echo $rekening; ?>";</script><?php
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
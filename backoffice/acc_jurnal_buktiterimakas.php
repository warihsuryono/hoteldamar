<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	$tablename=str_ireplace("_buktiterimakas.php","",basename($__phpself));
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
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
?>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<!--table width="100%"><tr><td align="center"><h3><b>JOURNAL ACCOUNTING</b></h3></td></tr></table-->
		<?php $__captiontitle="BUKTI PENERIMAAN KAS/BANK";include_once "header_document.php"; ?>
		<table width="100%">
			<tr>
				<td valign="top">
					<table>
						<tr>
							<td>Kode Jurnal</td>
							<td>:</td>
							<td id="kodejurnal"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr-->
						<!--tr>
							<td>Posting</td>
							<td>:</td>
							<td id="posting"></td>
						</tr-->
						<tr>
							<td>Rekanan</td>
							<td>:</td>
							<td id="vendor"></td>
						</tr>
						<tr>
							<td>Bank</td>
							<td>:</td>
							<td id="bank"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Tanggal Transaksi</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<tr>
							<td>No Check/BG</td>
							<td>:</td>
							<td id="nocek"></td>
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
				<!--td><b>COA</b></td>
				<td><b>Group</b></td>
				<td><b>Rekening</b></td-->
				<td><b>Keterangan</b></td>
				<td width="1"><b>Jumlah</b></td>
				<!--td><b>Kredit</b></td-->
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right" id="no[0]">  1 </td>
				<!--td id="coa[0]"></td>
				<td id="koder[0]"></td>
				<td id="rekening[0]"></td-->
				<td id="keterangan[0]"></td>
				<!--td align="right" id="debit[0]"></td-->
				<td align="right" id="kredit[0]"></td>
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
		if($varname=="posting"){$posting=$value;}
		if($varname=="vendor"){
			$sql="SELECT nama FROM mst_vendor WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($value)=mysql_fetch_array($hsltemp);
		}
		?><script language="javascript">document.getElementById("<?php echo $varname; ?>").innerHTML="<?php echo $value; ?>";</script><?php
	}
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
	$sql="SELECT coa FROM $tabledetailname WHERE $kodename='$kode' AND kredit=0 LIMIT 1";
	$hsltemp=mysql_query($sql,$db);
	list($coabank)=mysql_fetch_array($hsltemp);
	$sql="SELECT description FROM acc_mst_coa WHERE coa='$coabank'";
	$hsltemp=mysql_query($sql,$db);
	list($bank)=mysql_fetch_array($hsltemp);
	if(stripos(" ".$bank,"bank")){
		?><script language="javascript">document.getElementById("bank").innerHTML="<?php echo $bank; ?>";</script><?php
	}
	//LOAD DETAIL
	// $sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
	// $hsltemp=mysql_query($sql,$db);
	// list($jumlahdetail)=mysql_fetch_array($hsltemp);
	$jumlahdetail=10;
	for($zz=1;$zz<=$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
	
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
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode' AND debit=0";
	$hsldet=mysql_query($sql,$db);
	$no=-1;
	$jumdebit=0;
	$jumkredit=0;
	while($detailvalues=mysql_fetch_assoc($hsldet)){
		$no++;
		$coa="";
		$koder="";
		foreach ($detailvalues as $vardetailname => $valuedetail){
			//if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
			if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
				$valuedetail=str_ireplace("\"","''",$valuedetail);
			if($vardetailname=="coa"){$coa=$valuedetail;}
			if($vardetailname=="keterangan"){$keterangan=$valuedetail;}
			if($vardetailname=="koder"){$koder=$valuedetail;}
			if($vardetailname=="debit"){$jumdebit+=un_formated($valuedetail);}
			if($vardetailname=="kredit"){$jumkredit+=un_formated($valuedetail);}
			
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
		}
		if($coa){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coa'";
			$hsltemp=mysql_query($sql,$db);
			list($rekening)=mysql_fetch_array($hsltemp);
			?><script language="javascript">document.getElementById("rekening[<?php echo $no; ?>]").innerHTML="<?php echo $rekening; ?>";</script><?php
			if(!$keterangan){
			?><script language="javascript">document.getElementById("keterangan[<?php echo $no; ?>]").innerHTML="<?php echo $rekening; ?>";</script><?php
			}
		}
	}
	//$no++;
	$no=10;
	?><script language="javascript">document.getElementById("keterangan[<?php echo $no; ?>]").innerHTML="<b>JUMLAH</b>";</script><?php
	?><script language="javascript">document.getElementById("debit[<?php echo $no; ?>]").innerHTML="<b><?php echo number_format($jumdebit); ?></b>";</script><?php
	?><script language="javascript">document.getElementById("kredit[<?php echo $no; ?>]").innerHTML="<b><?php echo number_format($jumkredit); ?></b>";</script><?php
	?><script language="javascript">document.getElementById("no[<?php echo $no; ?>]").innerHTML="";</script><?php
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$null.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__dirutby)){$__dirutby=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_dirutby){$_dirutby=$null;}
	//if($createby && !$dirutby){$_dirutby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=dirut&kode=$kode';}\">";}
?>
	<table width="100%">
		<tr style="text-align:left;">
			<td>Dibuat Oleh,</td>
			<td>Bag.Keuangan,</td>
		</tr>
		<tr style="text-align:left;vertical-align:bottom;height:80px">
			<td align="left"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
			<td align="left"><img src="signature/<?php echo $__dirutby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:left;">
			<td>(<?php echo $_createby; ?>)</td>
			<td>(<?php echo $_dirutby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	include_once "func_jurnal.php";
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
		if($sign=="dirut"){
			//cari apakah ada kas atau bank
			$arrcoa=array();
			$sql="SELECT tanggal,notes FROM acc_jurnal WHERE kodejurnal='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($tanggal,$notes)=mysql_fetch_array($hsltemp);
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
			$hsltemp=mysql_query($sql,$db);
			list($coa)=mysql_fetch_array($hsltemp);
			$arrcoa[$coa]="Kas";
			$sql="SELECT coa FROM acc_mst_coa WHERE description LIKE '%bank%'";
			$hsltemp=mysql_query($sql,$db);
			while(list($coa)=mysql_fetch_array($hsltemp)){
				$arrcoa[$coa]="Bank";
			}
			
			$sql="SELECT coa,keterangan,debit,kredit FROM acc_jurnal_detail WHERE kodejurnal='$kode'";
			$hsljurnal=mysql_query($sql,$db);
			while(list($coa,$keterangan,$debit,$kredit)=mysql_fetch_array($hsljurnal)){
				if($arrcoa[$coa]){
					if($notes){$keterangan=$notes;}
					add_mutasi_uang($tanggal,$arrcoa[$coa],$coa,"",basename($__phpself),$kode,"","",$keterangan,$debit,$kredit);
				}
			}
		}
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
?>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>JOURNAL ACCOUNTING</b></h3></td></tr></table>
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
				<td><b>COA</b></td>
				<td><b>Group</b></td>
				<td><b>Rekening</b></td>
				<td><b>Debit</b></td>
				<td><b>Kredit</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right" id="no[0]">  1 </td>
				<td id="coa[0]"></td>
				<td id="koder[0]"></td>
				<td id="rekening[0]"></td>
				<td align="right" id="debit[0]"></td>
				<td align="right" id="kredit[0]"></td>
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
		if($varname=="posting"){$posting=$value;}
		if($varname=="vendor"){
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
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
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
		}
	}
	$no++;
	?><script language="javascript">document.getElementById("rekening[<?php echo $no; ?>]").innerHTML="<b>JUMLAH</b>";</script><?php
	?><script language="javascript">document.getElementById("debit[<?php echo $no; ?>]").innerHTML="<b><?php echo number_format($jumdebit); ?></b>";</script><?php
	?><script language="javascript">document.getElementById("kredit[<?php echo $no; ?>]").innerHTML="<b><?php echo number_format($jumkredit); ?></b>";</script><?php
	?><script language="javascript">document.getElementById("no[<?php echo $no; ?>]").innerHTML="";</script><?php
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__dirutby)){$__dirutby=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_dirutby){$_dirutby=$null;}
	if($createby && !$dirutby){$_dirutby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=dirut&kode=$kode';}\">";}
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
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
				<?php if($posting=="bank") { ?>
				<input type="button" value="Bukti Bank Keluar" id="btn1" onclick="window.open('acc_jurnal_buktibankkeluar.php?kode=<?php echo $_GET["kode"]; ?>','acc_jurnal_buktibankkeluar','width=800,height=600,scrollbars=yes');">
				<?php } ?>
				<?php if($posting=="kas") { ?>
				<input type="button" value="Bukti Kas Keluar" id="btn2" onclick="window.open('acc_jurnal_buktikaskeluar.php?kode=<?php echo $_GET["kode"]; ?>','acc_jurnal_buktikaskeluar','width=800,height=600,scrollbars=yes');">
				<?php } ?>
				<?php if($posting=="invoice") { ?>
				<input type="button" value="Bukti Pembayaran Invoice" id="btn3" onclick="window.open('acc_jurnal_buktibayarinvoice.php?kode=<?php echo $_GET["kode"]; ?>','acc_jurnal_buktibayarinvoice','width=800,height=600,scrollbars=yes');">
				<?php } ?>
				<?php
					$coakasbank="";
					$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
					$hsltemp=mysql_query($sql,$db);
					list($coakas)=mysql_fetch_array($hsltemp);
					$coakasbank.="'$coakas',";
					$sql="SELECT coa FROM acc_mst_coa WHERE description LIKE '%bank%' ORDER BY description";
					$hsltemp=mysql_query($sql,$db);
					while(list($coabank)=mysql_fetch_array($hsltemp)){
						$coakasbank.="'$coabank',";
					}
					$coakasbank=substr($coakasbank,0,strlen($coakasbank)-1);
					$sql="SELECT seqno FROM acc_jurnal_detail WHERE kodejurnal='".$_GET["kode"]."' AND coa IN ($coakasbank) AND debit>0";
					$hsltemp=mysql_query($sql,$db);
					if(mysql_affected_rows($db)>0){$modekasmasuk="1";}
				?>
				<?php if($modekasmasuk=="1") { ?>
				<input type="button" value="Bukti Penerimaan Kas/Bank" id="btn3" onclick="window.open('acc_jurnal_buktiterimakas.php?kode=<?php echo $_GET["kode"]; ?>','acc_jurnal_buktiterimakas','width=800,height=600,scrollbars=yes');">
				<?php } ?>
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
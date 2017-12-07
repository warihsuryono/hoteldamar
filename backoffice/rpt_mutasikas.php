<?php
	if($_POST["export"]){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=report.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$_POST["load"]="LOAD";
	}
	include_once "header.php";
	include_once "func.openwin.php";
	$updateby=$_SESSION["username"];
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	if($reset){$_POST=array();}
	$periode1=sanitasi($_POST["periode1"]);
	if(!$periode1){$periode1=date("Y-m-d",mktime(0,0,0,date("m"),1));}
	// if(!$periode1){$periode1=date("Y-m-d");}
	$periode2=sanitasi($_POST["periode2"]);
	if(!$periode2){$periode2=date("Y-m-d",mktime(0,0,0,date("m")+1,0));}
	// if(!$periode2){$periode2=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1));}
	
	$load=sanitasi($_POST["load"]);
	$arrpost=base64_encode(serialize($_POST));
?>
	<?php if(!$_POST["export"]) {?>
	<script language="JavaScript">
		var detailsWindow;		
		function showCalendar(textid) {
		   detailsWindow = window.open("calendar.php?textid="+textid+"","calendar","width=260,height=250,top=300,scrollbars=yes");
		   detailsWindow.focus();   
		}
		function printthisform_local() {
			btnprint.style.visibility="hidden";
			try{filterdiv.style.visibility="hidden";}catch(e){}
			window.print();
			btnprint.style.visibility="visible";
			try{filterdiv.style.visibility="visible";}catch(e){}
		}
	</script>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<fieldset id="filterdiv">
			<legend><b>Filter</b></legend>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<table>
							<tr>
								<td nowrap><b>Periode</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<input id="periode1" type="text" name="periode1" value="<?php echo $periode1; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode1')">
									-
									<input id="periode2" type="text" name="periode2" value="<?php echo $periode2; ?>" size="12"><img src="images/calendar.png" border="0" width="13" height="13"  onclick="return showCalendar('periode2')">
								</td>
							</tr>
						</table>
					</td>		
			</table>
			<table width="100%">
				<tr>
					<td align="center">
						<input type="submit" name="load" value="Load">
						<input type="submit" name="reset" value="Reset">
						<input type="submit" name="export" value="Export">
						<input type="button" value="Print" id="btnprint" onclick="printthisform_local();">
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php } ?>
	<?php
		if($load){
			$sql="SELECT DATEDIFF('$periode2','$periode1')";
			$hsltemp=mysql_query($sql,$db);
			list($numdate)=mysql_fetch_array($hsltemp);
			$numdate++;
			$errmessage="";
			//if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
		}
	?>
	<?php
		echo $errmessage;
		if($errmessage=="" && $load){
			$totalcolom=8;
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>MUTASI KAS</h3></td></tr></table>
	<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td>No</td>
			<td>Tanggal</td>
			<td>Kode Trx</td>
			<td>Rekanan</td>
			<td>Keterangan</td>
			<td>Kas Masuk</td>
			<td>Kas Keluar</td>
			<td>Saldo</td>
		</tr>
		<?php
			$sql="SELECT sum(debit),sum(kredit) FROM trx_mutasi_uang WHERE tanggal<'$periode1' AND mode='kas'";
			$hsltemp=mysql_query($sql,$db);
			list($sumdebit,$sumkredit)=mysql_fetch_array($hsltemp);
			$saldo=$sumdebit-$sumkredit;
		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Saldo Awal</td>
			<td align="right"><?php echo number_format($sumdebit);?></td>
			<td align="right"><?php echo number_format($sumkredit);?></td>
			<td align="right"><?php echo number_format($saldo);?></td>
		</tr>
		<?php
			$sql="SELECT tanggal,modul,kode_trx,notes,debit,kredit FROM trx_mutasi_uang WHERE tanggal BETWEEN '$periode1' AND '$periode2' AND mode='kas' ORDER BY tanggal";
			$hsldet=mysql_query($sql,$db);
			$no=0;
			while(list($tanggal,$modul,$kode_trx,$notes,$debit,$kredit)=mysql_fetch_array($hsldet)){
				$no++;
				$openwin="";
				if($kode_trx){
					// if(stripos(" ".$modul,"trx_penerimaan")){$openwin="trx_penerimaan_detail.php?kode=$kode_trx";}
					// if(stripos(" ".$modul,"trx_pengiriman")){$openwin="trx_pengiriman_detail.php?kode=$kode_trx";}
					if(stripos(" ".$modul,"trx_permohonandana")){$openwin="trx_permohonandana_slip.php?kode=$kode_trx";}
					if(stripos(" ".$modul,"trx_adv_supplier")){
						$arrtemp=explode("|",$kode_trx);
						$kode_trx=$arrtemp[0];
						$seqno=$arrtemp[1];
						$openwin="trx_adv_supplier_slip.php?kode=$kode_trx&seqno=$seqno";
					}
					if(stripos(" ".$modul,"trx_ap_supplier")){$openwin="rpt_buktibayar.php?kodeap=$kode_trx";}
					if(stripos(" ".$modul,"sms_kasbon")){$openwin="trx_kasharian_slip.php?kode=$kode_trx";}
				}
				$saldo=$saldo+$debit-$kredit;
				// $rekanan="";
				// $rekanan=substr($rekanan,0,strlen($rekanan)-3);
				?>			
				<tr>
					<td align="right"><?php echo $no;?></td>
					<td><?php echo format_tanggal($tanggal);?></td>
					<td Xonclick="OpenWindowGeneral('<?php echo $openwin; ?>');"><?php echo $kode_trx;?></td>
					<td><?php echo $rekanan;?></td>
					<td><?php echo $notes;?></td>
					<td align="right"><?php echo number_format($debit);?></td>
					<td align="right"><?php echo number_format($kredit);?></td>
					<td align="right"><b><?php echo number_format($saldo);?></b></td>
				</tr>
				<?php
			}
		?>
	</table>
	<?php
		}
	?>
	
<?php
	include_once "footer.php";
?>
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
	$periode2=sanitasi($_POST["periode2"]);
	if(!$periode2){$periode2=date("Y-m-d",mktime(0,0,0,date("m")+1,0));}
	
	$kode_pekerjaan=sanitasi($_POST["kode_pekerjaan"]);
	$design=sanitasi($_POST["design"]);
	
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
	</script>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<fieldset>
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
							<!--tr>
								<td><b>Kode Pekerjaan</b></td>
								<td><b>:</b></td>
								<td>
									<input type="text" id="kode_pekerjaan" name="kode_pekerjaan" value="<?php echo $kode_pekerjaan; ?>">
									<img src="images/b_search.png" title="Daftar Kode Pekerjaan" border="0" width="13" height="13" onclick="showKodePekerjaan('kode_pekerjaan')">
								</td>
							</tr-->
							<tr>
								<td><b>Design Report</b></td>
								<td><b>:</b></td>
								<td>
									<select id="design" name="design">
										<option value="">- Pilih Design Report-</option>
										<?php
											$sql="SELECT kodedesign,nama FROM acc_design_report_gl ORDER BY nama";
											$hsldesg=mysql_query($sql,$db);
											while(list($kodedesign,$nama)=mysql_fetch_array($hsldesg)){
										?>
										<option value="<?php echo $kodedesign; ?>"<?php if($design==$kodedesign){echo "selected";} ?>><?php echo "$nama [$kodedesign]"; ?></option>
										<?php
											}
										?>
									</select>
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
			if($numdate>365){$errmessage="<font color='red'>Peride harus < dari 365 hari</font>";}
			if(!$design){$errmessage="<font color='red'>Silakan Pilih Design Report!</font>";}
			if($errmessage==""){
				$page=sanitasi($_GET["page"]);
				$order=sanitasi($_GET["order"]);
				$sorting=sanitasi($_GET["sorting"]);;
				if(!$page){$page="1";}
				if(!$order){$order="acc_jurnal.tanggal";}
				$firstrow=$rowperpage*($page-1);
				$sql="";
				//$sql1="SELECT kode,nama,satuan FROM mst_material_part WHERE modepart='part' ";
				$sql1="Select acc_jurnal.kodejurnal,
				  acc_jurnal.tanggal,
				  acc_jurnal.nocek,
				  acc_jurnal.posting,
				  acc_jurnal_detail.coa,
				  acc_jurnal_detail.koder,
				  acc_jurnal_detail.keterangan,
				  acc_jurnal_detail.debit,
				  acc_jurnal_detail.kredit
				From acc_jurnal Inner Join
				  acc_jurnal_detail On acc_jurnal.kodejurnal = acc_jurnal_detail.kodejurnal ";
				//$sql.="WHERE acc_jurnal.dirutby!='' AND ";
				$sql.="WHERE ";
				if($periode1 && $periode2){
					$sql.="acc_jurnal.tanggal BETWEEN '$periode1' AND '$periode2' AND ";
					$_periode="PERIODE ".format_tanggal($periode1)." - ".format_tanggal($periode2);
				}
				if($kode_pekerjaan){
					$sql.="acc_jurnal.kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";
					$sqltemp="SELECT nama_pekerjaan FROM rap WHERE kode_pekerjaan='$kode_pekerjaan'";
					$hsltemp=mysql_query($sqltemp,$db);
					list($nama_pekerjaan)=mysql_fetch_array($hsltemp);
				}
				$sql=substr($sql,0,-4);
				$sqlsufix=" ORDER BY $order $sorting ";
			}
		}
	?>
	<?php
		//echo $sql1.$sql.$sqlsufix;
		echo $errmessage;
		if($errmessage=="" && $load){
			$totalcolom=11;
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>REKAPITULASI BIAYA PROYEK <?php echo strtoupper($nama_pekerjaan); ?></h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo $_periode; ?></h3></td></tr></table>
		<?php
			$sqldesg="SELECT description,coa FROM acc_design_report_gl_detail WHERE kodedesign='$design'";
			$hsldesg=mysql_query($sqldesg,$db);
			while(list($description,$coas)=mysql_fetch_array($hsldesg)){
				$sqlreport="";
				$arrcoa=explode(";",$coas);
				$coain="";
				foreach($arrcoa as $no => $coa){if($coa){$coain.="'$coa',";}}
				$coain=substr($coain,0,strlen($coain)-1);
				if($coain!="''"){$sqlreport=" AND acc_jurnal_detail.coa IN ($coain)";}
		?>
	
			<table width="100%"><tr><td <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><b><?php echo $description; ?></b></td></tr></table>
			<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
				<tr class="content_header">
					<td><b>No</b></td>
					<td><b>Tgl</b></td>
					<td><b>No Check/BG</b></td>
					<td><b>Keterangan</b></td>
					<td><b>Posting To</b></td>
					<td><b>Coa</b></td>
					<td><b>Group</b></td>
					<td><b>Debit</b></td>
					<td><b>Kredit</b></td>
					<td><b>Jumlah</b></td>
					<td><b>Saldo</b></td>
				</tr>
			<?php
				$sqlexec=$sql1.$sql.$sqlreport.$sqlsufix;
				$hslitem=mysql_query($sqlexec,$db);
				//echo "<br>".$sqlexec;
				$no=$firstrow;
				$arrsubstock=array();
				$totdebit=0;
				$totkredit=0;
				while(list($kodejurnal,$tanggal,$nocek,$_kode_pekerjaan,$coa,$koder,$keterangan,$debit,$kredit)=mysql_fetch_array($hslitem)){	
					$no++;
					//$sql.="acc_jurnal.kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";
					// $sqltemp="SELECT nama_pekerjaan FROM rap WHERE kode_pekerjaan='$_kode_pekerjaan'";
					// $hsltemp=mysql_query($sqltemp,$db);
					// list($nama_pekerjaan)=mysql_fetch_array($hsltemp);
					$nama_pekerjaan=$_kode_pekerjaan;
					$totdebit+=$debit;
					$totkredit+=$kredit;
			?>
					<tr>
						<td align="rigth"><?php echo $no; ?></td>
						<td><?php echo format_tanggal($tanggal); ?></td>
						<td><?php echo $nocek; ?></td>
						<td><?php echo $keterangan; ?></td>
						<td><?php echo $nama_pekerjaan; ?></td>
						<td><?php echo $coa; ?></td>
						<td><?php echo $koder; ?></td>
						<td align="right"><?php echo number_format($debit,2); ?></td>
						<td align="right"><?php echo number_format($kredit,2); ?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
			<?php
				}
				if($totdebit>$totkredit){$jumlah=$totdebit-$totkredit;}else{$jumlah=$totkredit-$totdebit;}
			?>
			<?php if(!$_POST["export"]) {?>
				<tr>
					<td colspan="<?php echo $totalcolom; ?>"><hr></td>
				</tr>
			<?php } ?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="4"><b>JUMLAH</b></td>
					<td align="right"><b><?php echo number_format($totdebit,2); ?></b></td>
					<td align="right"><b><?php echo number_format($totkredit,2); ?></b></td>
					<td align="right"><b><?php echo number_format($jumlah,2); ?></b></td>
					<td>&nbsp;</td>
				</tr>
			<?php } ?>
			</table>
		<?php
			}
		?>
	
<?php
	include_once "footer.php";
?>
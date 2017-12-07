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
											$sql="SELECT kodedesign,nama FROM acc_design_report_rl ORDER BY nama";
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
				$sqljurnal="Select sum(acc_jurnal_detail.debit),sum(acc_jurnal_detail.kredit) From acc_jurnal Inner Join acc_jurnal_detail On acc_jurnal.kodejurnal = acc_jurnal_detail.kodejurnal ";
				//$sqlwhere="WHERE acc_jurnal.dirutby!='' AND ";
				$sqlwhere="WHERE ";
				if($periode1 && $periode2){
					$sqlwhere.="acc_jurnal.tanggal BETWEEN '$periode1' AND '$periode2' AND ";
					$_periode="PERIODE ".format_tanggal($periode1)." - ".format_tanggal($periode2);
				}
				if($kode_pekerjaan){
					$sqlwhere.="acc_jurnal.kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";
					$sqltemp="SELECT nama_pekerjaan FROM rap WHERE kode_pekerjaan='$kode_pekerjaan'";
					$hsltemp=mysql_query($sqltemp,$db);
					list($nama_pekerjaan)=mysql_fetch_array($hsltemp);
				}
				$sqlwhere=substr($sqlwhere,0,-4);
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
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>LABA/RUGI</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo $_periode; ?></h3></td></tr></table>
	
	<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td><b>Keterangan</b></td>
			<td><b></b></td>
			<td><b></b></td>
		</tr>
		<?php
			$sqldesg="SELECT coa,modevalue,description,alias FROM acc_design_report_rl_detail WHERE kodedesign='$design' ORDER BY seqno";
			$hsldesg=mysql_query($sqldesg,$db);
			while(list($coas,$modevalue,$description,$alias)=mysql_fetch_array($hsldesg)){
				$description=str_ireplace("{tab}","&nbsp;&nbsp;&nbsp;&nbsp;",$description);
				$description=str_ireplace("{b}","<b>",$description);
				$description=str_ireplace("{/b}","</b>",$description);
				$description=str_ireplace("{u}","<u>",$description);
				$description=str_ireplace("{/u}","</u>",$description);
				$description=str_ireplace("{i}","<i>",$description);
				$description=str_ireplace("{/i}","</i>",$description);
				$alias=str_ireplace("#","$",$alias);
				$txtnominal="";
				$txtjumlah="";
				$sqlreport="";
				$arrcoa=explode(";",$coas);
				$coain="";
				foreach($arrcoa as $no => $coa){if($coa){$coain.="'$coa',";}}
				$coain=substr($coain,0,strlen($coain)-1);
				if($coain!="''"){$sqlreport=" AND acc_jurnal_detail.coa IN ($coain)";}
				$sql=$sqljurnal.$sqlwhere.$sqlreport;
				//echo "<br>$sql";
				$hsljurnal=mysql_query($sql,$db);
				list($debit,$kredit)=mysql_fetch_array($hsljurnal);
				if($modevalue=="Debit"){$txtnominal=number_format($debit,2);$nominalvalue=$debit;}
				if($modevalue=="Kredit"){$txtnominal=number_format($kredit,2);$nominalvalue=$kredit;}
				if($modevalue=="Debit-Kredit"){$txtnominal=number_format($debit-$kredit,2);$nominalvalue=$debit-$kredit;}
				if($modevalue=="Kredit-Debit"){$txtnominal=number_format($kredit-$debit,2);$nominalvalue=$kredit-$debit;}
				if($nominalvalue<0){$txtnominal="(".substr($txtnominal,1,strlen($txtnominal)).")";}
				if(stripos($alias,"=")<=0){
					eval("$alias = $nominalvalue;");	
				}else{
					eval("$alias");
					$temp=explode("=",$alias);
					$vartemp=$temp[0];
					eval("\$txtjumlah = $vartemp;");
					$txtjumlah=number_format($txtjumlah,2);
				}
				if($txtjumlah<0){$txtjumlah="(".substr($txtjumlah,1,strlen($txtjumlah)).")";}
			?>
			<tr>
				<td><?php echo $description; ?>&nbsp;</td>
				<td align="right">&nbsp;<?php echo $txtnominal;?></td>
				<td align="right">&nbsp;<b><?php echo $txtjumlah;?></b></td>
			</tr>
			<?php } ?>
			</table>
		<?php
			}
		?>
	</table>
<?php
	include_once "footer.php";
?>
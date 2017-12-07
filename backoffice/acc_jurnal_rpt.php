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
			//if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
			//if(!$gudang){$errmessage="<font color='red'>Silakan Pilih Cabang/Gudang!</font>";}
			if($errmessage==""){
				$page=sanitasi($_GET["page"]);
				$order=sanitasi($_GET["order"]);
				$sorting=sanitasi($_GET["sorting"]);
				if(!$page){$page="1";}
				if(!$order){$order="tanggal";}
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
				//$sql2="SELECT count(id) FROM mst_material_part WHERE modepart='part' ";
				$sql2="Select count(acc_jurnal.kodejurnal) From acc_jurnal Inner Join acc_jurnal_detail On acc_jurnal.kodejurnal = acc_jurnal_detail.kodejurnal ";
				$sqlsum="Select sum(acc_jurnal_detail.debit),sum(acc_jurnal_detail.kredit) From acc_jurnal Inner Join acc_jurnal_detail On acc_jurnal.kodejurnal = acc_jurnal_detail.kodejurnal ";
				//$sql3="SELECT kode FROM mst_material_part WHERE modepart='part' ";
				$sqlexport=$sql1;
				if($periode1 || $periode2 || $kode_pekerjaan){$sql.="AND ";}
				//$sql.=" acc_jurnal.dirutby!='' AND ";
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
				$sql2.=$sql;
				$sqlsum.=$sql;
				$sqlexport.=$sql;
				$sql.="ORDER BY $order $sorting ";
				$sql.="LIMIT $firstrow,$rowperpage";
				//PAGING
				$sql=$sql1.$sql;
				//echo $sql;
				$hsltemp=mysql_query($sql2,$db);
				list($numrow)=mysql_fetch_array($hsltemp);
				$numpage=round($numrow/$rowperpage)+1;
				if($page>1){$prevpage=$page-1;}else{$prevpage=1;}
				if($page<$numpage){$nextpage=$page+1;}else{$nextpage=$numpage;}
				$paging="";
				$_xx1=$page-2;
				if($_xx1<1){$_xx1=1;}
				for($xx=$_xx1;$xx<=$_xx1+5;$xx++){
					if($xx==$page){
						$paging.="|<a href='".$_SERVER["PHP_SELF"]."?page=$xx&arrpost=$arrpost'><b>$xx</b></a>";
					}else{
						$paging.="|<a href='".$_SERVER["PHP_SELF"]."?page=$xx&arrpost=$arrpost'>$xx</a>";
					}
					if($xx>=$numpage){break;}
				}
				$paging.="|";
				if($_xx1>1){$paging="..".$paging;}
				if($_xx1+5<$numpage){$paging.="..";}
				$paging="<a href='".$_SERVER["PHP_SELF"]."?page=$prevpage&arrpost=$arrpost'>&lt;Prev</a> ".$paging;
				$paging="<a href='".$_SERVER["PHP_SELF"]."?page=1&arrpost=$arrpost'>&lt;&lt;First</a> ".$paging;
				$paging=$paging." <a href='".$_SERVER["PHP_SELF"]."?page=$nextpage&arrpost=$arrpost'>Next&gt;</a> ";
				$paging=$paging." <a href='".$_SERVER["PHP_SELF"]."?page=$numpage&arrpost=$arrpost'>Last&gt;&gt;</a> ";
				//END PAGING
			}
		}
	?>
	<?php
		echo $errmessage;
		if($errmessage=="" && $load){
			$totalcolom=9;
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>JURNAL ACOUNTING</h3></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3><?php echo $_periode; ?></h3></td></tr></table>
	<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
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
		</tr>
	<?php
		if(!$_POST["export"]) {$hslitem=mysql_query($sql,$db);}else{$hslitem=mysql_query($sqlexport,$db);}
		//echo $sql;
		$no=$firstrow;
		$arrsubstock=array();
		while(list($kodejurnal,$tanggal,$nocek,$kode_pekerjaan,$coa,$koder,$keterangan,$debit,$kredit)=mysql_fetch_array($hslitem)){	
			$no++;
			//$sql.="acc_jurnal.dirutby!='' AND acc_jurnal.kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";
			$sql.="acc_jurnal.kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";
			// $sqltemp="SELECT nama_pekerjaan FROM rap WHERE kode_pekerjaan='$kode_pekerjaan'";
			// $hsltemp=mysql_query($sqltemp,$db);
			// list($nama_pekerjaan)=mysql_fetch_array($hsltemp);
			$nama_pekerjaan=$kode_pekerjaan;
	?>
			<tr>
				<td align="rigth"><?php echo $no; ?></td>
				<td><?php echo format_tanggal($tanggal); ?></td>
				<td><?php echo $nocek; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td><?php echo $nama_pekerjaan; ?></td>
				<td><?php echo $coa; ?></td>
				<td><?php echo $koder; ?></td>
				<td align="right"><?php if($debit>=1){if($_POST["export"]){echo $debit;}else{echo number_format($debit,2);}}else{echo "";} ?></td>
				<td align="right"><?php if($kredit>=1){if($_POST["export"]){echo $kredit;}else{echo number_format($kredit,2);}}else{echo "";} ?></td>
			</tr>
	<?php
		}
		$hsltemp=mysql_query($sqlsum,$db);
		list($totdebit,$totkredit)=mysql_fetch_array($hsltemp)
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
			<td align="right"><b><?php if($_POST["export"]){echo $totdebit;}else{echo number_format($totdebit,2);} ?><b></td>
			<td align="right"><b><?php if($_POST["export"]){echo $totkredit;}else{echo number_format($totkredit,2);} ?><b></td>
		</tr>
	<?php } ?>
	</table>
	<?php if(!$_POST["export"]) {?>
	<table width="100%">
		<tr>
			<td><?php echo $paging; ?></td>
		</tr>
	</table>
	<?php } ?>
	
<?php
	include_once "footer.php";
?>
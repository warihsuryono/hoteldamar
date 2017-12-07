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
	$rangeperiode=date("d M Y",mktime(0,0,0,substr($periode1,5,2),substr($periode1,8,2),substr($periode1,0,4)))." s/d ".date("d M Y",mktime(0,0,0,substr($periode2,5,2),substr($periode2,8,2),substr($periode2,0,4)));
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
				<!--tr>
					<td valign="top">
						<table>
							<tr>
								<td nowrap><b>Kode Pekerjaan</b></td>
								<td><b>:</b></td>
								<td>
									<input type="text" id="kode_pekerjaan" name="kode_pekerjaan" value="<?php echo $kode_pekerjaan; ?>">
									<img src="images/b_search.png" title="Daftar Kode Pekerjaan" border="0" width="13" height="13" onclick="showKodePekerjaan('kode_pekerjaan')">
								</td>
							</tr>
						</table>
					</td>
				</tr-->					
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
			if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
			//if(!$kode_pekerjaan){$errmessage="<font color='red'>Silakan Pilih Kode Pekerjaan!</font>";}
			if($errmessage==""){
				$page=sanitasi($_GET["page"]);
				$order=sanitasi($_GET["order"]);
				$sorting=sanitasi($_GET["sorting"]);
				if(!$page){$page="1";}
				if(!$order){$order="kode";}
				$firstrow=$rowperpage*($page-1);
				$sql="";
				$sql1="SELECT item,sum(volume),satuan,harsat FROM rap_detail ";
				//$sql2="SELECT count(kode) FROM logistik_transfer_material_detail ";
				$sqlexport="SELECT item,sum(volume),satuan,harsat FROM rap_detail ";
				//if($kode_pekerjaan || $hotmix || $lokasi){$sql.="WHERE ";}
				//if($kode_pekerjaan){$sql.="WHERE kode_pekerjaan LIKE '%$kode_pekerjaan%' AND ";}
				$sql=substr($sql,0,-4);
				$sql2.=$sql;
				$sql3.=$sql;
				$sqlexport.=$sql;
				$sql.="ORDER BY seqno $sorting ";
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
			$sqlx="SELECT nama_pekerjaan,lokasi FROM rap WHERE kode_pekerjaan='$kode_pekerjaan'";
			$hsltemp=mysql_query($sqlx,$db);
			list($namaproyek,$lokasi)=mysql_fetch_array($hsltemp);
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=7";} ?>><h2>PT.ANUGERAH JAYA MULIA UTAMA</h2></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=7";} ?>><h2>LAPORAN PERTANGGUNG JAWABAN (LPJ)</h2></td></tr></table>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=7";} ?>><h2><?php echo strtoupper($namaproyek) ?></h2></td></tr></table>
	<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td rowspan="2" align="center">No</td>
			<td rowspan="2" align="center">Barang</td>
			<td rowspan="2" align="center">RAP</td>
			<td rowspan="2" align="center">Satuan</td>
			<td rowspan="2" align="center">Volume</td>
			<td colspan="2" align="center" nowrap>Harga Satuan</td>
			<td colspan="2" align="center" nowrap>Total Harga</td>
			<td rowspan="2" align="center">Supplier</td>
		</tr>
		<tr class="content_header">
			<td align="center">RAP</td>
			<td align="center">REAL</td>
			<td align="center">RAP</td>
			<td align="center">REAL</td>
		</tr>
	<?php
		if(!$_POST["export"]) {$hslitem=mysql_query($sql,$db);}else{$hslitem=mysql_query($sqlexport,$db);}
		$no=$firstrow;
		$arrsubstock=array();
		$kumulatif=0;
		while(list($kodeitem,$qty,$satuan,$harsat)=mysql_fetch_array($hslitem)){	
			$no++;
			//cari apakah item merupakan material atau part
			$sql="SELECT nama,modepart FROM mst_material_part WHERE kode='$kodeitem'";
			$hsltemp=mysql_query($sql,$db);
			list($namamaterial,$modepart)=mysql_fetch_array($hsltemp);
			if($modepart=="material"){
				$sql="SELECT sum(transqty) FROM logistik_transfer_material_detail WHERE kodebarang='$kodematerial' AND transkode IN (SELECT transkode FROM logistik_transfer_material WHERE kode_pekerjaan='$kode_pekerjaan')";
			}else{
				$sql="SELECT sum(transqty) FROM workshop_transfer_part_detail WHERE partno='$kodematerial' AND transkode IN (SELECT transkode FROM workshop_transfer_part WHERE kode_pekerjaan='$kode_pekerjaan')";
			}
			$hsltemp=mysql_query($sql,$db);
			list($real)=mysql_fetch_array($hsltemp);
			$totalrap=$qty*$harsat;
			$totalreal=$real*$harsat;
	?>
			<tr>
				<td align="rigth"><?php echo $no; ?></td>
				<td><?php echo $namamaterial; ?></td>
				<td align="right"><?php echo number_format($qty); ?></td>
				<td><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($real); ?></td>
				<td align="right"><?php echo number_format($harsat); ?></td>
				<td align="right"><?php echo number_format($harsat); ?></td>
				<td align="right"><?php echo number_format($totalrap); ?></td>
				<td align="right"><?php echo number_format($totalreal); ?></td>
				<td>&nbsp;</td>
			</tr>
	<?php
		}
	?>
	</table>
	<?php if(!$_POST["export"]) {?>
	<table width="100%">
		<tr>
			<td><?php echo $paging; ?></td>
		</tr>
	</table>
	<?php } ?>
	<?php
		}
	?>
	
<?php
	include_once "footer.php";
?>
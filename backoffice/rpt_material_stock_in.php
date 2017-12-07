<?php
	//if($_POST["export"] && $_POST["gudang"]){
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
	
	//$gudang=sanitasi($_POST["gudang"]);
	$modelunit=sanitasi($_POST["modelunit"]);
	$kodebarang=sanitasi($_POST["kodebarang"]);
	$namabarang=str_replace("`","%",sanitasi($_POST["namabarang"]));
	$partno=sanitasi($_POST["partno"]);
	$category=sanitasi($_POST["category"]);
	$modelunit=sanitasi($_POST["modelunit"]);
	
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
		function showPart(textid,nameid,priceid,vendor) {
		   detailsWindow = window.open("winpartlist.php?textid="+textid+"&nameid="+nameid+"&priceid="+priceid+"&vendor="+vendor+"","winpartlist","width=800,height=600,top=300,scrollbars=yes");
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
								<td nowrap><b>Cabang/Gudang</b></td>
								<td><b>:</b></td>
								<td>
									<select name="gudang">
										<option value="">-Pilih-</option>
										<?php
											$sql="SELECT kode,nama,alamat FROM mst_gudang ORDER BY nama";
											$hsltemp=mysql_query($sql,$db);
											while(list($id,$nama,$alamat)=mysql_fetch_array($hsltemp)){
										?>
											<option value="<?php echo $id; ?>" <?php if($id==$gudang){echo "selected";} ?>><?php echo "$nama, $alamat"; ?></option>
										<?php	
											}
										?>
									</select>
								</td>
							</tr-->
							<tr>
								<td nowrap><b>Nama Barang</b></td>
								<td><b>:</b></td>
								<td>
									<input id="namabarang" type="text" name="namabarang" value="<?php echo sanitasi($_POST["namabarang"]); ?>" size="20">
								</td>
							</tr>
							<tr>
								<td nowrap><b>Kode Barang</b></td>
								<td><b>:</b></td>
								<td nowrap>
									<input id="kodebarang" type="text" name="kodebarang" value="<?php echo sanitasi($_POST["kodebarang"]); ?>" size="20">
									<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showMaterial('kodebarang')">
								</td>
							</tr>
						</table>
					</td>
					<td valign="top">
						<table>	
							<tr>
								<td nowrap><b>Serial No</b></td>
								<td><b>:</b></td>
								<td>
									<input id="partno" type="text" name="partno" value="<?php echo sanitasi($_POST["partno"]); ?>" size="20">
								</td>
							</tr>	
							<tr>
								<td nowrap><b>Category</b></td>
								<td><b>:</b></td>
								<td>
									<input id="category" type="text" name="category" value="<?php echo sanitasi($_POST["category"]); ?>" size="20">
								</td>
							</tr>		
							<tr>
								<td nowrap><b>Tipe Barang</b></td>
								<td><b>:</b></td>
								<td>
									<select name="modelunit">
										<option value="">-Pilih-</option>
										<?php
											$sql="SELECT kode,model FROM mst_modelunit ORDER BY model";
											$hsltemp=mysql_query($sql,$db);
											while(list($id,$name)=mysql_fetch_array($hsltemp)){
										?>
											<option value="<?php echo $id; ?>" <?php if($id==$modelunit){echo "selected";} ?>><?php echo $name." [$id]"; ?></option>
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
			if($numdate>31){$errmessage="<font color='red'>Peride harus < dari 31 hari</font>";}
			//if(!$gudang){$errmessage="<font color='red'>Silakan Pilih Cabang/Gudang!</font>";}
			if($errmessage==""){
				$page=sanitasi($_GET["page"]);
				$order=sanitasi($_GET["order"]);
				$sorting=sanitasi($_GET["sorting"]);
				if(!$page){$page="1";}
				if(!$order){$order="kode";}
				$firstrow=$rowperpage*($page-1);
				$sql="";
				$sql1="SELECT kode,nama,satuan FROM mst_material_part WHERE modepart='' ";
				$sql2="SELECT count(id) FROM mst_material_part WHERE modepart='' ";
				$sql3="SELECT kode FROM mst_material_part WHERE modepart='' ";
				$sqlexport="SELECT kode,nama,satuan FROM mst_material_part WHERE modepart='' ";
				if($kodebarang || $namabarang || $partno || $category || $modelunit){$sql.="AND ";}
				if($kodebarang){$sql.="kode LIKE '%$kodebarang%' AND ";}
				if($namabarang){$sql.="nama LIKE '%$namabarang%' AND ";}
				if($partno){$sql.="pn LIKE '%$partno%' AND ";}
				if($category){$sql.="category LIKE '%$category%' AND ";}
				if($modelunit){$sql.="modelunit = '$modelunit' AND ";}
				$sql=substr($sql,0,-4);
				$sql2.=$sql;
				$sql3.=$sql;
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
			$totalcolom=$numdate+4;
	?>
	<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>Stok Barang Masuk</h3></td></tr></table>
	<table class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
		<tr class="content_header">
			<td colspan="4">
				Barang
			</td>
			<td colspan="<?php echo $numdate; ?>">
				Tanggal
			</td>
			<!--td rowspan="2">SubTotal</td-->
		</tr>
		<tr class="content_header">
			<td>No</td>
			<td>Kode Barang</td>
			<td>Nama Barang</td>
			<td>Satuan</td>
			<?php
				$arrperiode1=explode("-",$periode1);			
				$xxdate=0;
				for($xxdate=0;$xxdate<$numdate;$xxdate++){
					$date=date("dM",mktime(0,0,0,$arrperiode1[1],$arrperiode1[2]+$xxdate,$arrperiode1[0]));
			?>
				<td><?php echo $date; ?></td>
			<?php
				}
			?>
		</tr>
	<?php
		if(!$_POST["export"]) {$hslitem=mysql_query($sql,$db);}else{$hslitem=mysql_query($sqlexport,$db);}
		$no=$firstrow;
		$arrsubstock=array();
		while(list($kodebarang,$namabarang,$satuan)=mysql_fetch_array($hslitem)){	
			$no++;
	?>
			<tr>
				<td align="rigth"><?php echo $no; ?></td>
				<td><?php echo $kodebarang; ?></td>
				<td><?php echo $namabarang; ?></td>
				<td><?php echo $satuan; ?></td>
				<?php
					$arrperiode1=explode("-",$periode1);			
					$xxdate=0;
					$substock=0;
					for($xxdate=0;$xxdate<$numdate;$xxdate++){
						$currentdate=date("Y-m-d",mktime(0,0,0,$arrperiode1[1],$arrperiode1[2]+$xxdate,$arrperiode1[0]));
						//stockin
						$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE histdate='$currentdate' AND desttype='gudang' AND destid='$gudang' AND kodebarang='$kodebarang'";
						$hsltemp=mysql_query($sql,$db);
						list($stockin)=mysql_fetch_array($hsltemp);
						//stockout
						// $sql="SELECT sum(qty) FROM logistik_hist_stok WHERE histdate<='$currentdate' AND sourcetype='gudang' AND sourceid='$gudang' AND kodebarang='$kodebarang'";
						// $hsltemp=mysql_query($sql,$db);
						// list($stockout)=mysql_fetch_array($hsltemp);
						// $stock=$stockin-$stockout;
						$stock=$stockin*1;
						$substock+=$stock;
						$arrsubstock[$xxdate]+=$stock;
						$txtstock="$stock";
						if($xxdate>0){
							if($laststock>$stock){
								$txtstock="<font color='red'>$stock</font>";
							}
							if($laststock<$stock){
								$txtstock="<font color='blue'>$stock</font>";								
							}
						}
						$laststock=$stock;
				?>
					<td align="right"><?php echo $txtstock; ?></td>
				<?php
					}
				?>
				<!--td align="right"><b><?php echo $substock; ?></b></td-->
			</tr>
	<?php
		}
	?>
		<tr><td colspan="<?php echo $numdate+4; ?>"></td></tr>
		<tr>
			<td colspan="4"><b>Total/Page</b></td>
			<?php
				$substockpage=0;
				for($xxdate=0;$xxdate<$numdate;$xxdate++){
					$stockpage=$arrsubstock[$xxdate];
					$substockpage+=$stockpage;
					$txtstockpage="$stockpage";
					if($xxdate>0){
						if($laststockpage>$stockpage){
							$txtstockpage="<font color='red'>$stockpage</font>";
						}
						if($laststockpage<$stockpage){
							$txtstockpage="<font color='blue'>$stockpage</font>";								
						}
					}
					$laststockpage=$stockpage;
			?>
				<td align="right"><b><?php echo $txtstockpage; ?></b></td>
			<?php
				}
			?>			
			<!--td align="right"><b><?php echo $substockpage; ?></b></td-->
		</tr>
		<tr>
			<td colspan="<?php echo $numdate+4; ?>">
			</td>
		</tr>
		<?php if(!$_POST["export"]) {?>
		<tr>
			<td colspan="4"><b>Grand Total</b></td>
			<?php
				$total=0;
				for($xxdate=0;$xxdate<$numdate;$xxdate++){
					$currentdate=date("Y-m-d",mktime(0,0,0,$arrperiode1[1],$arrperiode1[2]+$xxdate,$arrperiode1[0]));
					//stockin
					$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE histdate='$currentdate' AND desttype='gudang' AND destid='$gudang' AND kodebarang IN ($sql3)";
					$hsltemp=mysql_query($sql,$db);
					list($stockin)=mysql_fetch_array($hsltemp);
					//stockout
					// $sql="SELECT sum(qty) FROM logistik_hist_stok WHERE histdate<='$currentdate' AND sourcetype='gudang' AND sourceid='$gudang' AND kodebarang IN ($sql3)";
					// $hsltemp=mysql_query($sql,$db);
					// list($stockout)=mysql_fetch_array($hsltemp);
					// $stocktot=$stockin-$stockout;
					$stocktot=$stockin*1;
					$total+=$stocktot;
					$txtstocktot="$stocktot";
					if($xxdate>0){
						if($laststocktot>$stocktot){
							$txtstocktot="<font color='red'>$stocktot</font>";
						}
						if($laststocktot<$stocktot){
							$txtstocktot="<font color='blue'>$stocktot</font>";								
						}
					}
					$laststocktot=$stocktot;
			?>
				<td align="right"><b><?php echo $txtstocktot; ?></b></td>
			<?php
				}
			?>			
			<!--td align="right"><b><?php echo $total; ?></b></td-->
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
		}
	?>
	
<?php
	include_once "footer.php";
?>
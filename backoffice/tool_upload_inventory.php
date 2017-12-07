<?php
	include_once "header.php";
	include_once "func.openwin.php";
	if($_POST["create"]){
		$baris=$_POST["baris"];
		$tanggal=$_POST["tanggal"];
		$updatestock=$_POST["updatestock"];
		$histdate=$tanggal;
		$notes="Upload Stock per tanggal $tanggal";
		$createby=$__username;
		$modulfilename=basename($__phpself);
		//insert detail;
		$filename = "temp/temp.csv";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		$arrcontents=explode(chr(13).chr(10),$contents);
		$seqno=-1;
		foreach ($arrcontents as $rowno => $rowcontent){
			if($rowno>=$baris){
				$arrcols=explode(";",$rowcontent);
				$nama=$arrcols[0];					
				$nama=str_ireplace("\"","\"\"",$nama);
				$nama=str_ireplace("\'","\'\'",$nama);
				if($nama){
					$sql="SELECT kode FROM mst_material_part WHERE nama LIKE '$nama'";
					$hsltemp=mysql_query($sql,$db);
					if(mysql_affected_rows($db)<1){
						$category=$arrcols[1];
						$tipe=$arrcols[2];
						$qty=$arrcols[3];
						$satuan=$arrcols[4];
						//echo "<br>$nama|$category|$tipe|$qty|$satuan";
						$kodebarang=$category.$tipe;
						$sql="SELECT kode FROM mst_material_part WHERE kode LIKE '$kodebarang%' ORDER BY kode DESC LIMIT 1";
						$hsltemp=mysql_query($sql,$db);
						list($_seqno)=mysql_query($sql,$db);
						$_seqno=str_ireplace($kodebarang,"",$_seqno);
						$_seqno=$_seqno*1;
						$_seqno++;
						$kodebarang=$kodebarang.substr("0000",0,4-strlen($_seqno)).$_seqno;
						$sql="INSERT INTO mst_material_part (kode,category,modelunit,nama,satuan) VALUES ('$kodebarang','$category','$tipe','$nama','$satuan')";
						mysql_query($sql,$db);
					}else{
						list($kodebarang)=mysql_fetch_array($hsltemp);
					}
					if($_POST["updatestock"]==1){
						//cari qty di system
						$gudang="";
						$realqty=$qty;
						//qtymasuk
						$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE destid='$gudang' AND kodebarang='$kodebarang'";
						$hsltemp=mysql_query($sql,$db);
						list($qtymasuk)=mysql_fetch_array($hsltemp);
						//qtykeluar
						$sql="SELECT sum(qty) FROM logistik_hist_stok WHERE sourceid='$gudang' AND kodebarang='$kodebarang'";
						$hsltemp=mysql_query($sql,$db);
						list($qtykeluar)=mysql_fetch_array($hsltemp);
						$systemqty=$qtymasuk-$qtykeluar;
						if($systemqty<=$realqty){//tambah qty
							$in_out="1";
							$sourcetype="{kontrol}";
							$sourceid="{kontrol}";
							$desttype="gudang";
							$destid=$gudang;
							$qty=$realqty-$systemqty;
						}else{//kurangi qty
							$in_out="2";
							$sourcetype="gudang";
							$sourceid=$gudang;
							$desttype="{kontrol}";
							$destid="{kontrol}";
							$qty=$systemqty-$realqty;
						}
						if($qty!=0){
							$sql="INSERT INTO logistik_hist_stok (in_out,histdate,modulfilename,mrno,pono,wrno,sourcetype,sourceid,desttype,destid,kodebarang,qty,satuan,notes,createby,createdate) VALUES ";
							$sql.="('$in_out','$histdate','$modulfilename','$mrno','$pono','$kode','$sourcetype','$sourceid','$desttype','$destid','$kodebarang','$qty','$satuan','$notes','$createby',NOW())";
							mysql_query($sql,$db);
							//echo "<br>$sql => ".mysql_error();
						}
						$sql="SELECT seqno FROM logistik_stok WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
						mysql_query($sql,$db);
						if(mysql_affected_rows($db)>0){//sudah ada
							$sql="UPDATE logistik_stok SET stock=$realqty,createby='$createby',createdate=NOW() WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
						}else{//belum ada
							$sql="INSERT INTO logistik_stok (branchtype,branchid,kodebarang,stock,createby,createdate) VALUES ";
							$sql.="('gudang','$gudang','$kodebarang','$realqty','$createby',NOW())";
						}
						mysql_query($sql,$db);
						//echo "<br>$sql => ".mysql_error();
					}
				}
			}
		}
		?> <script language="javascript">alert("Proses Selesai!");</script> <?php
	}
?>
	<fieldset>
		<legend><b>Upload file</b></legend>
		<form enctype="multipart/form-data" method="POST" action="<?php echo $__phpself; ?>">
			<table>
				<tr>
					<td>Filename< (*.csv)/td>
					<td>:</td>
					<td><input name="filename" type="file" size="100"></td>
				</tr>
				<tr><td colspan="3"><input type="submit" name="upload" value="Upload"></td></tr>
				<tr><td colspan="3"><b>Format => nama;kode kategory;kode tipe;qty;kode satuan</b></td></tr>
				<tr><td colspan="3"><b>(*.xls Save As menjadi *.csv)</b></td></tr>
			</table>
		</form>
	</fieldset>
<?php
	$fileuploaded=0;
	if($_POST["upload"] && $_FILES["filename"]["tmp_name"]){
		$filename=$_FILES["filename"]["name"];
		$uploaddir="temp/temp.csv";
		//Copy the file to some permanent location
		if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploaddir)){
			$fileuploaded=1;
		}else{
			?> <script language="javascript">alert("There was a problem when uploding the new file.");</script> <?php
		}
	}
	if($fileuploaded || $_POST["create"]){
		$filename = "temp/temp.csv";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		$arrcontents=explode(chr(13).chr(10),$contents);
		?>
		<fieldset>
			<legend><b>Detail</b></legend>
			<form method="POST" action="<?php echo $__phpself; ?>">
				<table>
					<tr>
						<td>Baris Pertama</td>
						<td>:</td>
						<td>
							<select name="baris">
								<option value="">- Pilih Baris -</option>
								<?php
									foreach ($arrcontents as $seqno => $value){
										?><option value="<?php echo $seqno; ?>">[<?php echo $seqno; ?>] <?php echo $value; ?></option><?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td>
							<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
							<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal','tanggal')">
						</td>
					</tr>
					<tr>
						<td>Update Stock</td>
						<td>:</td>
						<td>
							<select name="updatestock">
								<option value='0' <?php if($_POST["updatestock"]==0){echo "selected";} ?>>Tidak</option>
								<option value='1' <?php if($_POST["updatestock"]==1){echo "selected";} ?>>Ya</option>
							</select>
						</td>
					</tr>
					<tr><td colspan="3"><input type="submit" name="create" value="Create"></td></tr>
				</table>
			</form>
		</fieldset>
		<?php
	}
	include_once "footer.php";
?>
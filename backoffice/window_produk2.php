<?php
	include_once "connect.php";
	$content_title="PRODUK";
?>
<?php include_once "header_window_content.php"; ?>
<script language="javascript">
	var detailsWindow;
	function showVendor(textid,txtname,txtaddr,mode)
	{
	   detailsWindow = window.open("window_vendor.php?textid="+textid+"&txtname="+txtname+"&txtaddr="+txtaddr+"&mode="+mode+"","vendor","width=400,height=600,top=0,scrollbars=yes");
	   detailsWindow.focus();   
	}
	function showparent(textid,textnama,id){
		window.opener.document.getElementById(textid).value=id;
		window.opener.document.getElementById(textid).focus();
		window.close();
	}
</script>
<?php
	if(sanitasi($_GET['delaxscdv'])){
		$barkode=sanitasi($_GET['delaxscdv']);
		$sql="DELETE FROM produk WHERE kode='$barkode'";
		mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			?>
				<script language="javascript">
					alert('Produk Berhasil Dihapus.');
					window.location='produk_list.php';
				</script>
			<?php
		}else{
			?>
				<script language="javascript">
					alert('Produk Gagal Dihapus!');
					window.location='produk_list.php';
				</script>
			<?php
		}
	}
	if(sanitasi($_POST["reset"])){$_POST=array();}
	$kode=sanitasi($_POST["srckode"]);
	$barcode=sanitasi($_POST["srckode"]);
	$kode_tipe=sanitasi($_POST["srctipe"]);
	$nama=sanitasi($_POST["srcnama"]);
?>
	<fieldset>
		<legend>Cari:</legend>
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?textid=<?php echo sanitasi($_GET["textid"]);?>&textnama=<?php echo sanitasi($_GET["textnama"]);?>&kodeproduk=<?php echo sanitasi($_GET["kodeproduk"]);?>&idukuran=<?php echo sanitasi($_GET["idukuran"]);?>&idsatuan=<?php echo sanitasi($_GET["idsatuan"]);?>">
			<table>
				<tr>
					<td valign="top">
						<table>
							<tr>
								<td nowrap><b>Barcode</b></td>
								<td><b>:</b></td>
								<td><input type="text" name="srckode" id="srckode" value="<?php echo sanitasi($_POST["srckode"]); ?>" size="25"></td>
							</tr>
							<tr>
								<td nowrap><b>Tipe</b></td>
								<td><b>:</b></td>
								<td>
									<select name="srctipe" id="srctipe">
										<option value="">-Model-</option>
										<?php
											//$sql="SELECT kode,model FROM mst_model";
											$sql="SELECT kode,model FROM mst_modelunit";
											$hsl=mysql_query($sql,$db);
											while(list($kode,$item)=mysql_fetch_array($hsl)){
										?>
											<option value="<?php echo $kode; ?>" <?php if($kode==sanitasi($_POST["srctipe"])){echo "selected";} ?>><?php echo $item; ?></option>
										<?php
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap><b>Nama Produk</b></td>
								<td><b>:</b></td>
								<td><input type="text" name="srcnama" id="srcnama" value="<?php echo sanitasi($_POST["srcnama"]); ?>"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="search" value="Cari">
						<input type="submit" name="reset" value="Reset">
					</td>
				</tr>
				<?php
					if(sanitasi($_POST["prev"])){
						if(sanitasi($_POST["startrow"])-20<=0){$_POST["startrow"]=0;}else{$_POST["startrow"]=sanitasi($_POST["startrow"])-20;}
					}
					if(sanitasi($_POST["next"])){
						$_POST["startrow"]=sanitasi($_POST["startrow"])+20;
					}
					if(sanitasi($_POST["startrow"])){$startrow=sanitasi($_POST["startrow"]);}else{$startrow=0;}
				?>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="prev" value="Prev">
						<input type="submit" name="next" value="Next">
					</td>
				</tr>
				<input type="hidden" name="startrow" value="<?php echo sanitasi($_POST["startrow"]); ?>">
			</table>
		</form>
	</fieldset>
	<table border="1">
		<tr>
			<td><b>No</b></td>
			<td><b>Kode(BarCode)</b></td>
			<td><b>Nama</b></td>
			<td><b>Tipe</b></td>
			<td><b>Satuan</b></td>
			<td><b>Harga Jual</b></td>
		</tr>
		<?php
			$sql="SELECT mst_material_part.kode,mst_material_part.modelunit,mst_material_part.nama,mst_material_part.satuan,mst_harga_toko.harga FROM mst_material_part INNER JOIN mst_harga_toko ON (mst_material_part.kode=mst_harga_toko.kode) WHERE mst_material_part.category IN (SELECT id FROM mst_material_cat WHERE description LIKE 'toko')";
			$sql.=" AND modelunit LIKE '%$kode_tipe' LIMIT $startrow,20";
			//echo $sql;
			$xhsl=mysql_query($sql,$db);
			$no=$startrow;
			while(list($kode,$kode_tipe,$nama,$kode_satuan,$harga)=mysql_fetch_array($xhsl)){
				$no++;
				$sql="SELECT description FROM mst_modelunit WHERE id='$kode_tipe'";
				$hsl=mysql_query($sql,$db);
				list($tipe)=mysql_fetch_array($hsl);
				$sql="SELECT satuan FROM mst_satuan WHERE kode='$kode_satuan'";
				$hsl=mysql_query($sql,$db);
				list($satuan)=mysql_fetch_array($hsl);
		?>
				<tr>
					<td valign="top">
						<a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>','<?php echo $nama; ?>');">
							<?php echo $no; ?>
						</a>
					</td>
					<td valign="top"><a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>');"><?php echo $kode; ?></a></td>
					<td valign="top"><a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>');"><?php echo $nama; ?></a></td>
					<td valign="top"><a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>');"><?php echo $tipe; ?></a></td>
					<td valign="top"><a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>');"><?php echo $satuan; ?></a></td>
					<td valign="top" align="right"><a ondblclick="showparent('<?php echo $_GET['textid']; ?>','<?php echo $_GET['textnama']; ?>','<?php echo $kode; ?>');"><?php echo number_format($harga); ?></a></td>
				</tr>
		<?php
			}
		?>
	</table>
<?php include_once "footer_window_content.php"; ?>
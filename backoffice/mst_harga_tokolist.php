<?php
	include_once "header.php";
	include_once "func_number_format.php";
	if($_POST["simpan"]){
		foreach($_POST["harga"] as $kode => $harga){
			$harga=un_formated($harga);
			$sql="REPLACE INTO mst_harga_toko (kode,harga,createby) VALUES ('$kode','$harga','$__username')";
			mysql_query($sql,$db);
		}
		?><script language="javascript">alert("Data Tersimpan!")</script><?php
	}
?>
	<form method="POST">
		<table width="100%"><tr><td align="center"><h3><b>DAFTAR HARGA JUAL BARANG</b></h3></td></tr></table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1">No</td>
				<td width="1" nowrap>Kode Barang</td>
				<td width="1" nowrap>Tipe Barang</td>
				<td width="1" nowrap>Nama Barang</td>
				<td width="1" nowrap>Harga</td>
				<td width="1" nowrap>Create By</td>
				<td width="1" nowrap>Create Date</td>
			</tr>
			<?php
				$sql="SELECT kode,modelunit,nama FROM mst_material_part WHERE category IN (SELECT id FROM mst_material_cat WHERE description LIKE 'toko')";
				$hsldet=mysql_query($sql,$db);
				$no=0;
				while(list($kode,$modelunit,$nama)=mysql_fetch_array($hsldet)){
					$no++;
					$sql="SELECT harga,createby,xtimestamp FROM mst_harga_toko WHERE kode='$kode'";
					$hsltemp=mysql_query($sql,$db);
					list($harga,$createby,$xtimestamp)=mysql_fetch_array($hsltemp);
					$sql="SELECT model FROM mst_modelunit WHERE kode='$modelunit'";
					$hsltemp=mysql_query($sql,$db);
					list($tipe)=mysql_fetch_array($hsltemp);
				?>
					<tr>
						<td align="right"><?php echo $no; ?></td>
						<td><?php echo $kode; ?></td>
						<td><?php echo $tipe; ?></td>
						<td><?php echo $nama; ?></td>
						<td align="right"><input type="text" name="harga[<?php echo $kode; ?>]" value="<?php echo number_format($harga); ?>" style="text-align:right;"></td>
						<td><?php echo $createby; ?></td>
						<td><?php echo $xtimestamp; ?></td>
					</tr>
				<?php
				}
			?>
			<tr><td colspan="7" align="center"><input type="submit" name="simpan" value="Simpan"></td></tr>
		</table>
	</form>
<?php
	include_once "footer.php";
?>
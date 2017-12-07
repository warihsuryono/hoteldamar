<?php
	//warih hadi suryono
	$content_title="RETUR";
	include_once "connect.php";
	include_once "clsnaikanharga.php";
	$_width="width='100%'";
	include_once "header_window_content.php";
	if(!$_SESSION["outlet"]){$_SESSION["outlet"]="999";}
	if(!$_SESSION["username"]){$_SESSION["username"]="user_tester";}
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]){
		$returno=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"];
	}else{
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$returno="R".date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos_retur WHERE kode='$returno'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]=$returno;
	}
	
	if(sanitasi($_POST["invoiceno_retur"])){
		$invoiceno_retur=$_POST["invoiceno_retur"];
		$sql="SELECT kode FROM trx_pos WHERE kode='$invoiceno_retur'";
		$hsl=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]=$_POST["invoiceno_retur"];
			$modepos="entry";
		}else{
			$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]="";
			?>
				<script language="javascript">
					alert("Maaf, Invoice No <?php echo $invoiceno_retur; ?> tidak terdaftar!");
				</script>
			<?php
		}
	}
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]){$invoiceno_retur=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"];}
	
		
	if(sanitasi($_GET["done"])){
	//if(sanitasi($_POST["done"])){
		
		//cari kode
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$returnobaru="R".date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos_retur WHERE kode='$returnobaru'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$outlet=$_SESSION["outlet"];
		$updateby=$_SESSION["username"];
		$kodetrx="RETURPOS01";
		
		//insert trx_pos_detail	
		$sql="SELECT barcode,qty,disc,harga FROM trx_pos_retur_temp_detail  WHERE kode='$returno'";
		$hsl=mysql_query($sql,$db);
		$seqno=0;
		$totaldisc=0;
		$total_amount=0;
		$pratotal=0;
		while(list($barcode,$qty,$disc,$harga)=mysql_fetch_array($hsl)){
			$seqno++;
			$totaldisc+=$disc;
			$pratotal+=$harga+$qty;
			$total_amount+=($harga-($harga*$disc/100))*$qty;
			$sql="INSERT INTO trx_pos_retur_detail (kode,seqno,barcode,qty,disc,harga) VALUES ('$returnobaru','$seqno','$barcode','$qty','$disc','$harga')";
			mysql_query($sql,$db);
			//insert stok control
			$sql="INSERT INTO outlet_stok_control (mode,tanggal,no_po,no_do,dari,tujuan,kode_produk,qty,satuan,updatedate,updateby) VALUES ";
			$sql.="('2',NOW(),'$returnobaru','$returnobaru','cust','$outlet','$barcode','$qty','pcs',NOW(),'$updateby')";
			mysql_query($sql,$db);
			//penambahan stok
			$sql="UPDATE outlet_stok SET stok=stok+$qty WHERE kode_outlet='$outlet' AND kode_produk='$barcode'";
			mysql_query($sql,$db);
		}
		
		//insert trx_pos
		$sql="INSERT INTO trx_pos_retur (kode,invoiceno,outlet,tanggal,kodetrx,totaldisc,total_amount,updateby,updatedate) VALUES ";
		$sql.="('$returnobaru','$invoiceno_retur','$outlet',NOW(),'$kodetrx','$totaldisc','$total_amount','$updateby',NOW())";
		mysql_query($sql,$db);
		
		//insert acc_transaksi_detail		
		$sql="SELECT posisicoa,coa,posisicoalawan,coalawan FROM acc_template_trx_detail WHERE id='$kodetrx' AND pos='stok'";
		$hsltemp=mysql_query($sql,$db);
		list($posisicoa,$coa,$posisicoalawan,$coalawan)=mysql_fetch_array($hsltemp);
		$sort="1";
		$nominal=$total_amount;
		$tgltrx=date("Y-m-d H:i:s");
		$description="";
		$sql="INSERT INTO acc_transaksi_detail (id,slip,sort,outlet,posisicoa,coa,nominal,tgltrx,description,posisicoalawan,coalawan) VALUES ";
		$sql.=" ('$kodetrx','$returnobaru','$sort','$outlet','$posisicoa','$coa','$nominal','$tgltrx','$description','$posisicoalawan','$coalawan')";
		mysql_query($sql,$db);
		
		$sql="SELECT posisicoa,coa,posisicoalawan,coalawan FROM acc_template_trx_detail WHERE id='$kodetrx' AND pos='amount'";
		$hsltemp=mysql_query($sql,$db);
		list($posisicoa,$coa,$posisicoalawan,$coalawan)=mysql_fetch_array($hsltemp);
		$sort="2";
		$nominal=$total_amount;
		$sql="INSERT INTO acc_transaksi_detail (id,slip,sort,outlet,posisicoa,coa,nominal,tgltrx,description,posisicoalawan,coalawan) VALUES ";
		$sql.=" ('$kodetrx','$returnobaru','$sort','$outlet','$posisicoa','$coa','$nominal','$tgltrx','$description','$posisicoalawan','$coalawan')";
		mysql_query($sql,$db);
		
		$sql="SELECT posisicoa,coa,posisicoalawan,coalawan FROM acc_template_trx_detail WHERE id='$kodetrx' AND pos='disc'";
		$hsltemp=mysql_query($sql,$db);
		list($posisicoa,$coa,$posisicoalawan,$coalawan)=mysql_fetch_array($hsltemp);
		$sort="3";
		$nominal=$totaldisc;
		$sql="INSERT INTO acc_transaksi_detail (id,slip,sort,outlet,posisicoa,coa,nominal,tgltrx,description,posisicoalawan,coalawan) VALUES ";
		$sql.=" ('$kodetrx','$returnobaru','$sort','$outlet','$posisicoa','$coa','$nominal','$tgltrx','$description','$posisicoalawan','$coalawan')";
		mysql_query($sql,$db);
		
		//insert acc_transaksi
		$sql="SELECT nama FROM acc_template_trx WHERE id='$kodetrx'";
		$hsltemp=mysql_query($sql,$db);
		list($namatrx)=mysql_fetch_array($hsltemp);
		
		$sql="INSERT INTO acc_transaksi (id,slip,outlet,nama,tglentry,uid,description) VALUES ";
		$sql.="('$kodetrx','$returnobaru','$outlet','$namatrx',NOW(),'$updateby','$description')";
		mysql_query($sql,$db);			
		?>
			<script language="javascript">
				alert("Retur Tersimpan dengan No Return:<?php echo $returnobaru; ?>!");
			</script>
		<?php
		$sql="UPDATE trx_pos_retur_temp SET status='1' WHERE kode='$returno'";
		mysql_query($sql,$db);
		?>
			<script language="javascript">
				window.location="pos.php";
			</script>
		<?php
	}
	
	//if(sanitasi($_POST["clear"])){
	if(sanitasi($_GET["clear"])){
		$sql="DELETE FROM trx_pos_retur_temp WHERE kode='$returno'";//echo "<br>$sql";
		mysql_query($sql,$db);
		$sql="DELETE FROM trx_pos_retur_temp_detail WHERE kode='$returno'";//echo "<br>$sql";
		mysql_query($sql,$db);
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]="";
		?>
			<script language="javascript">
				window.location="pos.php";
			</script>
		<?php
	}
	
	if(sanitasi($_POST["barcode"]) && sanitasi($_POST["qty"])>0){
		$outlet=$_SESSION["outlet"];
		$barcode=sanitasi($_POST["barcode"]);
		$qty=sanitasi($_POST["qty"]);
		$kodetrx="RETURPOS01";
		$status=0;
		$updateby=$_SESSION["username"];
		//cek barang di trx
		$sql="SELECT barcode,qty FROM trx_pos_detail WHERE barcode='$barcode' AND kode='$invoiceno_retur'";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($barcode_retur,$qty_sudah_dibeli)=mysql_fetch_array($hsltemp);
			if($qty_sudah_dibeli>$qty){
				$sql="DELETE FROM trx_pos_retur_temp WHERE kode='$returno'";//echo "<br>$sql";
				mysql_query($sql,$db);
				$sql="INSERT INTO trx_pos_retur_temp (kode,invoiceno,outlet,tanggal,kodetrx,status,updateby,updatedate) VALUES ('$returno','$invoiceno_retur','$outlet',NOW(),'$kodetrx','$status','$updateby',NOW())";
				mysql_query($sql,$db);//echo "<br>$sql";
				//cari apakah barcode sudah ada
				$sql="SELECT kode FROM trx_pos_retur_temp_detail WHERE kode='$returno' AND barcode='$barcode'";
				mysql_query($sql,$db);//echo "<br>$sql";
				if(mysql_affected_rows($db)<1){
					//cari seqno
					$sql="SELECT seqno FROM trx_pos_retur_temp_detail  WHERE kode='$returno' ORDER BY seqno DESC LIMIT 1";
					$hsltemp=mysql_query($sql,$db);//echo "<br>$sql";
					list($seqno)=mysql_fetch_array($hsltemp);
					$seqno++;
					//cari disc dari trx
					$sql="SELECT harga,disc FROM trx_pos_detail WHERE kode='$invoiceno_retur' AND barcode='$barcode'";
					$hsltemp=mysql_query($sql,$db);
					list($harga,$disc)=mysql_fetch_array($hsltemp);//harga sudah naik secara otomatis untuk markas tertentu
					
					$sql="INSERT INTO trx_pos_retur_temp_detail (kode,seqno,barcode,qty,disc,harga) VALUES ('$returno','$seqno','$barcode','$qty','$disc','$harga')";
					mysql_query($sql,$db);//echo "<br>$sql";
				}else{
					$sql="UPDATE trx_pos_retur_temp_detail SET qty=qty+$qty WHERE kode='$returno' AND barcode='$barcode'";
					mysql_query($sql,$db);//echo "<br>$sql";
				}
			}else{
				?>
					<script language="javascript">
						alert("Maaf, Qty Kode Barang <?php echo $barcode; ?> Salah!");
						window.location="pos_retur.php";
					</script>
				<?php
			}
		}else{
			?>
				<script language="javascript">
					alert("Maaf, Kode Barang <?php echo $barcode; ?> Tidak Ada di Invoice No <?php echo $invoiceno_retur; ?>");
					window.location="pos_retur.php";
				</script>
			<?php
		}
	}
	
	//cari rupiah
	$sql="SELECT qty,disc,harga FROM trx_pos_retur_temp_detail WHERE kode='$returno'";
	$hsl=mysql_query($sql,$db);
	$rupiah=0;
	$qtytot=0;
	$disctot=0;
	while(list($qty,$disc,$harga)=mysql_fetch_array($hsl)){
		$rupiah+=($harga-($harga*$disc/100))*$qty;
		$qtytot+=$qty;
		$disctot+=$disc;
	}
	
	$colorrupiah="green";
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]){
		$modepos="entry";
	}else{
		$modepos="invoiceno_retur";
	}
	
	
?>
	<script language="JavaScript">
		function showProduk(textid,textnama,kodeproduk,idukuran,idsatuan) {
			detailsWindow = window.open("window_produk2.php?textid="+textid+"&textnama="+textnama+"&kodeproduk="+kodeproduk+"&idukuran="+idukuran+"&idsatuan="+idsatuan,"window_produk","width=800,height=600,scrollbars=yes");
			detailsWindow.focus();   
		}
		function pos_keycode(ascii_code,modepos){			
			if(modepos=="invoiceno_retur"){
				if(ascii_code=='13'){//tombol "ENTER" => entry invoice no
					document.getElementById('formposretur').submit();
				}
				if(ascii_code=='35'){//tombol "END" => clear
					document.getElementById('barcode').value="";
					window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?clear=oke";
				}
			}
			if(ascii_code=='35'){//tombol "END" => clear
				document.getElementById('barcode').value="";
				window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?clear=oke";
			}
			if(modepos=="entry"){
				if(ascii_code=='113'){//tombol "F2" => Show Produk
					showProduk('barcode','',document.getElementById('barcode').value,'','');
				}
				if(ascii_code=='115'){//tombol "F4" => invoiceno_retur
					document.getElementById('invoiceno_retur').focus();
				}
				if(ascii_code=='13'){//tombol "ENTER" => entry barang
					document.getElementById('qty').select();
				}
				if(ascii_code=='191'){//tombol "/" => retur selesai
					document.getElementById('barcode').value="";
					window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?done=OKE";
				}
			}
			//alert(ascii_code);			
		}
	</script>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="formposretur">
		<input type="hidden" name="invoiceno" value="<?php echo $invoiceno; ?>">
		<table border="1" width="100%">
			<tr>
				<td id="rupiah" align="right"><font size="15" color="<?php echo $colorrupiah; ?>"><b>Rp. <?php echo number_format(round($rupiah)); ?></b></font></td>
			</tr>
		</table>
		<table border="1" width="100%">
			<tr>
				<td><b>Date : <?php echo date("Y/m/d"); ?></b></td>
				<td><b>Return Number : <?php echo $returno; ?></b></td>
				<td><b>Cashier : <?php echo $_SESSION["username"]; ?></b></td>
			</tr>
		</table>
		<table border="1" width="100%">
			<tr>
				<td><b>Transaksi:</b>
					<select name="kodetrx" onchange="submit();" readonly>
						<?php
							$sql="SELECT id,nama FROM acc_template_trx WHERE id='RETURPOS01' AND mode='pos'";
							$hsltemp=mysql_query($sql,$db);
							list($id,$nama)=mysql_fetch_array($hsltemp);
						?>
							<option value="<?php echo $id; ?>" selected><?php echo $nama; ?></option>
					</select>
				</td>
				<td>
					<b>Invoice No :<b>
					<?php
					//cari maximum limit
					$sql="SELECT `limit` FROM set_limit_retur WHERE id='1'";
					$hsltemp=mysql_query($sql,$db);
					list($limit)=mysql_fetch_array($hsltemp);
					$maxlimitretur=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$limit,date("Y")));
					?>
					<input type="text" id="invoiceno_retur" name="invoiceno_retur" value="<?php echo $_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]; ?>" onkeyup="pos_keycode(event.keyCode,'invoiceno_retur');">
					<!--select id="invoiceno_retur" name="invoiceno_retur" onchange="submit();" onchange="submit();">
						<?php
							$sql="SELECT kode FROM trx_pos WHERE tanggal >= '$maxlimitretur' ORDER BY tanggal DESC";
							$hsltemp=mysql_query($sql,$db);
							while(list($id)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $id; ?>" <?php if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]==$id){echo "selected";} ?>><?php echo $id; ?></option>
						<?php
							}
						?>
					</select-->
				</td>
			</tr>
		<table>
		<table border="1" width="100%">
			<tr>
				<td width="1%" nowrap>
					<b>Barcode</b><input type="text" size="30" XXonclick="showProduk(this.id,'',this.value,'','');" name="barcode" id="barcode" onkeyup="pos_keycode(event.keyCode,'<?php echo $modepos; ?>');"> 
					<b>Qty</b><input type="text" size="3" name="qty" id="qty" onkeyup="if(event.keyCode=='13'){submit();}" value="1">					
					<!--input type="submit" name="ok" value="ok"-->
				</td>
			</tr>
		</table>
		<?php
			$outlet=$_SESSION["outlet"];
			$barcode=sanitasi($_POST["barcode"]);
			$sql="SELECT nama,hargajual FROM produk WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($namaproduk,$harga)=mysql_fetch_array($hsltemp);
			//naikkan harga
			$sql="SELECT id_markas FROM outlet WHERE id='$outlet'";
			$hsltemp=mysql_query($sql,$db);
			list($id_markas)=mysql_fetch_array($hsltemp);
			$harga=naikkanharga($harga,$barcode,$id_markas);
			$sql="SELECT disc FROM trx_pos_temp_detail WHERE kode='$invoiceno' AND barcode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($disc)=mysql_fetch_array($hsltemp);
			$subtotal=$harga-($harga*$disc/100);
			
		?>
		<table border="1" width="100%">
			<tr>
				<td><input name="viewbarcode" type="text" value="<?php echo sanitasi($_POST["barcode"]);?>"></td>
				<td><input name="viewnama" type="text" value="<?php echo $namaproduk;?>" size="80"></td>
				<td ><input name="viewharga" type="text" value="<?php echo $harga;?>" readonly></td>
				<td nowrap><input name="viewdisc" type="text" value="<?php echo $disc;?>" size="3">%</td>
				<td><input name="viewtotal" type="text" value="<?php echo $subtotal;?>" readonly></td>
			</tr>
		</table>
		<table border="1" width="100%">			
			<b>Barang Retur : </b><br>
			<iframe width="100%" height="150" src="pos_retur_detail.php?kode=<?php echo $_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]; ?>"></iframe>
			<b>Barang Terbeli : </b><br>
			<iframe width="100%" height="150" src="pos_terbeli_detail.php?kode=<?php echo $_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]; ?>"></iframe>
		</table>
		<table border="1" width="100%">
			<tr>				
				<td align="right">
					<input type="button" name="clear" value="Cancel [END]" onclick="pos_keycode('35','entry');">
					<input type="button" name="done" value="Done [/]" onclick="pos_keycode('191','entry');">
				</td>
			</tr>
		</table>
	</form>	
	<table border="1" width="100%">
		<tr>
			<td><b>[Enter] </b>Entry Invoice/Produk/Qty</td>
			<td><b>[/] </b>Done</td>
			<td><b>[End] </b>Clear</td>
			<td><b>[F2] </b>Lihat Produk</td>
			<td><b>[F4] </b>Invoice Number</td>
		</tr>
	</table>
<?php include_once "footer_window_content.php"; ?>
<?php
	if(!$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]){
?>
	<script language="javascript">
		document.getElementById("invoiceno_retur").focus();
	</script>
<?php
	} else {
?>
	<script language="javascript">
		document.getElementById("barcode").focus();
	</script>
<?php
	}
?>
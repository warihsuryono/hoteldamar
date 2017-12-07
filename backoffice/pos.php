<?php
	//warih hadi suryono
	include_once "connect.php";
	include_once "func.openwin.php";
	// echo "<pre>";
		// print_r($_POST);
	// echo "</pre>";
	$_SESSION["outlet"]="999";
	$nama_outlet="Hotel Damar Store";
	$content_title="POS [$nama_outlet] (".$_SESSION["outlet"].")";
	$tanggal=$_REQUEST["tanggal"];
	if(!$tanggal){$tanggal=date("Y-m-d");}else{$tanggal=$_REQUEST["tanggal"];}
	$tanggaltime=$tanggal." ".date("H:i:s");
	$_width="width='100%'";
	include "header_window_content.php";
	if(sanitasi($_GET["reloaddelay"])){
		$delayid=sanitasi($_GET["delayid"]);
		$sql="SELECT invoiceno,session,post FROM pos_delay WHERE kode='$delayid'";
		$hsltemp=mysql_query($sql,$db);
		list($invoiceno,$arrsession,$arrpost)=mysql_fetch_array($hsltemp);
		$_SESSION["pos"]=unserialize(base64_decode($arrsession));
		$_POST=unserialize(base64_decode($arrpost));
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"]=$invoiceno;
	}
	if(!$_SESSION["username"]){$_SESSION["username"]="user_tester";}
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"]!=""){
		$invoiceno=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"];
	}else{
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$invoiceno=date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos_temp WHERE kode='$invoiceno'";
			mysql_query($sql,$db);
			//echo "<br>".$sql;
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"]=$invoiceno;
		$sql="INSERT INTO trx_pos_temp (kode,customer,outlet,tanggal,kodetrx,status,updateby,updatedate) VALUES ";
		$sql.="('$invoiceno','$customer','".$_SESSION["outlet"]."','$tanggaltime','','0','".$_SESSION["username"]."','$tanggaltime')";
		mysql_query($sql,$db);//echo "<br>$sql";
	}
			
	
	if(sanitasi($_GET["changeqty"])){
		$barcodetochange=sanitasi($_GET["barcodetochange"]);
		$qtytochange=sanitasi($_GET["qtytochange"]);
		//echo "$barcodetochange change to $qtytochange";
		$sql="UPDATE trx_pos_temp_detail SET qty='$qtytochange' WHERE kode='$invoiceno' AND barcode='$barcodetochange'";
		mysql_query($sql,$db);
		$_POST["membertype"]=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"];
	}
	if(sanitasi($_GET["deleteproduk"])){
		$barcodetodelete=sanitasi($_GET["barcodetodelete"]);
		//echo "$barcodetodelete delete";
		$sql="DELETE FROM trx_pos_temp_detail WHERE kode='$invoiceno' AND barcode='$barcodetodelete'";
		mysql_query($sql,$db);
		$_POST["membertype"]=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"];
	}
	if(sanitasi($_GET["done"])){
		$returno=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"];
		$jumlahpembayaran=sanitasi($_GET["jumlahpembayaran"]);
		$jenis_bayar=sanitasi($_GET["jenis_bayar"]);
		$coabank=sanitasi($_GET["coabank"]);
		$cardno=sanitasi($_GET["cardno"]);
		//cari kode
		
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$invoicenobaru=date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos WHERE kode='$invoicenobaru'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$outlet=$_SESSION["outlet"];
		$updateby=$_SESSION["username"];
		$kodetrx=sanitasi($_POST["kodetrx"]);
		$kodetrx=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kodetrx"];
		$sql="INSERT INTO trx_pos_temp (kode,customer,outlet,tanggal,kodetrx,status,updateby,updatedate) VALUES ";
		$sql.="('$invoiceno','$customer','".$_SESSION["outlet"]."','$tanggal','$kodetrx','0','".$_SESSION["username"]."','$tanggaltime')";
		mysql_query($sql,$db);//echo "<br>$sql";
		
		//insert trx_pos_detail	
		$sql="SELECT barcode,qty,disc,harga FROM trx_pos_temp_detail  WHERE kode='$invoiceno'";
		$hsl=mysql_query($sql,$db);
		$seqno=0;
		$totaldisc=0;
		$total_amount=0;
		$pratotal=0;
		$disctot=0;
		while(list($barcode,$qty,$disc,$harga)=mysql_fetch_array($hsl)){
			$seqno++;
			$totaldisc=$disc;
			$pratotal+=$harga*$qty;
			$total_amount+=($harga-($harga*$disc/100))*$qty;
			$disctot+=($harga*$disc/100)*$qty;
			$sql="INSERT INTO trx_pos_detail (kode,seqno,barcode,qty,disc,harga) VALUES ('$invoicenobaru','$seqno','$barcode','$qty','$disc','$harga')";
			mysql_query($sql,$db);
			//echo "<br>".$sql;
			//insert stok control
			$sql="INSERT INTO logistik_hist_stok (in_out,histdate,modulfilename,pono,sourcetype,sourceid,desttype,destid,kodebarang,qty,satuan,createby,createdate) VALUES ";
			$sql.="('2','$tanggal','pos.php','$invoicenobaru','gudang','','customer','','$barcode','$qty','pcs','$updateby','$tanggaltime')";
			mysql_query($sql,$db);
			//pengurangan stok
			$sql="SELECT seqno FROM logistik_stok WHERE branchtype='gudang' AND kodebarang='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				$sql="UPDATE logistik_stok SET stock=stock-$qty WHERE branchtype='gudang' AND kodebarang='$barcode'";
			}else{
				$qty_1=$qty*-1;
				$sql="INSERT INTO logistik_stok (branchtype,kodebarang,stock,createby,createdate) VALUES ";
				$sql="('gudang','$barcode','$qty_1','$updateby','$tanggaltime')";
			}
			mysql_query($sql,$db);
		}
		$total_amount=$total_amount;
		
		//insert trx_pos
		$sql="INSERT INTO trx_pos (kode,returno,customer,outlet,tanggal,kodetrx,disc_member,disc_special,totaldisc,total_amount,pembayaran,jenis_bayar,cardno,updateby,updatedate) VALUES ";
		$sql.="('$invoicenobaru','$returno','$customer','$outlet','$tanggal','$kodetrx','$disc_member','$disc_special','$totaldisc','$total_amount','$jumlahpembayaran','$jenis_bayar','$cardno','$updateby','$tanggaltime')";
		mysql_query($sql,$db);
		//echo "<br>".$sql;
		
		//insert jurnal
		$kodejurnal="JURNAL/".date("ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		$notes="POS $invoicenobaru";
		//INSERT ACCOUNTING			
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','$vendor','$notes','$createby','$tanggaltime','$actionlink')";
		mysql_query($sql,$db);			
		//echo "<br>$sql => ".mysql_error();
		$sql="SELECT barcode,qty,harga FROM trx_pos_detail WHERE kode='$invoicenobaru'";
		$hsldet=mysql_query($sql,$db);
		$subtotal1=0;
		$seqno=-1;
		while(list($barcode,$qty,$harsat)=mysql_fetch_array($hsldet)){
			$seqno++;
			$sql="SELECT nama FROM mst_material_part WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$sql="SELECT coa FROM acc_setting_coa WHERE id='15'";//Pendapatan Toko
			$hsltemp=mysql_query($sql,$db);
			list($coa)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$kredit=$qty*$harsat;
			$subtotal1+=$kredit;
			
			$debit=0;
			$keterangan="$namabarang ($qty X)";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
		}
		$seqno++;
		// echo "<pre>";
			// print_r($_GET);
		// echo "</pre>";
		if($_GET["jenis_bayar"]=="01" || !$_GET["jenis_bayar"]){
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";//KAS			
			$hsltemp=mysql_query($sql,$db);
			list($coa)=mysql_fetch_array($hsltemp);
		}else{
			$coa=$_GET["coabank"];//BANK	
		}
		
		$keterangan="POS $invoicenobaru";
		
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$debit=$subtotal1;
		
		$kredit=0;
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa','$koder','$keterangan','$debit','$kredit')";
		mysql_query($sql,$db);
		//echo "<br>$sql => ".mysql_error();
		
		
		
		?>
			<script language="javascript">
				//alert("Transaksi Tersimpan!");
				window.open("pos_faktur.php?kode=<?php echo $invoicenobaru; ?>","pos_faktur","width=350,height=500,menubar=yes,scrollbars=yes");
			</script>
		<?php
		$sql="UPDATE trx_pos_temp SET status='1' WHERE kode='$invoiceno'";
		mysql_query($sql,$db);
		
		//cari invoiceno baru
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$invoiceno=date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos_temp WHERE kode='$invoiceno'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"]=$invoiceno;
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["disc_event"]=0;
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["name_event"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]="";
		$_GET["jumlahpembayaran"]="";
	}
	
	if(sanitasi($_GET["delay"])=="oke"){
		$arrsession=base64_encode(serialize($_SESSION["pos"]));
		$arrpost=base64_encode(serialize($_POST));
		$kode=date("Ymd_His");
		$session=$arrsession;
		$post=$arrpost;
		$updateby=$_SESSION["username"];
		$nominal=sanitasi($_GET["nominal"]);
		$sql="INSERT INTO pos_delay (kode,invoiceno,session,post,nominal,updateby,updatedate) VALUES ('$kode','$invoiceno','$session','$post','$nominal','$updateby',NOW())";
		mysql_query($sql,$db);
		$sql="UPDATE trx_pos_temp SET status='2' WHERE kode='$invoiceno'";
		mysql_query($sql,$db);
		$_GET["clear"]="oke";
		//cari no baru
		$looping=true;
		$no=0;
		while($looping){
			$no++;			
			$invoiceno=date("ymd").substr("000",0,3-strlen($no)).$no;
			$sql="SELECT kode FROM trx_pos_temp WHERE kode='$invoiceno'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)<1){$looping=false;}
		}
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno"]=$invoiceno;
	}
	if(sanitasi($_GET["clear"])){
		$sql="DELETE FROM trx_pos_temp WHERE kode='$invoiceno'";//echo "<br>$sql";
		mysql_query($sql,$db);
		$sql="DELETE FROM trx_pos_temp_detail WHERE kode='$invoiceno'";//echo "<br>$sql";
		mysql_query($sql,$db);
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["disc_event"]=0;
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["name_event"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["invoiceno_retur"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]="";
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]="";
	}
	if(sanitasi($_POST["barcode"]) && sanitasi($_POST["qty"])>0){
		$outlet=$_SESSION["outlet"];
		$barcode=sanitasi($_POST["barcode"]);
		$qty=sanitasi($_POST["qty"]);
		$kodetrx=sanitasi($_POST["kodetrx"]);
		$updateby=$_SESSION["username"];
		$sql="SELECT sum(qty) FROM trx_pos_temp_detail WHERE kode='$invoiceno'";
		$hsltemp=mysql_query($sql,$db);
		list($qtyygsudahdientry)=mysql_fetch_array($hsltemp);
		$sql="SELECT stok FROM outlet_stok WHERE kode_outlet='$outlet' AND kode_produk='$barcode'";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0 || true){//ada kode produk di outlet tsb
			list($stokprodukoutlet)=mysql_fetch_array($hsltemp);
			//$stokprodukoutlet=1000;
			if($stokprodukoutlet>=$qty+$qtyygsudahdientry || true){//stok lebih besar dan sama dengan qty
				$sql="DELETE FROM trx_pos_temp WHERE kode='$invoiceno'";//echo "<br>$sql";
				mysql_query($sql,$db);
				$status=0;
				$sql="INSERT INTO trx_pos_temp (kode,customer,outlet,tanggal,kodetrx,status,updateby,updatedate) VALUES ('$invoiceno','$customer','$outlet',NOW(),'$kodetrx','$status','$updateby',NOW())";
				mysql_query($sql,$db);//echo "<br>$sql";
				
				$sql="SELECT kode FROM trx_pos_temp_detail WHERE kode='$invoiceno' AND barcode='$barcode'";
				mysql_query($sql,$db);//echo "<br>$sql";
				if(mysql_affected_rows($db)<1){
					//cari seqno
					$sql="SELECT seqno FROM trx_pos_temp_detail  WHERE kode='$invoiceno' ORDER BY seqno DESC LIMIT 1";
					$hsltemp=mysql_query($sql,$db);//echo "<br>$sql";
					list($seqno)=mysql_fetch_array($hsltemp);
					$seqno++;
					//cari disc 
					$disc=0;
					if(!$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"]){
						$tglsekarang=date("Y-m-d");
						$jamsekarang=date("H:i:s");
						$sql="SELECT kode,nama,disc FROM event_promo WHERE awal<='$tglsekarang' AND akhir>='$tglsekarang' AND jamawal<='$jamsekarang' AND jamakhir>='$jamsekarang' AND (outlet='' OR outlet='$outlet') AND approved='1' ORDER BY approvedate DESC LIMIT 1";
						//echo $sql;
						$hslevent=mysql_query($sql,$db);
						list($kode_event,$event,$disc)=mysql_fetch_array($hslevent);
						$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"]=$kode_event;
						$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["disc_event"]=$disc;
						$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["name_event"]=$event;
					}else{
						$kode_event=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"];
						$disc=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["disc_event"];
						$event=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["name_event"];
					}
					//$disc=disc_produk_event($kode_event,$barcode);					
					$disc=0;
					//$disc_event=disc_produk_event($kode_event,$barcode);
					$disc_event=0;
					
					$sql="SELECT harga FROM mst_harga_toko WHERE kode='$barcode'";
					$hsltemp=mysql_query($sql,$db);//echo "<br>$sql";
					list($harga)=mysql_fetch_array($hsltemp);
					
					
					$sql="INSERT INTO trx_pos_temp_detail (kode,seqno,barcode,qty,disc,harga) VALUES ('$invoiceno','$seqno','$barcode','$qty','$disc','$harga')";
					mysql_query($sql,$db);//echo "<br>$sql";
				}else{
					$sql="UPDATE trx_pos_temp_detail SET qty=qty+$qty WHERE kode='$invoiceno' AND barcode='$barcode'";
					mysql_query($sql,$db);//echo "<br>$sql";
				}
			}else{
				?>
					<script language="javascript">
						alert("Stok Habis!");
					</script>
				<?php
			}
		}
	}
	
	//cari rupiah	
	$sql="SELECT qty,disc,harga FROM trx_pos_temp_detail WHERE kode='$invoiceno'";
	$hsl=mysql_query($sql,$db);
	$rupiah=0;
	$qtytot=0;
	$disctot=0;
	$_total=0;
	$penambah_disc=0;
	while(list($qty,$disc,$harga)=mysql_fetch_array($hsl)){
		$_total+=$harga*$qty;
		$rupiah+=($harga-($harga*$disc/100))*$qty;
		$qtytot+=$qty;
		$disctot+=($harga*$disc/100)*$qty;
	}
	
	//apakah disc member berlaku pada saat event\
	$penambah_disc=0;
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kode_event"]){ //ada event
		if($inc_event){//disc member berlaku pada saat event
			//cari range disc
			$sql="SELECT disc FROM customer_disc WHERE id='$typemember' AND min<='$_total' AND max>='$_total'";
			$hsl=mysql_query($sql,$db);
			list($disc_member)=mysql_fetch_array($hsl);
			$penambah_disc=$disc_member+$disc_special;
		}
	}else{
		$sql="SELECT disc FROM customer_disc WHERE id='$typemember' AND min<='$_total' AND max>='$_total'";
		$hsl=mysql_query($sql,$db);
		list($disc_member)=mysql_fetch_array($hsl);
		$penambah_disc=$disc_member+$disc_special;
	}
	
	//perhitungan discount
	$outlet=$_SESSION["outlet"];		
	$tglsekarang=date("Y-m-d");
	$jamsekarang=date("H:i:s");
	$sql="SELECT kode,nama,disc FROM event_promo WHERE awal<='$tglsekarang' AND akhir>='$tglsekarang' AND jamawal<='$jamsekarang' AND jamakhir>='$jamsekarang' AND (outlet='' OR outlet='$outlet') AND approved='1' ORDER BY approvedate DESC LIMIT 1";
	$hslevent=mysql_query($sql,$db);
	list($kode_event,$_event,$_discevent)=mysql_fetch_array($hslevent);
	$sql="SELECT barcode FROM trx_pos_temp_detail WHERE kode='$invoiceno'";
	//echo "<br>".$sql;
	$hsltempdet=mysql_query($sql,$db);
	while(list($_barcode)=mysql_fetch_array($hsltempdet)){		
		//$_disc=disc_produk_event($kode_event,$_barcode);
		$_disc=0;
		//echo "disc_produk_event($kode_event,$_barcode)";
		$sql="SELECT disc FROM trx_pos_temp_detail WHERE kode='$invoiceno' AND barcode='$_barcode'";
		$_hsltemp=mysql_query($sql,$db);
		list($_disc_sebelumnya)=mysql_fetch_array($_hsltemp);
		if($_disc_sebelumnya<$_disc){
			$sql="UPDATE trx_pos_temp_detail SET disc='$_disc' WHERE kode='$invoiceno' AND barcode='$_barcode'";
			//echo "<br>".$sql;
			mysql_query($sql,$db);
		}
	}
	if($disc_member>$_discevent){
		$tot_disc_umum=$disc_member;
	}else{
		$tot_disc_umum=$_discevent;
	}
	
	if(sanitasi($_GET["changedisc"])){
		$barcodetochange=sanitasi($_GET["barcodetochange"]);
		$disctochange=sanitasi($_GET["disctochange"]);
		if($_disc_sebelumnya<$disctochange){
			$sql="UPDATE trx_pos_temp_detail SET disc='$disctochange' WHERE kode='$invoiceno' AND barcode='$barcodetochange'";
		}else{
			$sql="UPDATE trx_pos_temp_detail SET disc='$_disc_sebelumnya' WHERE kode='$invoiceno' AND barcode='$barcodetochange'";
		}
		mysql_query($sql,$db);
		$_POST["membertype"]=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"];
	}
	
	//echo "$tot_disc_umum;$disc_member;$_discevent";
	if($disc_member>0){//ada disc member
		$sql="UPDATE trx_pos_temp_detail SET disc='$tot_disc_umum' WHERE disc<'$tot_disc_umum' AND kode='$invoiceno'";
	}else{//tidak ada disc member
		$sql="UPDATE trx_pos_temp_detail SET disc='$tot_disc_umum' WHERE disc<'$tot_disc_umum' AND disc>=0 AND kode='$invoiceno'";
	}
	//echo "<br>".$sql;
	mysql_query($sql,$db);
	
	$sql="SELECT barcode,qty,disc,harga FROM trx_pos_temp_detail WHERE kode='$invoiceno'";
	$hsltempdet=mysql_query($sql,$db);
	$_tot_disc_rp=0;
	while(list($_barcode,$_qty,$_disc,$_harga)=mysql_fetch_array($hsltempdet)){
		$_tempdisc=($_harga*$_qty)*$_disc/100;
		$_tot_disc_rp+=$_tempdisc;
		//echo "<br>$_tempdisc=($_harga*$_qty)*$_disc/100;";
	}
	//$rupiah=$rupiah-$tot_disc_member;
	$rupiah=$_total-$_tot_disc_rp;
	 
	
	if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]){
		$moderetur="1";
		$returno=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"];
		$sql="SELECT invoiceno,total_amount FROM trx_pos_retur WHERE kode='$returno'";
		$hsltemp=mysql_query($sql,$db);
		list($invoiceno_retur,$nilai_retur)=mysql_fetch_array($hsltemp);
		$sql="SELECT sum(qty) FROM trx_pos_retur_detail WHERE kode='$returno'";
		$hsltemp=mysql_query($sql,$db);
		list($qty_retur)=mysql_fetch_array($hsltemp);
		$rupiah-=$nilai_retur;
	}	
	$colorrupiah="green";
	$modepos="entry";
	if(sanitasi($_GET["kembalimodeentry"])=='OKE'){
		$_POST["membertype"]=$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"];
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["prosesbayar"]="";
		$_GET["prosesbayar"]="";
	}
	
	if(sanitasi($_GET["prosesbayar"])=='oke'){
		$modepos="bayar";
		$colorrupiah="red";
		$jumlahpembayaran=sanitasi($_GET["jumlahpembayaran"]);
		$rupiah=$jumlahpembayaran-$rupiah;
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["prosesbayar"]="oke";
	}
	
	if(sanitasi($_POST["kodetrx"])){$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["kodetrx"]=sanitasi($_POST["kodetrx"]);}
	if(sanitasi($_POST["membertype"])){$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]=sanitasi($_POST["membertype"]);}
	if(!sanitasi($_POST["membertype"])){$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]="";$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]="";$_POST["idmember"]="";}
	if(sanitasi($_POST["idmember"])){$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]=sanitasi($_POST["idmember"]);}
	if(sanitasi($_GET["get_membertype"])){
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]=sanitasi($_GET["get_membertype"]);
		$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]=sanitasi($_GET["get_idmember"]);
	}
?>
	<script language="JavaScript">
		function showProduk(textid,textnama,kodeproduk,idukuran,idsatuan) {
			detailsWindow = window.open("window_produk2.php?textid="+textid+"&textnama="+textnama+"&kodeproduk="+kodeproduk+"&idukuran="+idukuran+"&idsatuan="+idsatuan,"window_produk","width=800,height=600,scrollbars=yes");
			detailsWindow.focus(); 
		}
		function pos_keycode_disc(ascii_code,barcode,disc){
			if(ascii_code=='13'){//tombol "ENTER" => ubah disc barang
				//document.getElementById('discounttext').style.visibility='visible';
				window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&changedisc=OKE&barcodetochange="+barcode+"&disctochange="+disc;
			}
		}
		<?php
			//if($modepos=="bayar"){
		?>
		function pos_keycode_qty(ascii_code,barcode,qty){
			if(ascii_code=='13'){//tombol "ENTER" => entry barang
				document.getElementById('formpos').submit();
			}
			if(ascii_code=='17'){//tombol "CTRL" => ubah qty produk
				window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&changeqty=OKE&barcodetochange="+barcode+"&qtytochange="+qty;
			}
			if(ascii_code=='19'){//tombol "PAUSE" => Hapus Produk
				window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&deleteproduk=OKE&barcodetodelete="+barcode;
			}			
			if(ascii_code=='123'){//tombol "F12" => Show Disc Text
				document.getElementById('discounttext').style.visibility='visible';
				document.getElementById('disc_txt').select();
			}
		}
		<?php
			//}
		?>
		function pos_keycode(ascii_code,modepos){
			//alert(ascii_code);
			if(modepos=="entry"){
				if(ascii_code=='113'){//tombol "F2" => Show Produk
					showProduk('barcode','',document.getElementById('barcode').value,'','');
				}
				if(ascii_code=='115'){//tombol "F4" => Jenis Transaksi
					document.getElementById('kodetrx').focus();
				}
				if(ascii_code=='119'){//tombol "F8" => Jenis Member
					document.getElementById('membertype').focus();
				}
				if(ascii_code=='120'){//tombol "F9" => Member Id
					document.getElementById('idmember').focus();
				}
				if(ascii_code=='13'){//tombol "ENTER" => entry barang
					document.getElementById('qty').select();
					document.getElementById('formpos').submit();
				}
				if(ascii_code=='191'){//tombol "/" => pembayaran
					<?php
						if($rupiah>0 || ($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"] && $rupiah>=0)){
					?>
						document.getElementById('barcode').value="";
						// var jumlahpembayaran=prompt("Jumlah Pembayaran (Rp) :");
						// if(jumlahpembayaran>0){window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?jumlahpembayaran="+jumlahpembayaran;}
						document.getElementById('win_bayar').style.visibility='visible';
						document.getElementById('jumlahpembayaran').select();
					<?php
						}else{
					?>
						alert("Maaf, Jumlah Pembelian Harus Di Atas Rp. 0,-");
						window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>";
					<?php
						}
					?>
				}
				if(ascii_code=='35'){//tombol "END" => clear
					document.getElementById('barcode').value="";
					window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&clear=oke";
					// if(confirm("Anda Yakin menghapus Transaksi Ini?")){
						// window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?clear=oke";
					// }
				}
				if(ascii_code=='123'){//tombol "F12" => Show Disc Text
					document.getElementById('discounttext').style.visibility='visible';
					document.getElementById('disc_txt').select();
				}
				<?php
					if(!$_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]){
				?>
				if(ascii_code=='34'){//tombol "PAGE DOWN" => RETUR
					window.location="pos_retur.php";
				}
				
				if(ascii_code=='19'){//tombol "PAUSE" => DELAY
					if(confirm("Anda Yakin Delay Transaksi Ini?")){
						window.location="<?php echo $_SERVER["PHP_SELF"];?>?tanggal=<?php echo $tanggal; ?>&delay=oke&nominal=<?php echo $rupiah; ?>";
					}
				}
				if(ascii_code=='36'){//tombol "HOME" => RELOAD DELAYED
					window.location="<?php echo $_SERVER["PHP_SELF"];?>?tanggal=<?php echo $tanggal; ?>&reloadlist=oke";
				}
				<?php
					}
				?>
			}
			if(modepos=="reloaddelay"){
				if(ascii_code=='13'){
					window.location="<?php echo $_SERVER["PHP_SELF"];?>?tanggal=<?php echo $tanggal; ?>&reloaddelay=oke&delayid="+document.getElementById('delay').value;
				}
			}
			if(modepos=="bayar"){
				document.getElementById('barcode').value="";
				if(ascii_code=='27'){//tombol "ESC"
					window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&kembalimodeentry=OKE";
				}
				if(ascii_code=='17'){//tombol "CTRL"
					window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&done=OKE&jumlahpembayaran=<?php echo sanitasi ($_GET["jumlahpembayaran"]);?>&jenis_bayar=<?php echo sanitasi ($_GET["jenis_bayar"]);?>&coabank=<?php echo sanitasi ($_GET["coabank"]);?>&cardno=<?php echo sanitasi ($_GET["cardno"]);?>";
				}
			}
			//alert(ascii_code);
			
		}
	</script>
	
	
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="formpos">
		<input type="hidden" name="invoiceno" value="<?php echo $invoiceno; ?>">
		<table border="1" width="100%">
			<tr>
				<td id="rupiah" align="right"><font size="15" color="<?php echo $colorrupiah; ?>"><b>Rp. <?php echo number_format($rupiah); ?></b></font></td>
			</tr>
		</table>
		<table border="1" width="100%">
			<tr>
				<td><b>Date : </b>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
				<td><b>Invoice Number : <?php echo $invoiceno; ?></b></td>
				<td><b>Cashier : <?php echo $_SESSION["username"]; ?></b></td>
			</tr>
		</table>
		<?php
			if($_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["returno"]){
		?>
			<table border="1" width="100%">
				<tr>
					<td><b>Return No:<?php echo $returno; ?></b></td>
					<td><b>Invoice Return No:<?php echo $invoiceno_retur; ?></b></td>
					<td><b>Qty Return:<?php echo number_format($qty_retur); ?></b></td>
					<td><b>Total Return:<?php echo "Rp. ".number_format($nilai_retur,2,",","."); ?></b></td>
				</tr>
			</table>
		<?php
			}
		?>
		<table border="1" width="100%">
			<tr>
				<td width="1%" nowrap>
					<b>Barcode</b><input type="text" size="30" name="barcode" id="barcode" onkeyup="pos_keycode(event.keyCode,'<?php echo $modepos; ?>');" tabindex="4"> 
					<!--b>Qty</b><input type="text" size="3" name="qty" id="qty" onkeyup="if(event.keyCode=='13'){submit();}" value="1"-->
					<b>Qty</b><input type="text" size="3" name="qty" id="qty" onkeyup="pos_keycode_qty(event.keyCode,document.getElementById('barcode').value,this.value);" value="1" tabindex="5">
					<div style="solid; visibility:hidden;" id="discounttext">
						<b>Disc</b><input type="text" size="3" name="disc_txt" id="disc_txt" onkeyup="pos_keycode_disc(event.keyCode,document.getElementById('barcode').value,this.value);" value="<?php echo $disctext; ?>" tabindex="6">
					</div>
					<!--input type="submit" name="ok" value="ok"-->
				</td>
				<?php					
					if(sanitasi($_GET["reloadlist"])=="oke"){
				?>
					<td width="1%" nowrap>
						<select name="delay" id="delay" onkeyup="pos_keycode(event.keyCode,'reloaddelay');">
							<option value="">-Delay Id-</option>
							<?php
								$sql="SELECT kode,nominal FROM pos_delay WHERE kode LIKE '".date("Ymd")."_%' AND invoiceno IN (SELECT kode FROM trx_pos_temp WHERE status='2')";
								$hsltemp=mysql_query($sql,$db);
								while(list($id,$nominal)=mysql_fetch_array($hsltemp)){
							?>
								<option value="<?php echo $id; ?>"><?php echo "$id [Rp. ".number_format(round($nominal))."]"; ?></option>
							<?php
								}
							?>
						</select>
					</td>
				<?php				
					}
				?>
			</tr>
		</table>
		<?php //exit; ?>
		<?php
			$barcode=sanitasi($_POST["barcode"]);
			$sql="SELECT nama,hargajual FROM produk WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($namaproduk,$harga)=mysql_fetch_array($hsltemp);
			$sql="SELECT disc FROM trx_pos_temp_detail WHERE kode='$invoiceno' AND barcode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($disc)=mysql_fetch_array($hsltemp);
			$subtotal=$harga-($harga*$disc/100);
			
		?>				
		<div style="top:200px;left:300px;solid; position:absolute;visibility:hidden;" id="win_bayar">
			<?php $content_title="Pembayaran"; ?>
			<?php $_width="width='50%'"; ?>
			<?php include "header_window_content.php";?>
				<script language="javascript">
					function proses_pembayaran(jumlahpembayaran,jenis_bayar,coabank,cardno,moderetur){
						if(jumlahpembayaran>0 || (moderetur=='1' && jumlahpembayaran>=0)){
							window.location="<?php echo $_SERVER["PHP_SELF"]; ?>?tanggal=<?php echo $tanggal; ?>&jumlahpembayaran="+jumlahpembayaran+"&jenis_bayar="+jenis_bayar+"&coabank="+coabank+"&cardno="+cardno+"&prosesbayar=oke&get_idmember=<?php echo $_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["idmember"]; ?>&get_membertype=<?php echo $_SESSION["pos"][$_SESSION["username"]][$_SESSION["outlet"]]["membertype"]; ?>";
						}
					}
				</script>
				<table>		
					<tr>
						<td nowrap><b>Jumlah Pembayaran</b></td>
						<td><b>:</b></td>
						<td><input type="text" id="jumlahpembayaran" name="jumlahpembayaran" size="20" tabindex="7" value="<?php echo $rupiah; ?>" onkeyup="if(event.keyCode=='13'){document.getElementById('jenis_bayar').focus();}"></td>
					</tr>
					<tr>
						<td nowrap><b>Jenis Pembayaran</b></td>
						<td><b>:</b></td>
						<td>
							<select id="jenis_bayar" name="jenis_bayar" tabindex="8" onkeyup="if(event.keyCode=='13'){document.getElementById('coabank').focus();}">
								<?php
									$sql="SELECT kode,description FROM mst_pay_type ORDER BY kode";
									$hsltemp=mysql_query($sql,$db);
									while(list($id,$carabayar)=mysql_fetch_array($hsltemp)){
								?>
									<option value="<?php echo $id; ?>"><?php echo $carabayar; ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td nowrap><b>Bank</b></td>
						<td><b>:</b></td>
						<td>
							<select name="coabank" id="coabank" tabindex="9" onkeyup="if(event.keyCode=='13'){document.getElementById('cardno').focus();}">
								<option value="">-Pilih Bank-</option>
								<?php
									$sql="SELECT coa,description FROM acc_mst_coa WHERE koder='AKTIVA LANCAR' AND description LIKE '%bank%' ORDER BY description";
									$hsltemp=mysql_query($sql,$db);
									while(list($_kode,$description)=mysql_fetch_array($hsltemp)){
								?>
									<option value="<?php echo $_kode; ?>"><?php echo $description; ?></option>
								<?php
									}
								?>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td nowrap><b>Card No / Rek No</b></td>
						<td><b>:</b></td>
						<td><input type="text" id="cardno" name="cardno" size="30" tabindex="9" onkeyup="if(event.keyCode=='13'){document.getElementById('btn_bayar').focus();}"></td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<input tabindex="10" type="button" id="btn_bayar" name="bayar" value="Bayar" onclick="proses_pembayaran(document.getElementById('jumlahpembayaran').value,document.getElementById('jenis_bayar').value,document.getElementById('coabank').value,document.getElementById('cardno').value,'<?php echo $moderetur; ?>');">
							<input tabindex="11" type="button" name="cancel" value="Cancel" onclick="document.getElementById('win_bayar').style.visibility='hidden';document.getElementById('barcode').focus();">
						</td>
					</tr>
				</table>
			<?php include "footer_window_content.php";?>
		</div>
		<table border="1" width="100%">	
			<iframe width="100%" height="300" src="pos_detail.php?kode=<?php echo $invoiceno; ?>&discmember=<?php echo $disc_member_det; ?>"></iframe>
		</table>
		<table border="1" width="100%">
			<tr>
				<td>
					<table>
						<tr>
							<td><b>Amount</b><td>
							<td><b>Rp.</b></td>
							<td align="right"><?php echo number_format(round($rupiah)); ?><td>
							<td><b>Qty Tot</b><td>
							<td><b>&nbsp;</b></td>
							<td align="right"><?php echo number_format($qtytot); ?><td>
						</tr>
						<!--tr>							
							<td><b>Disc Member</b><td>
							<td><b>&nbsp;</b></td>
							<td align="right"><?php echo number_format($disc_member); ?> %<td>				
							<td><b>Disc tot</b><td>
							<td><b>Rp.</b></td>
							<td align="right"><?php echo number_format(round($disctot)); ?><td>
						</tr-->
					</table>
				</td>
				<td>&nbsp;
					<!--input type="button" name="clear" value="Clear [END]" onclick="pos_keycode('35','entry');">
					<input type="button" name="done" value="Done [/]" onclick="pos_keycode('191','entry');"-->
				</td>
			</tr>
		</table>
	</form>
	<table border="1" width="100%">
		<tr>
			<td width="1%" nowrap rowspan="2"><b>Cursor Fokus Pada Barcode : </b></td>
			<td nowrap><b>[Enter] </b>Entry Produk</td>
			<td nowrap><b>[/] </b>Done</td>
			<td nowrap><b>[End] </b>Clear</td>
			<td nowrap><b>[PgDn] </b>Retur</td>
			<td nowrap><b>[Ctrl] </b>Pembayaran</td>
			<td nowrap><b>[F2] </b>Lihat Produk</td>
		</tr>
		<tr>
			<td nowrap><b>[F4] </b>Jenis Transaksi</td>
			<td nowrap><b>[F8] </b>Jenis Member</td>
			<td nowrap><b>[F9] </b>Member Id</td>
			<td nowrap><b>[Pause] </b>Delay</td>
			<td nowrap><b>[Home] </b>Reload Delay</td>
			<td nowrap><b>[Esc] </b>Batal Pembayaran</td>
		</tr>
	</table>
	<table border="1" width="100%">
		<tr>
			<td width="1%" nowrap><b>Cursor Fokus Pada Qty : </b></td>
			<td><b>[Enter] </b>Entry Qty</td>
			<td><b>[Ctrl] </b>Ganti Qty Produk</td>
			<td><b>[Pause] </b>Hapus Produk</td>
 			<td nowrap><b>[F12] </b>Ganti Disc</td>
			<!--td><b>[???] </b>RePrint</td-->
		</tr>
	</table>
<?php include "footer_window_content.php"; ?>
<script language="javascript">
	document.getElementById("barcode").focus();
</script>
<?php
	if(sanitasi($_POST["membertype"]) && !sanitasi($_POST["idmember"])){
	?>
		<script language="javascript">
			document.getElementById("idmember").focus();
		</script>
	<?php
	}
?>
<?php
	if(sanitasi($_GET["reloadlist"])){
	?>
		<script language="javascript">
			document.getElementById("delay").focus();
		</script>
	<?php
	}
?>

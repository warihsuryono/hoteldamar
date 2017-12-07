<?php
	include_once "header.php";
	include_once "func_number_format.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_jurnal.php";
	
	
	if($_POST["ok"]=="PAY"){
		$kode=$_GET["kode"];
		$tanggal=$_POST["tanggal"];
		$paycash=un_formated($_POST["paycash"]);
		$payedc1=un_formated($_POST["payedc1"]);
		$coaedc1=$_POST["coaedc1"];
		$noedc1=$_POST["noedc1"];
		$payedc2=un_formated($_POST["payedc2"]);
		$coaedc2=$_POST["coaedc2"];
		$noedc2=$_POST["noedc2"];
		$paytrf=un_formated($_POST["paytrf"]);
		$coatrf=$_POST["coatrf"];
		$notrf=$_POST["notrf"];
		$createby=$__username;
		$sql="SELECT nama FROM trx_pos WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($vendor)=mysql_fetch_array($hsltemp);
		$namacust=$vendor;
		$notes="Transaksi TOKO dengan noref $kode";		
		$kodejurnal=add_jurnal($tanggal,$kode,$vendor,$notes);		
		$sql="SELECT coa FROM acc_setting_coa WHERE id='15'";//Pendapatan Toko
		$hsltemp=mysql_query($sql,$db);
		list($coa)=mysql_fetch_array($hsltemp);
		$sql="SELECT barcode,qty,harga,(qty*harga) FROM trx_pos_detail WHERE kode='$kode'";
		$hsldet=mysql_query($sql,$db);
		$total=0;
		while(list($barcode,$qty,$harga,$jumlah)=mysql_fetch_array($hsldet)){
			$total+=$jumlah;
			$sql="SELECT nama FROM mst_material_part WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$keterangan="Penjualan $namabarang X $qty (@ Rp.$harga)";
			add_jurnal_detail($kodejurnal,$coa,$keterangan,0,$jumlah);
		}
		
		if($paycash>0){
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
			$hsltemp=mysql_query($sql,$db);
			list($coa1)=mysql_fetch_array($hsltemp);
			$keterangan="Pembayaran Toko Cash [ref:$kode]($namacust)";
			add_jurnal_detail($kodejurnal,$coa1,$keterangan,$paycash,0);
			add_mutasi_uang($tanggal,"kas",$coa1,"",basename($__phpself),$kode,"","",$keterangan,$paycash,0);
		}
		if($payedc1>0){
			$keterangan="Pembayaran Toko EDC [ref:$kode] ($namacust/$noedc1)";
			add_jurnal_detail($kodejurnal,$coaedc1,$keterangan,$payedc1,0);
			add_mutasi_uang($tanggal,"EDC",$coaedc1,"",basename($__phpself),$kode,"","",$keterangan,$payedc1,0);
		}
		if($payedc2>0){
			$keterangan="Pembayaran Toko EDC [ref:$kode] ($namacust/$noedc2)";
			add_jurnal_detail($kodejurnal,$coaedc2,$keterangan,$payedc2,0);
			add_mutasi_uang($tanggal,"EDC",$coaedc2,"",basename($__phpself),$kode,"","",$keterangan,$payedc2,0);
		}
		if($paytrf>0){
			$keterangan="Pembayaran Toko Transfer [ref:$kode] ($namacust/$notrf)";
			add_jurnal_detail($kodejurnal,$coatrf,$keterangan,$paytrf,0);
			add_mutasi_uang($tanggal,"Bank",$coatrf,"",basename($__phpself),$kode,"","",$keterangan,$paytrf,0);
		}
		$sql="UPDATE trx_pos SET pembayaran='$total',paid='1' WHERE kode='$kode'";
		mysql_query($sql,$db);
		?>
			<script language="javascript">
				window.open("pos_faktur.php?kode=<?php echo $kode; ?>","pos_faktur","width=350,height=500,menubar=yes,scrollbars=yes");
				window.location="trx_posadd.php";
			</script>
		<?php
	}
	
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
	if($modebutton=="simpan"){
		if($_GET["editing"]){
			$kode=$_GET["kode"];
			$sql="DELETE FROM $tablename WHERE $kodename='$kode'";
			mysql_query($sql,$db);
			$sql="DELETE FROM $tabledetailname WHERE $kodename='$kode'";
			mysql_query($sql,$db);
		}
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$into="(";
		$values="(";
		$createby=$__username;
		$createdate=$__now;
		$detailfile=$tabledetailname.".php?kode=$kode";
		$actionlink="<a href=''$__phpself?editing=1&kode=$kode''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
		$actionlink.="&nbsp;&nbsp;<a href=''$detailfile''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
			$into.="`$fieldname`,";
			if($fieldtype=="double"){
				eval("\$values .= \"'\".unformated(\$$fieldname).\"',\";");
			}else{
				if($fieldname=="withppn" || $fieldname=="withservice"){
					if(isset($_POST[$fieldname])){
						eval("\$values .= \"'1',\";");					
					}else{
						eval("\$values .= \"'0',\";");					
					}
				}else{
					eval("\$values .= \"'\".\$$fieldname.\"',\";");
				}
			}
		}
		$into=substr($into,0,strlen($into)-1).")";
		$values=substr($values,0,strlen($values)-1).")";
		$sql="INSERT INTO $tablename $into VALUES $values";
		mysql_query($sql,$db);
		//echo "<br>$sql => ".mysql_error();
		//INSERT DETAIL
		eval("\$countrow = count($$kodedetailname);");
		$seqno=-1;
		for($_seqno=0;$_seqno<$countrow;$_seqno++){
			eval("\$isvalue = $$kodedetailname"."[".$_seqno."]".";");
			if($isvalue){//ada isinya
				$seqno++;
				$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
				$hsltemp=mysql_query($sql,$db);
				$intodetail="(";
				$valuesdetail="(";
				while(list($fielddetailname,$fielddetailtype)=mysql_fetch_array($hsltemp)){
					$intodetail.="`$fielddetailname`,";
					if($fielddetailtype=="double"){
						eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".unformated(\$$fielddetailname"."[".$_seqno."]".").\"',\";}else{\$valuesdetail .= \"'\".unformated(\$$fielddetailname).\"',\";}");
					}else{
						eval("if(is_array(\$$fielddetailname)){\$valuesdetail .= \"'\".\$$fielddetailname"."[".$_seqno."]".".\"',\";}else{\$valuesdetail .= \"'\".\$$fielddetailname.\"',\";}");
					}
				}
				$intodetail=substr($intodetail,0,strlen($intodetail)-1).")";
				$valuesdetail=substr($valuesdetail,0,strlen($valuesdetail)-1).")";
				$sql="INSERT INTO $tabledetailname $intodetail VALUES $valuesdetail";
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
		}
		
		$sql="SELECT room FROM trx_pos WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($_room)=mysql_fetch_array($hsltemp);
		$_tgltrx=$_POST["tanggal"];
		$_periodetrx=substr($_tgltrx,0,8);
		$sql="SELECT kode FROM trx_booking WHERE room='$_room' AND checkin='1' AND arrival<='$_tgltrx' AND departure>='$_tgltrx' AND kode NOT IN (SELECT booking FROM trx_billing WHERE tanggal LIKE '".$_periodetrx."%') ORDER BY tanggal DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($kodebooking)=mysql_fetch_array($hsltemp);
		$sql="SELECT sum(qty*harga) FROM trx_pos_detail WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($total_amount)=mysql_fetch_array($hsltemp);
		$sql="UPDATE trx_pos SET kodebooking='$kodebooking',total_amount='$total_amount' WHERE kode='$kode'";
		mysql_query($sql,$db);
		if($paylangsung==2){
			$sql="UPDATE trx_pos SET paid='2' WHERE kode='$kode'";
			mysql_query($sql,$db);
		}
		
		if($paylangsung==1){//bayar langsung
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."add.php";?>?editing=1&kode=<?php echo $kode; ?>";
			</script>
		<?php
		}
		if($paylangsung==2){
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."add.php";?>";
			</script>
		<?php
		}
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					// alert(returnvalue);
					idnamabarang=textid.replace("barcode","namabarang");
					idharga=textid.replace("barcode","harga");
					idqty=textid.replace("barcode","qty");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idharga).value=arrreturnvalue[2];
					document.getElementById(idqty).focus();
				}
			}
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
		function loadnamabyroom(room,tanggalid,namaid){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					document.getElementById(namaid).value=returnvalue;
				}
			}
			tanggal=document.getElementById(tanggalid).value;
			xmlHttp.open("GET","ajax.loadnamabyroom.php?room="+room+"&tanggal="+tanggal,true);
			xmlHttp.send(null);	
		}
		function loaddisc(discname){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					document.getElementById("disc").value=returnvalue;
				}
			}
			xmlHttp.open("GET","ajax.loaddisc.php?discname="+discname,true);
			xmlHttp.send(null);	
		}
		function showProduk(textid,textnama,kodeproduk,idukuran,idsatuan) {
			detailsWindow = window.open("win_toko.php?textid="+textid+"&textnama="+textnama+"&kodeproduk="+kodeproduk+"&idukuran="+idukuran+"&idsatuan="+idsatuan,"window_produk","width=800,height=600,scrollbars=yes");
			detailsWindow.focus(); 
		}
	</script>
	<?php
		if($_GET["editing"]){
	?>
	<div id="divpay" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;">
		<form method="POST" action="<?php echo $__phpself;?>?editing=1&paid=1&kode=<?php echo $_GET["kode"]; ?>">
			<table border="0" bgcolor="c5f05e">
				<tr>
					<td nowrap>Tanggal</td>
					<td>:</td>
					<td>
						<input id="tanggal" type="text" name="tanggal" value="<?php echo date("Y-m-d"); ?>" size="12">
						<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
					</td>
				</tr>
				<tr>
					<td><b>Cash</b></td>
					<td><b>:</b></td>
					<td><input type="text" name="paycash" id="paycash" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
				</tr>
				<tr>
					<td><b>EDC 1</b></td>
					<td><b>:</b></td>
					<td><input type="text" name="payedc1" id="payedc1" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
					<td>
						<select name="coaedc1" id="coaedc1">
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
					<td><input type="text" name="noedc1" id="noedc1" size="30"></td>
				</tr>
				<tr>
					<td><b>EDC 2</b></td>
					<td><b>:</b></td>
					<td><input type="text" name="payedc2" id="payedc2" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
					<td>
						<select name="coaedc2" id="coaedc2">
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
					<td><input type="text" name="noedc2" id="noedc2" size="30"></td>
				</tr>
				<tr>
					<td><b>Transfer</b></td>
					<td><b>:</b></td>
					<td><input type="text" name="paytrf" id="paytrf" style="text-align:right" onblur="this.value=format_number(this.value,'');"></td>
					<td>
						<select name="coatrf" id="coatrf">
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
					<td><input type="text" name="notrf" id="notrf" size="30"></td>
				</tr>
				<tr>
					<td colspan="5" align="center"><input type="submit" name="ok" value="PAY">
					<input type="button" value="Close" onclick="divpay.style.visibility='hidden';"></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		}
	?>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<input type="hidden" id="paylangsung" name="paylangsung">
		<input type="hidden" id="updateby" name="updateby" value="<?php echo $__username; ?>">
		<input type="hidden" id="outlet" name="outlet" value="999">
		<table width="100%"><tr><td align="center"><h3><b>HOTEL DAMAR STORE</b></h3></td></tr></table>
		<table>
			<tr>
				<td>Kode</td>
				<td>:</td>
				<td><input type="text" id="kode" name="kode" readonly size="30"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>:</td>
				<td>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
			</tr>
			<tr>
				<td>Room</td>
				<td>:</td>
				<td>
					<select name="room" id="room" onchange="loadnamabyroom(this.value,'tanggal','nama');">
						<option value="">-room-</option>
						<?php 
							$sql="SELECT kode,nama FROM mst_room ORDER BY kode";
							$hsltemp=mysql_query($sql,$db);
							while(list($_kode,$_desc)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $_kode; ?>"><?php echo $_desc; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><input id="nama" type="text" name="nama" size="30"></td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td>:</td>
				<td><textarea name="notes" id="notes" cols="50" rows="2"></textarea></td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1">
					<b>No</b>
					<a onclick="addrow('0','tabledetail','rowdetail','+');"><img src="images/expand.gif" title="Tambah Baris" border="0"></a>
					<a onclick="addrow('0','tabledetail','rowdetail','-');"><img src="images/collapse.gif" title="Kurangi Baris" border="0"></a>
				</td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<td><b>Harga Satuan</b></td>
				<td><b>Qty</b></td>
				<td><b>Jumlah</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="barcode[0]" type="text" name="barcode[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showProduk('barcode[0]','',this.value,'','');">
				</td>
				<td><input id="namabarang[0]" type="text" name="namabarang[0]" size="30" readonly></td>
				<td align="right"><input id="harga[0]" type="text" name="harga[0]" size="20" style="text-align:right;" ></td>
				<td align="right"><input id="qty[0]" type="text" name="qty[0]" size="5" style="text-align:right;" onblur="hitungjumlah('qty[0]','harga[0]','jumlah[0]');sumnumber('jumlah','input','subtotal');paycash.value=document.getElementById('subtotal').value;"></td>
				<td align="right"><input id="jumlah[0]" type="text" name="jumlah[0]" size="20" style="text-align:right;" ></td>
			</tr>
			
			<tr id="rowdetail_footer">
				<td valign="top" colspan="5" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>TOTAL</b></td>
						</tr>
					</table>
				</td>
				<td valign="top" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><input id="subtotal" type="text" name="subtotal" size="12" readonly style="text-align:right;"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Bayar Langsung" onclick="document.getElementById('paylangsung').value=1;document.getElementById('modebutton').value='simpan';document.getElementById('formsubmit').click();">
				<input type="button" value="Tagihan Kamar" onclick="document.getElementById('paylangsung').value=2;document.getElementById('modebutton').value='simpan';document.getElementById('formsubmit').click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari kode [REST/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode=date("ymd");
		$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$periode=date("Y-m-01");
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
		?><script language="javascript">document.getElementById("tanggal").value="<?php echo $tanggal; ?>";</script><?php
		?><script language="javascript">document.getElementById("withppn").checked=true;</script><?php
		?><script language="javascript">document.getElementById("withservice").checked=true;</script><?php
	}else{//load editing
		$kode=$_GET["kode"];
		$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$fieldselect="";
		while(list($fieldname)=mysql_fetch_array($hsltemp)){
			if($fieldname!=$kodename){
				$fieldselect.="`$fieldname`,";
			}
		}
		$fieldselect=substr($fieldselect,0,strlen($fieldselect)-1);
		$sql="SELECT $fieldselect FROM $tablename WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		$tablevalues=mysql_fetch_assoc($hsltemp);
		foreach ($tablevalues as $varname => $value){
			$value=str_ireplace(chr(13).chr(10)," ",$value);
			if($varname=="tanggal"){$value=substr($value,0,10);}
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").value="<?php echo $value; ?>";</script><?php
			if(($varname=="withppn" ||  $varname=="withservice")){
				if($value=="0"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>").checked=false;</script><?php
				}
				if($value=="1"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>").checked=true;</script><?php
				}
			}
			if(($varname=="nett")){
				if($value=="0"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>id").checked=false;</script><?php
				}
				if($value=="1"){
					?><script language="javascript">document.getElementById("<?php echo $varname; ?>id").checked=true;</script><?php
				}
			}
		}
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		//LOAD DETAIL
		$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($jumlahdetail)=mysql_fetch_array($hsltemp);
		for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
		
		$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
		$hsltemp=mysql_query($sql,$db);
		$selectdetail="";
		while(list($fieldname)=mysql_fetch_array($hsltemp)){
			if($fieldname!=$kodename){
				$selectdetail.="`$fieldname`,";
			}
		}
		$selectdetail=substr($selectdetail,0,strlen($selectdetail)-1);
		$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
		$hsldet=mysql_query($sql,$db);
		$no=-1;
		$subtotal=0;
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$barcode="";
			$qty=0;
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="barcode"){$barcode=$valuedetail;}
				if($vardetailname=="qty"){$qty=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}
			$sql="SELECT nama FROM mst_material_part WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$sql="SELECT harga FROM mst_harga_toko WHERE kode='$barcode'";
			$hsltemp=mysql_query($sql,$db);
			list($harga)=mysql_fetch_array($hsltemp);
			$jumlah=$qty*$harga;
			$subtotal+=$jumlah;
			?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").value="<?php echo $namabarang; ?>";</script><?php
			?><script language="javascript">document.getElementById("harga[<?php echo $no; ?>]").value="<?php echo $harga; ?>";</script><?php
			?><script language="javascript">document.getElementById("jumlah[<?php echo $no; ?>]").value="<?php echo $jumlah; ?>";</script><?php
		}
		?><script language="javascript">document.getElementById("subtotal").value="<?php echo $subtotal; ?>";</script><?php
		?><script language="javascript">document.getElementById("paycash").value="<?php echo number_format($subtotal); ?>";</script><?php
		?><script language="javascript">document.getElementById("paycash").focus();</script><?php
	}
	if($modebutton=="reload" || $modebutton=="simpan"){
		foreach($_POST as $var_id => $postvalue){
			if(is_array($postvalue)){
				if(!$tambahrow){
					for($zz=1;$zz<count($postvalue);$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
					$tambahrow=true;
				}
				foreach($postvalue as $seqno => $postvalue1){
					?><script language="javascript">document.getElementById("<?php echo $var_id; ?>[<?php echo $seqno; ?>]").value="<?php echo $postvalue1; ?>";</script><?php
				}
			}else{
				?><script language="javascript">document.getElementById("<?php echo $var_id; ?>").value="<?php echo $postvalue; ?>";</script><?php
			}
		}
	}
	include_once "footer.php";
?>
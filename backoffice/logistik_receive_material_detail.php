<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sign=$_GET["sign"];
	$kode=$_GET["kode"];
	$invoicestat=$_GET["invoicestat"];
	$lunas=$_GET["lunas"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($lunas){
		$sql="UPDATE $tablename SET invoicestat='1' WHERE $kodename='$kode'";
		mysql_query($sql,$db);
		$sql="SELECT pono FROM $tablename WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($pono)=mysql_fetch_array($hsltemp);
		$sql="SELECT vendorid,withtax FROM logistik_po WHERE pono='$pono'";
		$hsltemp=mysql_query($sql,$db);
		list($vendorid,$withtax)=mysql_fetch_array($hsltemp);
		$paymenttype=$_GET["paymenttype"];
		$coabank=$_GET["coabank"];
		$norek=$_GET["norek"];
		$tanggal=date("Y-m-d");
		$kodejurnal="JURNAL/".date("Ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		$notes="Pembayaran PO $pono";
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','$vendorid','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);			
		//echo "<br>$sql => ".mysql_error();
		$sql="SELECT kodebarang,qty,harsat FROM logistik_po_detail WHERE pono='$pono'";
		$hsldet=mysql_query($sql,$db);
		$subtotal=0;
		$seqno=-1;
		while(list($kodebarang,$qty,$harsat)=mysql_fetch_array($hsldet)){
			$seqno++;
			$jumlah=$qty*$harsat;
			$subtotal+=$jumlah;
			$sql="SELECT nama,coa FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang,$coabarang)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coabarang'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$debit=$jumlah;
			$kredit=0;
			$keterangan="PO $namabarang ($qty X @ $harsat)";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coabarang','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
		}
		//PPN
		if($withtax){
			$seqno++;
			$kredit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$debit=$subtotal*0.1;
			$ppn=$debit;
			$keterangan="Pajak Keluaran PO $pono";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
		}
		$seqno++;
		if($paymenttype=="01" || !$paymenttype){//cash
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
			$hsltemp=mysql_query($sql,$db);
			list($coa1)=mysql_fetch_array($hsltemp);
		}else{
			if(!$coabank){
				$sql="SELECT coa FROM acc_setting_coa WHERE id='2'";
				$hsltemp=mysql_query($sql,$db);
				list($coabank)=mysql_fetch_array($hsltemp);
			}
			$coa1=$coabank;
		}
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa1'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Pembayaran PO $pono";
		$debit=0;
		$kreditkasbank=$subtotal+$ppn;
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa1','$koder','$keterangan','$debit','$kreditkasbank')";
		mysql_query($sql,$db);
	}
	if($invoicestat){
		$sql="UPDATE $tablename SET invoicestat='1' WHERE $kodename='$kode'";
		mysql_query($sql,$db);
		$sql="SELECT pono FROM $tablename WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($pono)=mysql_fetch_array($hsltemp);
		$sql="SELECT vendorid,withtax FROM logistik_po WHERE pono='$pono'";
		$hsltemp=mysql_query($sql,$db);
		list($vendorid,$withtax)=mysql_fetch_array($hsltemp);
		$tanggal=date("Y-m-d");
		$kodejurnal="JURNAL/".date("Ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		$notes="Pembayaran PO $pono";
		//INSERT ACCOUNTING			
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','$vendorid','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);			
		//echo "<br>$sql => ".mysql_error();
		$sql="SELECT kodebarang,qty,harsat FROM logistik_po_detail WHERE pono='$pono'";
		$hsldet=mysql_query($sql,$db);
		$subtotal=0;
		$seqno=-1;
		while(list($kodebarang,$qty,$harsat)=mysql_fetch_array($hsldet)){
			$seqno++;
			$jumlah=$qty*$harsat;
			$subtotal+=$jumlah;
			$sql="SELECT nama,coa FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang,$coabarang)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coabarang'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$debit=$jumlah;
			$kredit=0;
			$keterangan="PO $namabarang ($qty X @ $harsat)";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coabarang','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
		}
		//PPN
		if($withtax){
			$seqno++;
			$kredit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$debit=$subtotal*0.1;
			$keterangan="Pajak Keluaran PO $pono";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
			$seqno++;
			$kredit=$debit;
			$debit=0;
			$sql="SELECT coa FROM acc_setting_coa WHERE id='13'";//hutang pajak 
			$hsltemp=mysql_query($sql,$db);
			list($coatax)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$keterangan="Hutang Pajak PO $pono";
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredit')";
			mysql_query($sql,$db);
		}
		//HUTANG DAGANG
		$seqno++;
		$debit=0;
		$kredit=$subtotal;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='12'";//hutang dagang
		$hsltemp=mysql_query($sql,$db);
		list($coahutang)=mysql_fetch_array($hsltemp);
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coahutang'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Hutang Dagang PO $pono";
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coahutang','$koder','$keterangan','$debit','$kredit')";
		mysql_query($sql,$db);		
	}
	if($sign){
		$signby=$sign."by";
		$signdate=$sign."date";
		if($sign=="periksa"){//insert history
			$sql="SELECT tanggal,vendorid,gudang,pono FROM $tablename WHERE $kodename='$kode'";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
			list($histdate,$vendorid,$gudang,$pono)=mysql_fetch_array($hsltemp);
			$modulfilename=basename($__phpself);
			$sql="SELECT kodebarang,recvqty,satuan,keterangan FROM $tabledetailname WHERE $kodename='$kode'";
			$hsldet=mysql_query($sql,$db);			
			$createby=$__username;
			while(list($kodebarang,$recvqty,$satuan,$notes)=mysql_fetch_array($hsldet)){
				$in_out="1";
				$sourcetype="vendor";
				$sourceid=$vendorid;
				$desttype="gudang";
				$destid=$gudang;
				$qty=$recvqty;
				$sql="INSERT INTO logistik_hist_stok (in_out,histdate,modulfilename,mrno,pono,wrno,sourcetype,sourceid,desttype,destid,kodebarang,qty,satuan,notes,createby,createdate) VALUES ";
				$sql.="('$in_out','$histdate','$modulfilename','$mrno','$pono','$kode','$sourcetype','$sourceid','$desttype','$destid','$kodebarang','$qty','$satuan','$notes','$createby',NOW())";
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
				$sql="SELECT seqno FROM logistik_stok WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
				mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){//sudah ada
					$sql="UPDATE logistik_stok SET stock=stock+$qty,createby='$createby',createdate=NOW() WHERE branchtype='gudang' AND branchid='$gudang' AND kodebarang='$kodebarang'";
				}else{//belum ada
					$sql="INSERT INTO logistik_stok (branchtype,branchid,kodebarang,stock,createby,createdate) VALUES ";
					$sql.="('gudang','$gudang','$kodebarang','$qty','$createby',NOW())";
				}
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
		}
		$sql="UPDATE $tablename SET $signby='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailpo(pono){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnval=xmlHttp.responseText;
					//testing.innerHTML=returnval;
					arrreturnvaltemp=returnval.split("<field1>");
					//kode_pekerjaan=arrreturnvaltemp[0];
					//document.getElementById("kode_pekerjaan").value=kode_pekerjaan;
					returnval=arrreturnvaltemp[1];
					arrreturnvaltemp=returnval.split("<field2>");
					vendorid=arrreturnvaltemp[0];
					document.getElementById("vendorid").value=vendorid;
					returnval=arrreturnvaltemp[1];
					arrreturnval=returnval.split("<br>");
					maxrow=arrreturnval.length;
					for(jj=0;jj<maxrow;jj++){
						contentrow=arrreturnval[jj];
						contentrow_1=arrreturnval[jj+1];
						try{
							arrcontent=contentrow.split("|||");						
							arrcontent_1=contentrow_1.split("|||");						
							kode=arrcontent[0];
							nama=arrcontent[1];
							poqty=arrcontent[2];
							outstandingqty=arrcontent[3];
							recvqty=arrcontent[4];
							satuan=arrcontent[5];
							harga=arrcontent[6];
							jumlah=arrcontent[7];
							keterangan=arrcontent[8];
							//alert(kode+":"+nama+":"+qty+":"+satuan+":"+harga+":"+jumlah+":"+keterangan);
							if(kode!="undefined" && kode !=""){
								if(arrcontent_1[0]!="undefined" && arrcontent_1[0]!=""){addrow('0','tabledetail','rowdetail','+');}
								document.getElementById("kodebarang["+jj+"]").value=kode;
								document.getElementById("namabarang["+jj+"]").value=nama;
								document.getElementById("poqty["+jj+"]").value=poqty;
								document.getElementById("outstandingqty["+jj+"]").value=outstandingqty;
								document.getElementById("recvqty["+jj+"]").value=recvqty;
								document.getElementById("satuan["+jj+"]").value=satuan;
								document.getElementById("keterangan["+jj+"]").value=keterangan;
							}
						} catch (e) {
						}
					}
				}
			}
			xmlHttp.open("GET","ajax.loaddetailpo.php?pono="+pono,true);
			xmlHttp.send(null);	
		}
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					// alert(returnvalue);
					idnamabarang=textid.replace("kodebarang","namabarang");
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(idsatuan).value=arrreturnvalue[1];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue+"&kode_pekerjaan="+document.getElementById("kode_pekerjaan").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
	<div id="divpay" style="left:1px;top:1px; solid; margin-top:0px; position:absolute;visibility:hidden;">
		<table border="0" bgcolor="c5f05e">
			<tr>
				<td><b>Metode Bayar</b></td>
				<td>:</b></td>
				<td>
					<select name="paymenttype" id="paymenttype">
						<?php
							$sql="SELECT kode,description FROM mst_pay_type ORDER BY kode";
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
				<td><b>Bank</b></td>
				<td>:</b></td>
				<td>
					<select name="coabank" id="coabank">
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
				<td><b>No Card / No Rek</b></td>
				<td>:</b></td>
				<td><input type="text" name="norek" id="norek"></td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="button" value="OK" id="paidbutton" onclick="window.location='<?php echo $__phpself;?>?editing=<?php echo $_GET["editing"];?>&lunas=1&kode=<?php echo $_GET["kode"]; ?>&paymenttype='+paymenttype.value+'&coabank='+coabank.value+'&norek='+norek.value;">
				</td>
			</tr>
		</table>
	</div>
	<span id="testing"></span>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>PENERIMAAN BARANG</b></h3></td></tr></table>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Kode Penerimaan</td>
							<td>:</td>
							<td id="recvkode"></td>
						</tr>
						<tr>
							<td>PO NO</td>
							<td>:</td>
							<td id="pono"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr-->
						<tr>
							<td>Supplier</td>
							<td>:</td>
							<td id="vendorid"></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<!--tr>
							<td>Gudang</td>
							<td>:</td>
							<td id="gudang"></td>
						</tr-->
						<tr>
							<td>Tanggal Penerimaan</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>:</td>
							<td id="notes"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1"><b>No</b></td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<td><b>Qty PO</b></td>
				<td><b>Qty Yg Belum</b></td>
				<td><b>Qty Terima</b></td>
				<td><b>Satuan</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="kodebarang[0]"></td>
				<td id="namabarang[0]"></td>
				<td id="poqty[0]"></td>
				<td id="outstandingqty[0]"></td>
				<td id="recvqty[0]"></td>
				<td id="satuan[0]"></td>
				<td id="keterangan[0]"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
<?php
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
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
		eval("\$$varname = $value;");
		$sql="SELECT nama,signature FROM user_account WHERE username='$value'";
		$hsltemp=mysql_query($sql,$db);
		if(mysql_affected_rows($db)>0){
			list($nama,$signature)=mysql_fetch_array($hsltemp);
			eval("\$_$varname = \"$nama\";");
			eval("\$__$varname = \"$signature\";");
		}
		
		$value=str_ireplace(chr(13).chr(10)," ",$value);
		if($varname=="gudang"){
			$sql="SELECT kode,nama,alamat FROM mst_gudang WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($_kodegudang,$_nama,$_alamat)=mysql_fetch_array($hsltemp);
			$value=$_nama." ".$_alamat;
		}
		if($varname=="vendorid"){
			$sql="SELECT nama FROM mst_vendor WHERE kode='$value'";
			$hsltemp=mysql_query($sql,$db);
			list($_nama)=mysql_fetch_array($hsltemp);
			$value=$_nama;
		}
		if($varname=="pono"){$pono=$value;}
		if($varname=="invoicestat"){$invoicestat=$value;}
		?><script language="javascript">document.getElementById("<?php echo $varname; ?>").innerHTML="<?php echo $value; ?>";</script><?php
	}
	?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").innerHTML="<?php echo $kode; ?>";</script><?php
	//LOAD DETAIL
	$sql="SELECT count(*) FROM $tabledetailname WHERE $kodename='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($jumlahdetail)=mysql_fetch_array($hsltemp);
	for($zz=1;$zz<$jumlahdetail;$zz++){?> <script language="javascript">addrow('0','tabledetail','rowdetail','+');</script> <?php }
	
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	$selectdetail="";
	while(list($fieldname)=mysql_fetch_array($hsltemp)){
		if($fieldname!=$kodename){
			$selectdetail.="`$fieldname`,";
		}
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
		if($fieldtype=="double"){$istypedouble[$fieldname]=1;}
	}
	$selectdetail=substr($selectdetail,0,strlen($selectdetail)-1);
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode'";
	$hsldet=mysql_query($sql,$db);
	$no=-1;
	while($detailvalues=mysql_fetch_assoc($hsldet)){
		$no++;
		$kodebarang="";
		foreach ($detailvalues as $vardetailname => $valuedetail){
			if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
			$valuedetail=str_ireplace("\"","''",$valuedetail);
			if($vardetailname=="kodebarang"){$kodebarang=$valuedetail;}
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
		}
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$namabarang=str_ireplace(chr(34),"''",$namabarang);
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").innerHTML="<?php echo $namabarang; ?>";</script><?php
	}
	?><script language="javascript">sumnumber('jumlah','input','subtotal');</script><?php
	
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__recvby)){$__recvby=$imgnull;}
	if(!is_file("signature/".$__periksaby)){$__periksaby=$imgnull;}
	if(!is_file("signature/".$__tahuby)){$__tahuby=$imgnull;}
	if(!$_recvby){$_recvby=$null;}
	if(!$_periksaby){$_periksaby=$null;}
	if(!$_tahuby){$_tahuby=$null;}
	if($recvby && !$periksaby){$_periksaby="<span id=\"approvebtn\"><input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=periksa&kode=$kode';}\"></span>";}
	if($periksaby && !$tahuby){$_tahuby="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=tahu&kode=$kode';}\">";}
?>
	<table width="100%">
		<tr style="text-align:center;">
			<td>Diterima,</td>
			<td>Diperiksa,</td>
			<!--td>Diketahui,</td-->
		</tr>
		<tr style="text-align:center;vertical-align:bottom;height:80px">
			<td align="center"><img src="signature/<?php echo $__recvby; ?>" width="100" height="50" border='0'></td>
			<td align="center"><img src="signature/<?php echo $__periksaby; ?>" width="100" height="50" border='0'></td>
			<!--td align="center"><img src="signature/<?php echo $__tahuby; ?>" width="100" height="50" border='0'></td-->
		</tr>
		<tr style="text-align:center;">
			<td>(<?php echo $_recvby; ?>)</td>
			<td>(<?php echo $_periksaby; ?>)</td>
			<!--td>(<?php echo $_tahuby; ?>)</td-->
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="buttonrowdiv">
				<?php if(!$invoicestat && $pono){ ?>
				<input type="button" value="Pelunasan Invoice" id="lunasbutton" onclick="divpay.style.visibility='visible';paymenttype.focus()">
				<input type="button" value="Terima Invoice Saja" id="invoicebutton" onclick="if(confirm('Apakas Anda sudah menerima Invoice untuk PO <?php echo $pono; ?>? Jika Ya, silakan klik OK, maka otomatis akan tercatat sebagai Hutang')){window.location='<?php echo $__phpself; ?>?kode=<?php echo $kode; ?>&invoicestat=1';}">
				<?php } ?>
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
				</div>
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
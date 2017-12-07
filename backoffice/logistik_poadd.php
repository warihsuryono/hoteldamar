<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func.material.php";
	$tablename=str_ireplace("add.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sql="SHOW COLUMNS FROM $tablename WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($_GET["editing"]){
		$sql="SELECT setujuby FROM $tablename WHERE $kodename='".$_GET["kode"]."'";
		$hsltemp=mysql_query($sql,$db);
		list($__approved)=mysql_fetch_array($hsltemp);
		if($__approved){ ?> <script language="javascript">alert("Dokumen ini sudah Settled, Sehingga tidak boleh diubah!");window.location="<?php echo $tablename."list.php";?>";</script> <?php }
	}
	$sql="SHOW COLUMNS FROM $tabledetailname WHERE field<>'xtimestamp'";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
	if($modebutton=="simpan" || $modebutton=="simpanbelanjalangsung"){
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
		$detailfile=$tabledetailname.".php?kode=$pono";
		$actionlink="<a href=''$__phpself?editing=1&kode=$pono''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
		$actionlink.="&nbsp;&nbsp;<a href=''$detailfile''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		while(list($fieldname,$fieldtype)=mysql_fetch_array($hsltemp)){
			$into.="`$fieldname`,";
			if($fieldtype=="double"){
				eval("\$values .= \"'\".unformated(\$$fieldname).\"',\";");
			}else{
				eval("\$values .= \"'\".\$$fieldname.\"',\";");
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
			if($isvalue || $_POST["namabarang"][$_seqno]){//ada isinya
				$seqno++;
				if($_POST["kodebarang"][$_seqno]==""){$kodebarang=material_kodebynama($_POST["namabarang"][$_seqno],$_POST["satuan"][$_seqno],0,1);$_POST["kodebarang"][$_seqno]=$kodebarang;}
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
		if($modebutton=="simpanbelanjalangsung"){
			//Apporve PO
			$sign="setuju";
			$signby=$sign."by";
			$signdate=$sign."date";
			if(!$kode){$kode=$pono;}
			$sql="UPDATE $tablename SET $signby='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
			mysql_query($sql,$db);
			
			//INSERT BARANG MASUK
			$sql="SELECT vendorid,notes FROM $tablename WHERE $kodename='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($vendorid,$notes)=mysql_fetch_array($hsltemp);
			//cari recvcode
			$tanggal=date("Y-m-d");
			$recvkode="RECV/M/".date("Ymd")."/";
			$sql="SELECT idseqno FROM logistik_receive_material WHERE recvkode  LIKE '$recvkode%' ORDER BY idseqno DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			list($idseqno)=mysql_fetch_array($hsltemp);
			$idseqno++;
			$recvkode.=substr("000",0,3-strlen($idseqno)).$idseqno;
			
			$pono=$kode;
			$recvby=$__username;
			$actionlink="<a href=''logistik_receive_materialadd.php?editing=1&kode=".$recvkode."''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''logistik_receive_material_detail.php?kode=".$recvkode."''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
			$sql="INSERT INTO logistik_receive_material (recvkode,idseqno,tanggal,vendorid,pono,notes,recvby,recvdate,actionlink) VALUES ('$recvkode','$idseqno','$tanggal','$vendorid','$pono','$notes','$recvby',NOW(),'$actionlink')";
			mysql_query($sql,$db);
			
			$sql="SELECT kodebarang,qty,satuan,harsat,keterangan FROM logistik_po_detail WHERE pono='$kode'";
			$hsldet=mysql_query($sql,$db);
			$seqno=-1;
			while(list($kodebarang,$qty,$satuan,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
				$seqno++;
				$poqty=$qty;
				$outstandingqty=0;
				$recvqty=$qty;
				$sql="INSERT INTO logistik_receive_material_detail (recvkode,seqno,kodebarang,poqty,outstandingqty,recvqty,satuan,harsat,keterangan) VALUES ('$recvkode','$seqno','$kodebarang','$poqty','$outstandingqty','$recvqty','$satuan','$harsat','$keterangan')";
				mysql_query($sql,$db);
			}
			
			//APPROVE BARANG MASUK
			$sign="periksa";
			$sql="SELECT tanggal,vendorid,gudang,pono FROM logistik_receive_material WHERE recvkode='$recvkode'";
			$hsltemp=mysql_query($sql,$db);
			//echo "<br>$sql => ".mysql_error();
			list($histdate,$vendorid,$gudang,$pono)=mysql_fetch_array($hsltemp);
			$modulfilename=basename($__phpself);
			$sql="SELECT kodebarang,recvqty,satuan,keterangan FROM logistik_receive_material_detail WHERE recvkode='$recvkode'";
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
			$sql="UPDATE logistik_receive_material SET periksaby='$__username' , periksadate=NOW() WHERE recvkode='$recvkode'";
			mysql_query($sql,$db);
			
			//INSERT ACCOUNTING
			$kodejurnal="JURNAL/".date("Ymd")."/";
			$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
			$hsltemp=mysql_query($sql,$db);
			list($idseqno)=mysql_fetch_array($hsltemp);
			$idseqno++;
			$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
			$vendor=$vendorid;
			$createby=$__username;
			$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
			$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$norek','$vendor','$notes','$createby',NOW(),'$actionlink')";
			mysql_query($sql,$db);			
			//echo "<br>$sql => ".mysql_error();
			$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
			$hsltemp=mysql_query($sql,$db);
			list($coakas)=mysql_fetch_array($hsltemp);
			$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coakas'";
			$hsltemp=mysql_query($sql,$db);
			list($koder)=mysql_fetch_array($hsltemp);
			$sql="SELECT sum(qty * harsat) FROM logistik_po_detail WHERE pono='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($kreditkas)=mysql_fetch_array($hsltemp);
			$sql="SELECT notes,withtax FROM logistik_po WHERE pono='$kode'";
			$hsltemp=mysql_query($sql,$db);
			list($notespo,$withtax)=mysql_fetch_array($hsltemp);
			$keterangan="PO Belanja Langsung ";
			if($notespo){$keterangan.=" ($notespo)";}
			$debit=0;
			$seqno=0;
			$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coakas','$koder','$keterangan','$debit','$kreditkas')";
			mysql_query($sql,$db);
			if($withtax){
				$seqno++;
				$debit=0;
				$sql="SELECT coa FROM acc_setting_coa WHERE id='6'";//pajak keluaran
				$hsltemp=mysql_query($sql,$db);
				list($coatax)=mysql_fetch_array($hsltemp);
				$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coatax'";
				$hsltemp=mysql_query($sql,$db);
				list($koder)=mysql_fetch_array($hsltemp);
				$kredittax=$kreditkas*0.1;
				$keterangan="Pajak Pebelanjaan Langsung";
				$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coatax','$koder','$keterangan','$debit','$kredittax')";
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
			
			$sql="SELECT kodebarang,qty,satuan,harsat,keterangan FROM logistik_po_detail WHERE pono='$kode'";
			$hsldet=mysql_query($sql,$db);
			while(list($kodebarang,$qty,$satuan,$harsat,$keterangan)=mysql_fetch_array($hsldet)){
				$seqno++;
				$sql="SELECT nama,coa FROM mst_material_part WHERE kode='$kodebarang'";
				$hsltemp=mysql_query($sql,$db);
				list($namabarang,$coa)=mysql_fetch_array($hsltemp);
				if(!$coa){
					$sql="SELECT coa FROM acc_setting_coa WHERE id='10'";//pengeluaran restourant
					$hsltemp=mysql_query($sql,$db);
					list($coa)=mysql_fetch_array($hsltemp);
				}
				$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa'";
				$hsltemp=mysql_query($sql,$db);
				list($koder)=mysql_fetch_array($hsltemp);
				$debit=$qty*$harsat;
				$kredit=0;
				$keterangan="$namabarang ($qty $satuan)";
				$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa','$koder','$keterangan','$debit','$kredit')";
				mysql_query($sql,$db);
				//echo "<br>$sql => ".mysql_error();
			}
		}
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."list.php";?>";
				window.close();
			</script>
		<?php
	}
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailpermdana(permno){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnval=xmlHttp.responseText;
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
							qty=arrcontent[2];
							satuan=arrcontent[3];
							harga=arrcontent[4];
							jumlah=arrcontent[5];
							keterangan=arrcontent[6];
							//alert(kode+":"+nama+":"+qty+":"+satuan+":"+harga+":"+jumlah+":"+keterangan);
							if(kode!="undefined" && kode !=""){
								if(arrcontent_1[0]!="undefined" && arrcontent_1[0]!=""){addrow('0','tabledetail','rowdetail','+');}
								document.getElementById("kodebarang["+jj+"]").value=kode;
								document.getElementById("namabarang["+jj+"]").value=nama;
								document.getElementById("qty["+jj+"]").value=qty;
								document.getElementById("satuan["+jj+"]").value=satuan;
								document.getElementById("harsat["+jj+"]").value=harga;
								document.getElementById("harsat["+jj+"]").focus();
								document.getElementById("jumlah["+jj+"]").value=jumlah;
								document.getElementById("jumlah["+jj+"]").focus();
								document.getElementById("keterangan["+jj+"]").value=keterangan;
							}
						} catch (e) {
						}
					}
				}
			}
			xmlHttp.open("GET","ajax.loaddetailpermdana.php?permno="+permno,true);
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
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>PURCHASE ORDER</b></h3></td></tr></table>
		<table>
			<tr>
				<td>PO No</td>
				<td>:</td>
				<td><input type="text" id="pono" name="pono" readonly size="30"></td>
			</tr>
			<!--tr>
				<td>Kode Pekerjaan</td>
				<td>:</td>
				<td>					
					<input type="text" id="kode_pekerjaan" name="kode_pekerjaan">
					<img src="images/b_search.png" title="Daftar Kode Pekerjaan" border="0" width="13" height="13" onclick="showKodePekerjaan('kode_pekerjaan')">
				</td>
			</tr-->
			<tr>
				<td>Kode Permohonan</td>
				<td>:</td>
				<td>
					<input type="text" id="kodepermohonan" name="kodepermohonan">
					<!--img src="images/b_search.png" title="Daftar Permintaan Quotation" border="0" width="13" height="13" onclick="showPermDana('kodepermohonan',kode_pekerjaan.value)"-->
					<img src="images/b_search.png" title="Daftar Permintaan Quotation" border="0" width="13" height="13" onclick="showPermDana('kodepermohonan','')">
				</td>
			</tr>
			<tr>
				<td>Tanggal PO</td>
				<td>:</td>
				<td>
					<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal; ?>" size="12">
					<img src="images/calendar.png" title="Calendar" border="0" width="13" height="13" onclick="showCalendar('tanggal')">
				</td>
			</tr>
			<tr>
				<td>Supplier</td>
				<td>:</td>
				<td>
					<select name="vendorid" id="vendorid">
						<option value="">-Pilih Supplier-</option>
						<?php 
							$sql="SELECT kode,nama,alamat FROM mst_vendor ORDER BY nama";
							$hsltemp=mysql_query($sql,$db);
							while(list($_kodevendor,$_nama)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $_kodevendor; ?>"><?php echo $_nama; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Dengan Pajak 10%</td>
				<td>:</td>
				<td>
					<select id="withtax" name="withtax">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
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
				<td><b>Qty</b></td>
				<td><b>Satuan</b></td>
				<td><b>Harga</b></td>
				<td><b>Jumlah</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="kodebarang[0]" type="text" name="kodebarang[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showMaterial('kodebarang[0]')">
				</td>
				<td><input id="namabarang[0]" type="text" name="namabarang[0]" size="30"></td>
				<td><input id="qty[0]" type="text" name="qty[0]" size="5" style="text-align:right;"></td>
				<td>
					<select name="satuan[0]" id="satuan[0]">
						<?php 
							$sql="SELECT kode,singkatan FROM mst_satuan ORDER BY kode='pcs' DESC";
							$hsltemp=mysql_query($sql,$db);
							while(list($kode,$singkatan)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $kode; ?>"><?php echo $singkatan; ?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td><input id="harsat[0]" type="text" name="harsat[0]" size="8" style="text-align:right;" onblur="hitungjumlah('qty[0]','harsat[0]','jumlah[0]');sumnumber('jumlah','input','subtotal');"></td>
				<td align="right"><input id="jumlah[0]" type="text" name="jumlah[0]" size="10" style="text-align:right;"></td>
				<td><input id="keterangan[0]" type="text" name="keterangan[0]" size="40"></td>
			</tr>
			<tr id="rowdetail_footer">
				<td valign="top" colspan="6" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>SUB TOTAL</b></td>
						</tr>
						<tr>
							<td align="right"><input style="visibility:hidden;" size='1'><b>PPN</b></td>
						</tr>
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
						<tr>
							<td align="right"><input id="ppn" type="text" name="ppn" size="12" readonly style="text-align:right;"></td>
						</tr>
						<tr>
							<td align="right"><input id="total" type="text" name="total" size="12" readonly style="text-align:right;"></td>
						</tr>
					</table>
				</td>
				<td></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Simpan" onclick="modebutton.value='simpan';formsubmit.click();">
				<input type="button" value="Simpan Belanja Langsung" onclick="modebutton.value='simpanbelanjalangsung';formsubmit.click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari kodepermohonan [PO/M/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode="PO/M/".date("Ymd")."/";
		$sql="SELECT idseqno FROM $tablename WHERE $kodename LIKE '$kode%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kode.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$periode=date("Y-m-01");
		?><script language="javascript">document.getElementById("<?php echo $kodename; ?>").value="<?php echo $kode; ?>";</script><?php
		?><script language="javascript">document.getElementById("idseqno").value="<?php echo $idseqno; ?>";</script><?php
		?><script language="javascript">document.getElementById("tanggal").value="<?php echo $tanggal; ?>";</script><?php	
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
			?><script language="javascript">document.getElementById("<?php echo $varname; ?>").value="<?php echo $value; ?>";</script><?php
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
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$kodebarang="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="kodebarang"){$kodebarang=$valuedetail;}
				if($vardetailname=="withtax"){$withtax=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}
			$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
			$hsltemp=mysql_query($sql,$db);
			list($namabarang)=mysql_fetch_array($hsltemp);
			$namabarang=str_ireplace(chr(34),"''",$namabarang);
			?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").value="<?php echo $namabarang; ?>";</script><?php
		}
		?><script language="javascript">sumnumber('jumlah','input','subtotal','<?php echo !$withtax; ?>');</script><?php
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
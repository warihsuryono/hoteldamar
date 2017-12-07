<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sign=$_GET["sign"];
	$receive=$_GET["receive"];
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	$sql="SELECT receive  FROM logistik_perm_dana WHERE $kodename='$kode'";
	$hsltemp=mysql_query($sql,$db);
	list($isreceive)=mysql_fetch_array($hsltemp);
	if($receive){
		$sql="UPDATE $tablename SET receive='1',receiveby='$__username',receivedate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
		//MASUKKAN KE JURNAL
		$sql="SELECT sum(qty*harsat) FROM logistik_perm_dana_detail WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($total)=mysql_fetch_array($hsltemp);
		$sql="SELECT notes,withtax FROM logistik_perm_dana WHERE $kodename='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($notes,$withtax)=mysql_fetch_array($hsltemp);
		if($withtax){
			$total=$total+($total*0.1);
		}
		$tanggal=date("Y-m-d");
		$kodejurnal="JURNAL/".date("Ymd")."/";
		$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($idseqno)=mysql_fetch_array($hsltemp);
		$idseqno++;
		$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
		$createby=$__username;
		$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
		$vendor="HO";
		$notes="Permohonan Dana Ke HO";
		$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,vendor,notes,createby,createdate,actionlink) VALUES ('$kodejurnal','$idseqno','$tanggal','$vendor','$notes','$createby',NOW(),'$actionlink')";
		mysql_query($sql,$db);			
		//echo "<br>$sql => ".mysql_error();
		//KAS/BANK (Debit)
		$seqno=0;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
		$hsltemp=mysql_query($sql,$db);
		list($coa1)=mysql_fetch_array($hsltemp);
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa1'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$keterangan="Permohonan Dana";
		if($notes){$keterangan.=" ($notes)";}
		$kredit=0;
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa1','$koder','$keterangan','$total','$kredit')";
		mysql_query($sql,$db);
		//Hutang Dagang (Kredit)
		$seqno=1;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='12'";
		$hsltemp=mysql_query($sql,$db);
		list($coa2)=mysql_fetch_array($hsltemp);
		$sql="SELECT koder FROM acc_mst_coa WHERE coa='$coa2'";
		$hsltemp=mysql_query($sql,$db);
		list($koder)=mysql_fetch_array($hsltemp);
		$debit=0;
		$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ('$kodejurnal','$seqno','$coa2','$koder','$keterangan','$debit','$total')";
		mysql_query($sql,$db);
	}
	if($sign){
		$signdate=$sign."date";
		$sql="UPDATE $tablename SET $sign='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}//kodebarang
?>
	<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailqr(qrno,vendorid){
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
			xmlHttp.open("GET","ajax.loaddetailqr.php?qrno="+qrno+"&vendorid="+vendorid,true);
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
		<!--table width="100%"><tr><td align="center"><h3><b>PERMOHONAN DANA</b></h3></td></tr></table-->
		<?php $__captiontitle="PERMOHONAN DANA";include_once "header_document.php"; ?>
		<table width="100%">
			<tr>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Kode Permohonan</td>
							<td>:</td>
							<td id="kodepermohonan"></td>
						</tr>
						<tr>
							<td>Tanggal Permohonan</td>
							<td>:</td>
							<td id="tanggal"></td>
						</tr>
						<!--tr>
							<td>Kode Pekerjaan</td>
							<td>:</td>
							<td id="kode_pekerjaan"></td>
						</tr>
						<tr>
							<td>QR No</td>
							<td>:</td>
							<td id="qrno"></td>
						</tr-->
					</table>
				</td>
				<td valign="top">
					<table valign="top">
						<tr>
							<td>Keterangan</td>
							<td>:</td>
							<td id="notes"></td>
						</tr>
						<!--tr>
							<td>Posting</td>
							<td>:</td>
							<td id="posting"></td>
						</tr>
						<tr>
							<td>Lavelansir</td>
							<td>:</td>
							<td id="lavelansir"</td>
						</tr-->
					</table>
				</td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1"><b>No</b></td>
				<td><b>Kode Barang</b></td>
				<td><b>Nama Barang</b></td>
				<td><b>Qty</b></td>
				<td><b>Satuan</b></td>
				<td><b>Harga</b></td>
				<td><b>Jumlah</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td id="kodebarang[0]"></td>
				<td id="namabarang[0]"></td>
				<td id="qty[0]" align="right"></td>
				<td id="satuan[0]"></td>
				<td id="harsat[0]" align="right"></td>
				<td id="jumlah[0]" align="right"></td>
				<td id="keterangan[0]"></td>
			</tr>
			<tr id="rowdetail_footer">
				<td valign="top" colspan="6" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right"><b>SUB TOTAL</b></td>
						</tr>
						<tr>
							<td align="right"><b>PPN</b></td>
						</tr>
						<tr>
							<td align="right"><b>TOTAL</b></td>
						</tr>
					</table>
				</td>
				<td valign="top" align="right">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right" id="subtotal">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" id="ppn">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" id="total">&nbsp;</td>
						</tr>
					</table>
				</td>
				<td></td>
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
			if($vardetailname=="withtax"){$withtax=$valuedetail;}
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
		}
		$sql="SELECT nama FROM mst_material_part WHERE kode='$kodebarang'";
		$hsltemp=mysql_query($sql,$db);
		list($namabarang)=mysql_fetch_array($hsltemp);
		$namabarang=str_ireplace(chr(34),"''",$namabarang);
		?><script language="javascript">document.getElementById("namabarang[<?php echo $no; ?>]").innerHTML="<?php echo $namabarang; ?>";</script><?php
	}
	?><script language="javascript">sumnumber_inner('jumlah','input','subtotal','<?php echo !$withtax; ?>');</script><?php
	
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!is_file("signature/".$__kalogistik)){$__kalogistik=$imgnull;}
	if(!is_file("signature/".$__kadivumum)){$__kadivumum=$imgnull;}
	if(!is_file("signature/".$__dirut)){$__dirut=$imgnull;}
	if(!$_createby){$_createby=$null;}
	if(!$_kalogistik){$_kalogistik=$null;}
	if(!$_kadivumum){$_kadivumum=$null;}
	if(!$_dirut){$_dirut=$null;}
	if($createby && !$kalogistik){$_kalogistik="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=kalogistik&kode=$kode';}\">";}
	if($kalogistik && !$kadivumum){$_kadivumum="<input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=kadivumum&kode=$kode';}\">";}
	if($createby && !$dirut){$_dirut="<span id=\"approvebtn\"><input type='button' value='Approve' onclick=\"if(confirm('Anda yakin ingin approve dokumen ini?')){window.location='$__phpself?sign=dirut&kode=$kode';}\"></span>";}
?>
	<table width="100%">
		<tr style="text-align:center;">
			<td>Dibuat,</td>
			<!--td>Diperiksa,</td-->
			<!--td>Diketahui,</td-->
			<td>Disetujui,</td>
		</tr>
		<tr style="text-align:center;vertical-align:bottom;height:80px">
			<td align="center"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
			<!--td align="center"><img src="signature/<?php echo $__kalogistik; ?>" width="100" height="50" border='0'></td-->
			<!--td align="center"><img src="signature/<?php echo $__kadivumum; ?>" width="100" height="50" border='0'></td-->
			<td align="center"><img src="signature/<?php echo $__dirut; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:center;">
			<td>(<?php echo $_createby; ?>)<hr>Admin</td>
			<!--td>(<?php echo $_kalogistik; ?>)<hr>Ka.Logistik</td-->
			<!--td>(<?php echo $_kadivumum; ?>)<hr>Kadiv Umum</td-->
			<td nowrap>(<?php echo $_dirut; ?>)<hr>Manager</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<div id="buttonrowdiv">
				<?php if($dirut && !$isreceive){ ?>
				<input type="button" value="Dana Diterima" id="btnreceive" onclick="if(confirm('Apakah dana telah diterima?')){window.location='<?php echo $__phpself?>?receive=1&kode=<?php echo $kode; ?>';}">
				<?php } ?>
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="printbutton" onclick="try{buttonrowdiv.style.visibility='hidden';}catch(err){} try{approvebtn.style.visibility='hidden';}catch(err){} window.print(); try{buttonrowdiv.style.visibility='visible';}catch(err){} try{approvebtn.style.visibility='visible';}catch(err){}">
				</div>
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
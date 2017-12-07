<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	
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
		
		//hitung 
		$sql="SELECT room,withppn,withservice,nett,disc FROM trx_restaurant_bill WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($_room,$_withppn,$_withservice,$_nett,$_disc)=mysql_fetch_array($hsltemp);
		$sql="SELECT sum(qty*price) FROM trx_restaurant_bill_detail WHERE kode='$kode'";
		$hsltemp=mysql_query($sql,$db);
		list($subtotal1)=mysql_fetch_array($hsltemp);
		
		$ppn=0;
		$service=0;
		
		//with nett
		if($_nett){
			$subtotal2=(100*$subtotal1)/111;
			$service=$subtotal1-$subtotal2;
			$subtotal1=(100*$subtotal2)/110;
			$ppn=$aftertax-$subtotal1;
		}
		
		$subtotal2=$subtotal1-($subtotal1*$_disc/100);
		
		if($_withppn || true){
			$ppn=$subtotal2*0.1;
			$subtotal3=$subtotal2+$ppn;
		}
		if($_withservice || true){
			$service=$subtotal3*0.11;
			$grandtotal=$subtotal3+$service;
		}
		
		
		$_tgltrx=$_POST["tanggal"];
		$_periodetrx=substr($_tgltrx,0,8);
		$sql="SELECT kode FROM trx_booking WHERE room='$_room' AND checkin='1' AND arrival<='$_tgltrx' AND departure>='$_tgltrx' AND kode NOT IN (SELECT booking FROM trx_billing WHERE tanggal LIKE '".$_periodetrx."%') ORDER BY tanggal DESC LIMIT 1";
		$hsltemp=mysql_query($sql,$db);
		list($kodebooking)=mysql_fetch_array($hsltemp);
		$sql="UPDATE trx_restaurant_bill SET subtotal1='$subtotal1',ppn='$ppn',subtotal2='$subtotal2',service='$service',grandtotal='$grandtotal',kodebooking='$kodebooking' WHERE kode='$kode'";
		mysql_query($sql,$db);
		?>
			<script language="javascript">
				window.location="<?php echo $tablename."list.php";?>";
			</script>
		<?php
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
					idnamamakanan=textid.replace("foodid","namamakanan");
					idqty=textid.replace("foodid","qty");
					idprice=textid.replace("foodid","price");
					arrreturnvalue=returnvalue.split("|||");
					document.getElementById(idnamamakanan).value=arrreturnvalue[0];
					document.getElementById(idqty).value=arrreturnvalue[1];
					document.getElementById(idprice).value=arrreturnvalue[2];
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
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>RESTAURANT</b></h3></td></tr></table>
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
				<td>PPN & Service</td>
				<td>:</td>
				<td nowrap>
					<input type="checkbox" name="withppn" id="withppn" value="ss" <?php if(isset($_POST["withppn"])){echo "checked";} ?> onchange="if(this.checked==true){nett.checked=false;}">With PPN
					<input type="checkbox" name="withservice" id="withservice" value="1" <?php if(isset($_POST["withservice"])){echo "checked";} ?> onchange="if(this.checked==true){nett.checked=false;}">With Service
					<input type="checkbox" name="nett" id="nettid" value="1" <?php if(isset($_POST["nett"])){echo "checked";} ?> onchange="if(this.checked==true){withppn.checked=false;withservice.checked=false;}">NETT
				</td>
			<tr>
			<tr>
				<td nowrap>Discount</td>
				<td>:</td>
				<td>
					<select name="discname" id="discname" onchange="loaddisc(this.value);">
						<option value="">-disc-</option>
						<?php 
							$sql="SELECT name FROM mst_discount ORDER BY id";
							$hsltemp=mysql_query($sql,$db);
							while(list($_name)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $_name; ?>"><?php echo $_name; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Disc</td>
				<td>:</td>
				<td><input type="text" size="3" name="disc" id="disc"> %</td>
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
				<td><b>Kode Food/Drink</b></td>
				<td><b>Description</b></td>
				<td><b>Qty</b></td>
				<td><b>Price</b></td>
				<td><b>Keterangan</b></td>
			</tr>
			<tr id="rowdetail" class="content_ganjil">
				<td align="right"><a onclick="addrow('0','tabledetail','rowdetail','[0]');"><img src="images/collapse.gif" title="Delete" border="0"></a>  1 </td>
				<td>
					<input id="foodid[0]" type="text" name="foodid[0]" size="20">
					<img src="images/b_search.png" title="Daftar Kode Makanan" border="0" width="13" height="13"  onclick="showMakanan('foodid[0]')">
				</td>
				<td><input id="namamakanan[0]" type="text" name="namamakanan[0]" size="30" readonly></td>
				<td><input id="qty[0]" type="text" name="qty[0]" size="5" style="text-align:right;" ></td>
				<td><input id="price[0]" type="text" name="price[0]" size="20" style="text-align:right;" ></td>
				<td><input id="keterangan[0]" type="text" name="keterangan[0]" size="40"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
	</form>	
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Simpan" onclick="document.getElementById('modebutton').value='simpan';document.getElementById('formsubmit').click();">
				<input type="button" value="Reset" onclick="modebutton.value='reset';formsubmit.click();">
			</td>
		</tr>
	</table>
<?php
	if(!$_GET["editing"]){//cari kode [REST/yyyymmdd/xxx]
		$tanggal=date("Y-m-d");
		$kode="REST/".date("Ymd")."/";
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
		while($detailvalues=mysql_fetch_assoc($hsldet)){
			$no++;
			$foodid="";
			foreach ($detailvalues as $vardetailname => $valuedetail){
				$valuedetail=str_ireplace("\"","''",$valuedetail);
				if($vardetailname=="foodid"){$foodid=$valuedetail;}
				?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}
			$sql="SELECT description FROM mst_food WHERE kode='$foodid'";
			$hsltemp=mysql_query($sql,$db);
			list($namamakanan)=mysql_fetch_array($hsltemp);
			?><script language="javascript">document.getElementById("namamakanan[<?php echo $no; ?>]").value="<?php echo $namamakanan; ?>";</script><?php
		}
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
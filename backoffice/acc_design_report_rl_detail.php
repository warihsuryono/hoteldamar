<?php
	include_once "header.php";
	include_once "func.addrow.php";
	include_once "func.openwin.php";
	include_once "func_number_format.php";
	$tablename=str_ireplace("_detail.php","",basename($__phpself));
	$tabledetailname=$tablename."_detail";
	$sign=$_GET["sign"];
	$kode=$_GET["kode"];
	$sql="SHOW COLUMNS FROM $tablename";
	$hsltemp=mysql_query($sql,$db);
	list($kodename)=mysql_fetch_array($hsltemp);
	if($sign){
		$signby=$sign."by";
		$signdate=$sign."date";
		$sql="UPDATE $tablename SET $signby='$__username' , $signdate=NOW() WHERE $kodename='$kode'";
		mysql_query($sql,$db);
	}
	if($_POST["updateorder"]){
		foreach ($_POST["seqno"] as $seqno1 => $seqno2){
			if($seqno1!=$seqno2){
				$newseqno=99999+$seqno2;
				$sql="UPDATE acc_design_report_rl_detail SET seqno='$newseqno' WHERE kodedesign='$kode' AND seqno='$seqno1'";
				mysql_query($sql,$db);
			}
		}
		$sql="UPDATE acc_design_report_rl_detail SET seqno=seqno-99999 WHERE kodedesign='$kode' AND seqno>99998";
		mysql_query($sql,$db);
	}
	$sql="SHOW COLUMNS FROM $tabledetailname";
	$hsltemp=mysql_query($sql,$db);
	for($xx=0;$xx<3;$xx++){list($kodedetailname)=mysql_fetch_array($hsltemp);}
?>
	<script language="javascript">
		function update_order(seqno){
			newvalue=document.getElementById(seqno).value;
			newvalue=newvalue*1;
			seqno=seqno.replace("seqno[","");
			seqno=seqno.replace("]","");
			seqno=seqno*1;
			if(newvalue<seqno){
				for(zz=newvalue;zz<seqno;zz++){
					xx=zz*1;
					xx=xx+1;	
					document.getElementById("seqno["+zz+"]").value=xx;
				}
			}else{
				for(zz=seqno+1;zz<=newvalue;zz++){
					xx=zz*1;
					xx=xx-1;	
					document.getElementById("seqno["+zz+"]").value=xx;
				}
			}
		}
	</script>
	<form method="POST" action="<?php echo $__phpself; ?>?editing=<?php echo $_GET["editing"];?>&kode=<?php echo $_GET["kode"]; ?>">
		<input type="hidden" id="idseqno" name="idseqno">
		<table width="100%"><tr><td align="center"><h3><b>DESIGN REPORT RL</b></h3></td></tr></table>
		<table>
			<tr>
				<td>Kode Design</td>
				<td>:</td>
				<td id="kodedesign"></td>
			</tr>
			<tr>
				<td>Nama Design</td>
				<td>:</td>
				<td id="nama"></td>
			</tr>
			<tr>
				<td>Title</td>
				<td>:</td>
				<td id="title"></td>
			</tr>
			<tr>
				<td>Footer</td>
				<td>:</td>
				<td id="footer"></td>
			</tr>
		</table>
		<table class="content_table" width="100%" id="tabledetail">
			<tr class="content_header" id="rowdetail_header">
				<td width="1"><b>No</b></td>
				<td width="1"><b>Seqno</b></td>
				<td><b>Description</b></td>
				<td><b>COA</b></td>
				<td><b>Mode Value</b></td>
				<td><b>Alias</b></td>
			</tr>
			
			<tr id="rowdetail" class="content_ganjil">
				<td align="right">  1 </td>
				<td><input type="text" style="align-text:right" id="seqno[0]" name="seqno[0]" size="2" onblur="update_order(this.id);"></td>
				<td id="description[0]"></td>
				<td id="coa[0]"></td>
				<td id="modevalue[0]"></td>
				<td id="alias[0]"></td>
			</tr>
		</table>		
		<input type="hidden" id="modebutton"  name="modebutton" value="reload">
		<input type="submit" id="formsubmit" style="visibility:hidden;">
		<br>
		<input type="submit" id="formupdate" name="updateorder" value="Update Order">
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
	$sql="SELECT $selectdetail FROM $tabledetailname WHERE $kodename='$kode' ORDER BY seqno";
	$hsldet=mysql_query($sql,$db);
	$no=-1;
	while($detailvalues=mysql_fetch_assoc($hsldet)){
		$no++;
		$coa="";
		$koder="";
		foreach ($detailvalues as $vardetailname => $valuedetail){
			//if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
			if($istypedouble[$vardetailname]){$valuedetail=number_format($valuedetail);}
				$valuedetail=str_ireplace("\"","''",$valuedetail);
			if($vardetailname=="coa"){$coa=$valuedetail;}
			if($vardetailname=="koder"){$koder=$valuedetail;}
			if($vardetailname=="seqno"){
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").value="<?php echo $valuedetail; ?>";</script><?php
			}else{
			?><script language="javascript">document.getElementById("<?php echo $vardetailname; ?>[<?php echo $no; ?>]").innerHTML="<?php echo $valuedetail; ?>";</script><?php
			}
		}
		if($coa && $koder){
			$sql="SELECT description FROM acc_mst_coa WHERE coa='$coa' AND koder='$koder'";
			$hsltemp=mysql_query($sql,$db);
			list($rekening)=mysql_fetch_array($hsltemp);
			?><script language="javascript">document.getElementById("rekening[<?php echo $no; ?>]").innerHTML="<?php echo $rekening; ?>";</script><?php
		}
	}
	
	$imgnull="nosign.jpg";
	$null="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if(!is_file("signature/".$__createby)){$__createby=$imgnull;}
	if(!$_createby){$_createby=$null;}
?>
	<table width="100%">
		<tr style="text-align:left;">
			<td>Dibuat Oleh,</td>
		</tr>
		<tr style="text-align:left;vertical-align:bottom;height:80px">
			<td align="left"><img src="signature/<?php echo $__createby; ?>" width="100" height="50" border='0'></td>
		</tr>
		<tr style="text-align:left;">
			<td>(<?php echo $_createby; ?>)</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td align="center">
				<input type="button" value="Kembali" id="btnkembali" onclick="window.location='<?php echo $tablename."list.php";?>';">
				<input type="button" value="Print" id="btnprint" onclick="printthisform();">
			</td>
		</tr>
	</table>
<?php
	include_once "footer.php";
?>
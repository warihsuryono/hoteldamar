<?php
	include_once "header.php";
	include_once "func.openwin.php";
	if($_POST["create"]){
		$kas=$_POST["kas"];
		$baris=$_POST["baris"];		
		$createby=$__username;
		$createdate=$__now;
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";//kas
		$hsltemp=mysql_query($sql,$db);
		list($coakas)=mysql_fetch_array($hsltemp);
		
		$filename = "temp/kastemp.csv";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		$arrcontents=explode(chr(13).chr(10),$contents);
		$seqno=-1;
		foreach ($arrcontents as $rowno => $rowcontent){
			if($rowno>=$baris){
				$arrcols=explode(";",$rowcontent);
				$tanggal=$arrcols[0];
				$tanggal=str_ireplace(" ","",$tanggal);
				$nocek=$arrcols[1];
				$nocek=str_ireplace(" ","",$nocek);
				$coa=$arrcols[2];
				$coa=str_ireplace(" ","",$coa);
				$description=$arrcols[3];
				$nominal=$arrcols[4];
				$nominal=str_ireplace(",","",$nominal);
				$nominal=str_ireplace("Rp","",$nominal);
				$nominal=str_ireplace(" ","",$nominal);
				$koder=$arrcols[5];
				if($tanggal && $nominal){
					//02/01/12
					$nocek=substr("0000",0,4-strlen($nocek)).$nocek;
					$tgl="20".substr($tanggal,6,2).substr($tanggal,3,2).substr($tanggal,0,2);
					$tanggal="20".substr($tanggal,6,2)."-".substr($tanggal,3,2)."-".substr($tanggal,0,2);
					$kodejurnal="JURNAL/".$tgl."/";
					$sql="SELECT idseqno FROM acc_jurnal WHERE kodejurnal LIKE '$kodejurnal%' ORDER BY idseqno DESC LIMIT 1";
					$hsltemp=mysql_query($sql,$db);
					list($idseqno)=mysql_fetch_array($hsltemp);
					$idseqno++;
					$kodejurnal.=substr("000",0,3-strlen($idseqno)).$idseqno;
					$periode="20".substr($tanggal,6,2)."-".substr($tanggal,3,2)."-01";
					$actionlink="<a href=''acc_jurnaladd.php?editing=1&kode=$kodejurnal''><img src=''images/inlineedit.gif'' title=''Inline Edit'' width=''16'' height=''16'' border=''0''></a>";
					$actionlink.="&nbsp;&nbsp;<a href=''acc_jurnal_detail.php?kode=$kodejurnal''><img src=''images/view.gif'' title=''Detail'' width=''16'' height=''16'' border=''0''></a>";
					
					if($kas=="masuk"){$debit=$nominal;$kredit=0;$nocek="KM".$nocek;}
					if($kas=="keluar"){$debit=0;$kredit=$nominal;$nocek="KK".$nocek;}
					$sql="INSERT INTO acc_jurnal (kodejurnal,idseqno,tanggal,nocek,notes,createby,createdate,actionlink) VALUES ";
					$sql.="('$kodejurnal','$idseqno','$tanggal','$nocek','$description','$createby','$createdate','$actionlink')";
					mysql_query($sql,$db);
					//detail
					$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ";
					$sql.="('$kodejurnal','0','$coakas','KAS','$description','$debit','$kredit')";
					mysql_query($sql,$db);
					$sql="INSERT INTO acc_jurnal_detail (kodejurnal,seqno,coa,koder,keterangan,debit,kredit) VALUES ";
					$sql.="('$kodejurnal','1','$coa','$koder','$description','$kredit','$debit')";
					mysql_query($sql,$db);
				}
			}
		}
		?> <script language="javascript">alert("Proses Selesai!");</script> <?php
	}
?>
	<fieldset>
		<legend><b>Upload file</b></legend>
		<form enctype="multipart/form-data" method="POST" action="<?php echo $__phpself; ?>">
			<table>
				<tr>
					<td>Filename</td>
					<td>:</td>
					<td><input name="filename" type="file" size="100"></td>
				</tr>
				<tr><td colspan="3"><input type="submit" name="upload" value="Upload"></td></tr>
			</table>
		</form>
	</fieldset>
<?php
	$fileuploaded=0;
	if($_POST["upload"] && $_FILES["filename"]["tmp_name"]){
		$filename=$_FILES["filename"]["name"];
		$uploaddir="temp/kastemp.csv";
		//Copy the file to some permanent location
		if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploaddir)){
			$fileuploaded=1;
		}else{
			?> <script language="javascript">alert("There was a problem when uploding the new file.");</script> <?php
		}
	}
	if($fileuploaded || $_POST["create"]){
		$filename = "temp/kastemp.csv";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		$arrcontents=explode(chr(13).chr(10),$contents);
		?>
		<fieldset>
			<legend><b>Jurnal Detail</b></legend>
			<form method="POST" action="<?php echo $__phpself; ?>">
				<table>
					<tr>
						<td>Jenis Kas</td>
						<td>:</td>
						<td nowrap>						
							<select name="kas">
								<option value="masuk">Kas Masuk</option>
								<option value="keluar">Kas Keluar</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Baris Pertama</td>
						<td>:</td>
						<td>
							<select name="baris">
								<option value="">- Pilih Baris -</option>
								<?php
									foreach ($arrcontents as $seqno => $value){
										?><option value="<?php echo $seqno; ?>">[<?php echo $seqno; ?>] <?php echo $value; ?></option><?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr><td colspan="3"><input type="submit" name="create" value="Create"></td></tr>
				</table>
			</form>
		</fieldset>
		<?php
	}
	include_once "footer.php";
?>
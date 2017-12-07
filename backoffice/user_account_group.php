<?php
	include_once "header.php";
	if(sanitasi($_GET["delete"])){
		$username=sanitasi($_GET["username"]);
		$sql="DELETE FROM user_account WHERE username='$username'";
		mysql_query($sql,$db);
		$sql="DELETE FROM user_group WHERE username='$username'";
		mysql_query($sql,$db);
		echo "<font color='blue'>User Account And User Group Deleted!</font>";
	}
	if(sanitasi($_POST["ubah"])){
		$_GET["edit"]="";
		$username=sanitasi($_POST["username"]);
		$nama=sanitasi($_POST["nama"]);
		$password=sanitasi($_POST["password"]);
		$nik=sanitasi($_POST["nik"]);
		$hp1=sanitasi($_POST["hp1"]);
		$hp2=sanitasi($_POST["hp2"]);
		//$gudang=sanitasi($_POST["gudang"]);
		$group=sanitasi($_POST["group"]);
		if(!$username || !$password || !$group){
			echo "<font color='red'>Invalid Information!</font>";
		}else{
			//edit photo
			$updatephoto="";
			$photoext=substr($_FILES["photo"]["name"],-3);
			$basephotofile="$username".".$photoext";
			$photofile="photo/$basephotofile";
			if($_FILES["photo"]["name"]){
				$updatephoto=",photo='$basephotofile'";
				if(move_uploaded_file($_FILES["photo"]["tmp_name"], $photofile)){
					$message.="<br><font color='blue'>File photo terupload!</font>";
				}else{
					$message.="<br><font color='red'>Ada masalah dalam mengupload file photo!</font>";
				}
			}
			//edit signature
			$updatesignature="";
			$signatureext=substr($_FILES["signature"]["name"],-3);
			$basesignaturefile="$username".".$signatureext";
			$signaturefile="signature/$basesignaturefile";
			if($_FILES["signature"]["name"]){
				$updatesignature=",signature='$basesignaturefile'";
				if(move_uploaded_file($_FILES["signature"]["tmp_name"], $signaturefile)){
					$message.="<br><font color='blue'>File signature terupload!</font>";
				}else{
					$message.="<br><font color='red'>Ada masalah dalam mengupload file signature!</font>";
				}
			}
			//$sql="UPDATE user_account SET nama='$nama',password='$password',nik='$nik',gudang='$gudang' $updatephoto $updatesignature WHERE username='$username'";
			$sql="UPDATE user_account SET nama='$nama',password='$password',nik='$nik',hp1='$hp1',hp2='$hp2' $updatephoto $updatesignature WHERE username='$username'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				$message.="<br><font color='blue'>User Account Changed </font>";
			}else{
				$message.="<br><font color='red'>Change User Account Failed! </font>";
			}
			
			$sql="UPDATE user_group SET id_group='$group' WHERE username='$username'";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				$message.="<br><font color='blue'>User Group Changed </font>";
			}else{
				$message.="<br><font color='red'>Change User Group Failed</font>";
			}
			
			echo $message;
		}
	}
	if(sanitasi($_POST["simpan"])){
		$_GET["tambah"]="";
		$username=sanitasi($_POST["username"]);
		$nama=sanitasi($_POST["nama"]);
		$password=sanitasi($_POST["password"]);
		$nik=sanitasi($_POST["nik"]);
		$hp1=sanitasi($_POST["hp1"]);
		$hp2=sanitasi($_POST["hp2"]);
		//$gudang=sanitasi($_POST["gudang"]);
		$group=sanitasi($_POST["group"]);
		if(!$username || !$password || !$group){
			echo "<font color='red'>Invalid Information!</font>";
		}else{
			//$sql="INSERT INTO user_account (username,password,nama,nik,gudang,photo,signature) VALUES ('$username','$password','$nama','$nik','$gudang','$photo','$signature')";
			$sql="INSERT INTO user_account (username,password,nama,nik,hp1,hp2,photo,signature) VALUES ('$username','$password','$nama','$nik','$hp1','$hp2','$photo','$signature')";
			mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				$sql="INSERT INTO user_group (username,id_group) VALUES ('$username','$group')";
				mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
					echo "<font color='blue'>User Account And Group Saved!</font>";
				}else{
					$sql="DELETE FROM user_account WHERE username='$username'";
					mysql_query($sql,$db);
					$sql="DELETE FROM user_group WHERE username='$username' AND id_group='$group'";
					mysql_query($sql,$db);
					echo "<font color='red'>Saving Group Failed!</font>";
				}
				
				//edit photo
				$updatephoto="";
				$photoext=substr($_FILES["photo"]["name"],-3);
				$basephotofile="$username".".$photoext";
				$photofile="photo/$basephotofile";
				if($_FILES["photo"]["name"]){
					if(move_uploaded_file($_FILES["photo"]["tmp_name"], $photofile)){
						$message.="<br><font color='blue'>File photo terupload!</font>";
						$sql="UPDATE user_account SET photo='$basephotofile' WHERE username='$username'";
						mysql_query($sql,$db);
					}else{
						$message.="<br><font color='red'>Ada masalah dalam mengupload file photo!</font>";
					}
				}
				//edit signature
				$updatesignature="";
				$signatureext=substr($_FILES["signature"]["name"],-3);
				$basesignaturefile="$username".".$signatureext";
				$signaturefile="signature/$basesignaturefile";
				if($_FILES["signature"]["name"]){
					if(move_uploaded_file($_FILES["signature"]["tmp_name"], $signaturefile)){
						$message.="<br><font color='blue'>File signature terupload!</font>";
						$sql="UPDATE user_account SET signature='$basesignaturefile' WHERE username='$username'";
						mysql_query($sql,$db);
					}else{
						$message.="<br><font color='red'>Ada masalah dalam mengupload file signature!</font>";
					}
				}
			}else{
				echo "<font color='red'>Saving User Account Failed!</font>";
			}
		}
	}
	$username=sanitasi($_POST["username"]);
	$nama=sanitasi($_POST["nama"]);
	$password=sanitasi($_POST["password"]);
	$nik=sanitasi($_POST["nik"]);
	$hp1=sanitasi($_POST["hp1"]);
	$hp2=sanitasi($_POST["hp2"]);
	//$gudang=sanitasi($_POST["gudang"]);
	$photo=sanitasi($_POST["photo"]);
	$signature=sanitasi($_POST["signature"]);
	$group=sanitasi($_POST["group"]);
?>
<?php
	if(sanitasi($_GET["edit"])=="1"){
		if(sanitasi($_GET["isreload"])!="1"){
			$username=sanitasi($_GET["username"]);
			$sql="SELECT ";
				$sql.="user_account.username, ";
				$sql.="user_account.password, ";
				$sql.="user_account.nama, ";
				$sql.="user_account.nik, ";
				$sql.="user_account.hp1, ";
				$sql.="user_account.hp2, ";
				//$sql.="user_account.gudang, ";
				$sql.="user_account.photo, ";
				$sql.="user_account.signature, ";
				$sql.="user_group.id_group, ";
				$sql.="`group`.`group` ";
			$sql.="FROM ";
				$sql.="user_account ";
				$sql.="INNER JOIN user_group ON (user_account.username = user_group.username) ";
				$sql.="INNER JOIN `group` ON (user_group.id_group = `group`.id_group) ";
			$sql.="WHERE ";
				$sql.="user_account.username='$username'";
			$hsluser=mysql_query($sql,$db);
			//list($username,$password,$nama,$nik,$gudang,$photo,$signature,$group,$namagroup)=mysql_fetch_array($hsluser);
			list($username,$password,$nama,$nik,$hp1,$hp2,$photo,$signature,$group,$namagroup)=mysql_fetch_array($hsluser);
			$photo="photo/$photo";
			$signature="signature/$signature";
		}
?>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?edit=1&username=<?php echo $username; ?>&isreload=1" enctype="multipart/form-data">
		<input type="hidden" name="username" value="<?php echo $username; ?>">
		<table>
			<tr>
				<td><b>Username</b></td>
				<td><b>:</b></td>
				<td><b><?php echo $username; ?></b></td>
			</tr>
			<tr>
				<td><b>Password</b></td>
				<td><b>:</b></td>
				<td><input type="password" name="password" value="<?php echo $password; ?>"></td>
			</tr>
			<tr>
				<td><b>Nama</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
			</tr>
			<tr>
				<td><b>NIK</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="nik" value="<?php echo $nik; ?>"></td>
			</tr>
			<tr>
				<td><b>HP1</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="hp1" value="<?php echo $hp1; ?>"></td>
			</tr>
			<tr>
				<td><b>HP2</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="hp2" value="<?php echo $hp2; ?>"></td>
			</tr>
			<!--tr>
				<td><b>Cabang</b></td>
				<td><b>:</b></td>
				<td>
					<select name="gudang">
						<option value="">-gudang-</option>
						<?php
							$sql="SELECT `kode`,`nama`,alamat FROM `mst_gudang` ORDER BY nama";
							$hsltemp=mysql_query($sql,$db);
							while(list($id,$nama,$alamat)=mysql_fetch_array($hsltemp)){
								$gudang="$nama, $alamat";
						?>
							<option value="<?php echo $id; ?>" <?php if($id==$gudang){echo "selected";} ?>><?php echo $gudang; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr-->
			<tr>
				<td><b>Group</b></td>
				<td><b>:</b></td>
				<td>
					<select name="group">
						<option value="">-group-</option>
						<?php
							$sql="SELECT `id_group`,`group` FROM `group` WHERE id_group!=1 ORDER BY `group`";
							$hsltemp=mysql_query($sql,$db);
							while(list($id,$nama)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $id; ?>" <?php if($id==$group){echo "selected";} ?>><?php echo $nama." [$id]"; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<?php if(is_file($photo)){ ?>
			<tr><td><img src="<?php echo $photo; ?>" width="100" height="200" border='0'></td></tr>
			<?php } ?>
			<tr><td><b>Photo</b></td><td><b>:</b></td><td><input name="photo" type="file"></td></tr>
			<?php if(is_file($signature)){ ?>
			<tr><td><img src="<?php echo $signature; ?>" width="100" height="50" border='0'></td></tr>
			<?php } ?>
			<tr><td><b>Signature</b></td><td><b>:</b></td><td><input name="signature" type="file"></td></tr>
			<tr>
				<td colspan="3" align="center"><input type="submit" name="ubah" value="Simpan"></td>
			</tr>
		</table>
	</form>
<?php
	}
?>
<?php
	if(sanitasi($_GET["tambah"])=="1"){
?>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?tambah=1" enctype="multipart/form-data">
		<table>
			<tr>
				<td><b>Username</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="username" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td><b>Password</b></td>
				<td><b>:</b></td>
				<td><input type="password" name="password" value="<?php echo $password; ?>"></td>
			</tr>
			<tr>
				<td><b>Name</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
			</tr>
			<tr>
				<td><b>NIK</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="nik" value="<?php echo $nik; ?>"></td>
			</tr>
			<tr>
				<td><b>HP1</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="hp1" value="<?php echo $hp1; ?>"></td>
			</tr>
			<tr>
				<td><b>HP2</b></td>
				<td><b>:</b></td>
				<td><input type="text" name="hp2" value="<?php echo $hp2; ?>"></td>
			</tr>
			<!--tr>
				<td><b>Cabang</b></td>
				<td><b>:</b></td>
				<td>
					<select name="gudang">
						<option value="">-gudang-</option>
						<?php
							$sql="SELECT `kode`,`nama`,alamat FROM `mst_gudang` ORDER BY nama";
							$hsltemp=mysql_query($sql,$db);
							while(list($id,$nama,$alamat)=mysql_fetch_array($hsltemp)){
								$gudang="$nama, $alamat";
						?>
							<option value="<?php echo $id; ?>" <?php if($id==$gudang){echo "selected";} ?>><?php echo $gudang; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr-->
			<tr>
				<td><b>Group</b></td>
				<td><b>:</b></td>
				<td>
					<select name="group">
						<option value="">-group-</option>
						<?php
							$sql="SELECT `id_group`,`group` FROM `group` WHERE id_group!=1 ORDER BY `group`";
							$hsltemp=mysql_query($sql,$db);
							while(list($id,$nama)=mysql_fetch_array($hsltemp)){
						?>
							<option value="<?php echo $id; ?>" <?php if($id==$group){echo "selected";} ?>><?php echo $nama." [$id]"; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<?php if(is_file($photo)){ ?>
			<tr><td><img src="<?php echo $photo; ?>" width="100" height="200" border='0'></td></tr>
			<?php } ?>
			<tr><td><b>Photo</b></td><td><b>:</b></td><td><input name="photo" type="file"></td></tr>
			<?php if(is_file($signature)){ ?>
			<tr><td><img src="<?php echo $signature; ?>" width="100" height="50" border='0'></td></tr>
			<?php } ?>
			<tr><td><b>Signature</b></td><td><b>:</b></td><td><input name="signature" type="file"></td></tr>
			<tr>
				<td colspan="3" align="center"><input type="submit" name="simpan" value="Simpan"></td>
			</tr>
		</table>
	</form>
<?php
	}else{
?>
<br>
<input type="button" value="Tambah" onclick="window.location='<?php echo $_SERVER["PHP_SELF"];?>?tambah=1';">
<?php
	}
?>
<table border="1" class="content_table">
	<tr class="content_header">
		<td><b>No</b></td>
		<td><b>Username</b></td>
		<td><b>Name</b></td>
		<td><b>Nik</b></td>
		<td><b>HP1</b></td>
		<td><b>HP2</b></td>
		<!--td><b>Cabang</b></td-->
		<td><b>Group</b></td>
		<td><b>Action</b></td>
	</tr>
	<?php
		$sql="SELECT ";
			$sql.="user_account.username, ";
			$sql.="user_account.nama, ";
			$sql.="user_account.nik, ";
			$sql.="user_account.hp1, ";
			$sql.="user_account.hp2, ";
			//$sql.="user_account.gudang, ";
			$sql.="user_group.id_group, ";
			$sql.="`group`.`group` ";
		$sql.="FROM ";
			$sql.="user_account ";
			$sql.="INNER JOIN user_group ON (user_account.username = user_group.username) ";
			$sql.="INNER JOIN `group` ON (user_group.id_group = `group`.id_group) ";
		$sql.="WHERE user_account.username!='superuser' ";
		$sql.="ORDER BY user_account.username";
		$hsluser=mysql_query($sql,$db);
		$no=0;
		//while(list($username,$nama,$nik,$gudang,$id_group,$group)=mysql_fetch_array($hsluser)){
		while(list($username,$nama,$nik,$hp1,$hp2,$id_group,$group)=mysql_fetch_array($hsluser)){
			$no++;
			// $sql="SELECT kode,nama,alamat FROM `mst_gudang` ORDER BY nama";
			// $hsltemp=mysql_query($sql,$db);
			// list($id,$nama,$alamat)=mysql_fetch_array($hsltemp);
			// $namagudang="$nama, $alamat";
	?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $username; ?></td>
			<td><?php echo $nama; ?></td>
			<td><?php echo $nik; ?></td>
			<td><?php echo $hp1; ?></td>
			<td><?php echo $hp2; ?></td>
			<!--td><?php echo $namagudang; ?></td-->
			<td><?php echo $group; ?></td>
			<td>
				<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?edit=1&username=<?php echo $username; ?>">Edit</a>
				|
				<a href="#" onclick="if(confirm('Anda yakin menghapus data?')){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?delete=1&username=<?php echo $username; ?>';}">Delete</a>
			</td>
		</tr>
	<?php
		}
	?>
</table>
<?php
	include_once "footer.php";
?>
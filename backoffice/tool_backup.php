<?php include_once "header.php"; ?>
<?php
	$restore=sanitasi($_GET["restore"]);
	$uploadfile=sanitasi($_POST["uploadfile"]);
	$id=sanitasi($_GET["id"]);
	$backup=sanitasi($_GET["backup"]);
	$description=sanitasi($_GET["desc"]);
	if($restore=="ok"){
		$sql="SELECT description,filename FROM trx_backup WHERE id='$id'";
		$hsltemp=mysql_query($sql,$db);
		list($description,$_filename)=mysql_fetch_array($hsltemp);
		$filename = "backup/$_filename";
		if(filesize($filename)>1){
			$password="";			
			if($pass!=""){
				$password="-p $pass";
			}
			//backup trx_backup
			// $shell="D:/xampp/mysql/bin/mysqldump -u $user $password --database bluefish --table trx_backup > backup/temp_trx_backup.sql";
			$shell=$mysqlbinpath."mysqldump -u $user $password --database bluefish --table trx_backup > backup/temp_trx_backup.sql";
			exec($shell);
			
			//restore database
			// $shell="D:/xampp/mysql/bin/mysql -u $user $password bluefish < $filename";
			$shell=$mysqlbinpath."mysql -u $user $password bluefish < $filename";
			exec($shell);
			
			//restore trx_backup
			// $shell="D:/xampp/mysql/bin/mysql -u $user $password bluefish < backup/temp_trx_backup.sql";
			$shell=$mysqlbinpath."mysql -u $user $password bluefish < backup/temp_trx_backup.sql";
			exec($shell);
			?>
				<script language="javascript">
					alert("Database '<?php echo $description; ?>' telah di restore!");
				</script>
			<?php
		}else{
			?>
				<script language="javascript">
					alert("Database '<?php echo $description; ?>' Kosong!");
				</script>
			<?php
		}
		
	}
	if($backup=="ok"){
		$updateby=$_SESSION["username"];
		$document_root=$_SERVER["SCRIPT_FILENAME"];
		$basename=basename($document_root);
		$dir=str_ireplace ( $basename, "", $document_root )."backup/";
		$filename=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).date("Ymdhis").".sql";
		$_filename=$dir.$filename;
		$password="";			
		if($pass!=""){
			$password="-p $pass";
		}
		// $shell="D:/xampp/mysql/bin/mysqldump -u $user $password bluefish > $_filename";
		$shell=$mysqlbinpath."mysqldump -u $user $password bluefish > $_filename";
		//echo $shell;
		exec($shell);
		$sql="INSERT INTO trx_backup (description,filename,updateby,updatedate) VALUES ('$description','$filename','$updateby',NOW())";
		mysql_query($sql,$db);
		$id=mysql_insert_id($db);
		?>
			<script language="javascript">
				window.open('tool_backup_download.php?id=<?php echo $id; ?>','mywindow','width=1,height=1')
			</script>
		<?php
	}
	if($uploadfile){
		$target = "backup/bakal_restore.sql";
		if(move_uploaded_file($_FILES["filerestore"]["tmp_name"], $target)){
			if(filesize($target)>1){
				$password="";			
				if($pass!=""){
					$password="-p $pass";
				}
				//backup trx_backup
				// $shell="D:/xampp/mysql/bin/mysqldump -u $user $password --database bluefish --table trx_backup > backup/temp_trx_backup.sql";
				$shell=$mysqlbinpath."mysqldump -u $user $password --database bluefish --table trx_backup > backup/temp_trx_backup.sql";
				exec($shell);
				
				//restore database
				// $shell="D:/xampp/mysql/bin/mysql -u $user $password bluefish < $target";
				$shell=$mysqlbinpath."mysql -u $user $password bluefish < $target";
				exec($shell);
				
				//restore trx_backup
				// $shell="D:/xampp/mysql/bin/mysql -u $user $password bluefish < backup/temp_trx_backup.sql";
				$shell=$mysqlbinpath."mysql -u $user $password bluefish < backup/temp_trx_backup.sql";
				exec($shell);
				?>
					<script language="javascript">
						alert("Backup '<?php echo $_FILES["filerestore"]["name"]; ?>' telah di restore!");
					</script>
				<?php
			}else{
				?>
					<script language="javascript">
						alert("Database '<?php echo $_FILES["filerestore"]["name"]; ?>' Kosong!");
					</script>
				<?php
			}
		}else{
			?>
				<script language="javascript">
					alert("Ada masalah dalam mengupload file!Silakan ulangi lagi!");
				</script>
			<?php
		}
	}
?>
<table>
	<tr>
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>"  enctype="multipart/form-data">
		<td><b>Restore From File</b></td>			
		<td><b>:</b></td>
		<td><input type="file" name="filerestore"><input type="submit" name="uploadfile" value="restore"></td>
		</form>
	</tr>
	<tr>
		<td><b>Description</b></td>
		<td><b>:</b></td>
		<td><input type="text" id="description" name="description" size="60"></td>
		<td><input type="button" value="Backup" onclick="window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?backup=ok&desc='+document.getElementById('description').value;"></td>
	</tr>
</table>
<table border="1">
	<tr>
		<td><b>No</b></td>
		<td><b>Date</b></td>
		<td><b>Description</b></td>
		<td nowrap><b>BackUp By</b></td>
		<td><b>Action</b></td>
	</tr>
	<?php 
		$sql="SELECT id,description,filename,updatedate,updateby FROM trx_backup ORDER BY updatedate DESC";
		$hslbackup=mysql_query($sql,$db);
		$no=0;
		while(list($id,$description,$filename,$updatedate,$updateby)=mysql_fetch_array($hslbackup)){
			$sql="SELECT nama FROM user_account WHERE username='$updateby'";
			$hsltemp=mysql_query($sql,$db);
			list($updateby)=mysql_fetch_array($hsltemp);
			$no++;
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $updatedate; ?></td>
					<td><?php echo $description; ?></td>
					<td><?php echo $updateby; ?>&nbsp;</td>
					<td>
						<input type="button" value="restore" onclick="window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?restore=ok&id=<?php echo $id; ?>';">
						<input type="button" value="download" onclick="window.open('tool_backup_download.php?id=<?php echo $id; ?>','mywindow','width=1,height=1')">
					</td>
				</tr>
			<?php
		}
	?>
</table>
<?php include_once "footer.php"; ?>

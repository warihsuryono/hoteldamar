<?php
	include_once "header.php";
	if(sanitasi($_POST["update"])){
		$oldpassword=sanitasi($_POST["oldpassword"]);
		$newpassword=sanitasi($_POST["newpassword"]);
		$confirmpassword=sanitasi($_POST["confirmpassword"]);
		if($newpassword!=$confirmpassword){
			echo "<font color='red'>Invalid New Password!</font>";
		}else{
			$sql="SELECT password FROM user_account WHERE username='".$_SESSION["username"]."'";
			$hsltemp=mysql_query($sql,$db);
			list($_oldpassword)=mysql_fetch_array($hsltemp);
			if($_oldpassword!=$oldpassword){
				echo "<font color='red'>Invalid Old Password!</font>";
			}else{
				$sql="UPDATE user_account SET password='$newpassword' WHERE username='".$_SESSION["username"]."'";
				mysql_query($sql,$db);
				if(mysql_affected_rows($db)>0){
					echo "<font color='blue'>Password Changed!</font>";
				}else{
					echo "<font color='red'>Change Password Failed!</font>";
				}
			}
		}
	}
?>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<table>
			<tr>
				<td nowrap><b>Username</b></td>
				<td nowrap><b>:</b></td>
				<td nowrap><b><?php echo $_SESSION["username"] ;?></b></td>
			</tr>
			<tr>
				<td nowrap><b>Old Password</b></td>
				<td nowrap><b>:</b></td>
				<td nowrap><input type="password" name="oldpassword"></td>
			</tr>		
			<tr>
				<td nowrap><b>New Password</b></td>
				<td nowrap><b>:</b></td>
				<td nowrap><input type="password" name="newpassword"></td>
			</tr>
			<tr>
				<td nowrap><b>Confirm New Password</b></td>
				<td nowrap><b>:</b></td>
				<td nowrap><input type="password" name="confirmpassword"></td>
			</tr>
			<tr>
				<td colspan="3"><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
	
<?php
	include_once "footer.php";
?>
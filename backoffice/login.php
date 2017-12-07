<?php
	include_once ("header.php");
	include_once ("login_action.php");
?>
<?php
	if(!$_SESSION['loggedin']){
?>
		<form method="POST" action="<?php echo $PHP_SELF; ?>">
			<table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="white" style="border:2px solid #7ac314; padding:6px 3px; xcolor:#FFF; font-size:30px; font-weight:bold; background:URL(./images/bg_pass.gif) repeat-x;">
				<tr>
					<td colspan="3" align="center">
						<b><font size="1">LOGIN</font></b>
					</td>
				</tr>
				<tr>
					<td><font size="1">Username</font></td>
					<td><font size="1">:</font></td>
					<td><input class="text" type="text" name="username"></td>
				</tr>
				<tr>
					<td><font size="1">Password</font></td>
					<td><font size="1">:</font></td>
					<td><input class="text" type="password" name="password"></td>
				</tr>
				<tr>
					<td colspan=3 align="center">
					<input type="submit" name="login" value="Login" style="font-family:tahoma; font-size:12px; color:#0b7130; font-weight:bold; background:URL(./images/tbl.gif); border:2px solid #fff; width:100px; height: 25px; cursor: pointer;">
					</td>
				</tr>
			</table>
		</form>
<?php
	} else {
		$main_content="home.php";
		include_once ($main_content);
	}
	include_once ("footer.php");
?>
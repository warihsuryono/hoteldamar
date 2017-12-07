	<?php
		include_once "header.php";
		
		if($_POST['update']){
			$sql="DELETE FROM menu_group WHERE id_group=$_POST[id_group]";
			mysql_query($sql,$db);
			foreach($_POST['checkbox'] as $value => $key){
				if($key=="on"){
				$sql="INSERT INTO menu_group (id_group,id_menu) VALUES ($_POST[id_group],$value)";
				mysql_query($sql,$db);
				}
			}
			$_GET['id_group']=$_POST['id_group'];
			echo "<meta http-equiv='refresh' content='0; URL=grouplist.php'>";
			exit;
		}
		$sql="SELECT * FROM menu WHERE id_parent=0 ORDER BY seqno";
		$hslmenu=mysql_query($sql,$db);
		
		
		
		$sql="SELECT `group` FROM `group` WHERE id_group=$_GET[id_group]";
		$hsl=mysql_query($sql,$db);
		list($group)=mysql_fetch_array($hsl);
	?>
		
		<script language="javascript">
			function checkuncheckchild(thisno,numchild){
				for(i=0;i<=numchild;i++){
					if(document.getElementById("idcheckbox_" + thisno).checked){
						document.getElementById("idcheckboxchild_" + thisno + "_" + i).checked=true;
					}else{
						document.getElementById("idcheckboxchild_" + thisno + "_" + i).checked=false;
					}
				}
			}			
		</script>
		<table width="100%" border="0">
	<tr>
		<td valign='top' width=50% class="pad">			
			<form method="POST" action="<?php echo $PHP_SELF;?>">
				<input type="hidden" name="id_group" value="<?php echo $_GET['id_group'];?>">
				<fieldset id="contentxx"><legend><b>MENU PRIVILEGE [<?php echo $group; ?>]</b></legend>
				<table>
					<?php
						$aa=-1;
						while ($rsmenu=mysql_fetch_array($hslmenu)){
							$aa++;
							$sql="SELECT * FROM menu_group WHERE id_group='$_GET[id_group]' AND id_menu='$rsmenu[id_menu]'";
							$hslpriv=mysql_query($sql,$db);
							$checked="";
							if(mysql_affected_rows($db)>0){
								$checked="checked";
							}
							$sql="SELECT * FROM menu WHERE id_parent=$rsmenu[id_menu]";
							$hslmenu2=mysql_query($sql,$db);
							$jumbb=mysql_num_rows($hslmenu2);
					?>
						<tr>
							<td nowrap>
								<input onchange="checkuncheckchild('<?php echo $aa; ?>','<?php echo $jumbb; ?>');" id="idcheckbox_<?php echo $aa; ?>" type="checkbox" name="checkbox[<?php echo $rsmenu['id_menu']; ?>]" <?php echo $checked; ?> >
								<b><?php echo $aa+1; ?>.</b>
							</td>
							<td nowrap>
								<b><?php echo $rsmenu['caption']; ?></b>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;
							</td>
							<td colspan="2">
								<table>
						<?php
							$sql="SELECT * FROM menu WHERE id_parent=$rsmenu[id_menu] ORDER BY seqno";
							$hslmenu2=mysql_query($sql,$db);
							$bb=-1;
							while ($rsmenu2=mysql_fetch_array($hslmenu2)){
								$bb++;
								$sql="SELECT * FROM menu_group WHERE id_group='$_GET[id_group]' AND id_menu='$rsmenu2[id_menu]'";
								$hslpriv=mysql_query($sql,$db);
								$checked="";
								if(mysql_affected_rows($db)>0){
									$checked="checked";
								}
						?>
							<tr>
								<td nowrap>
									<input id="idcheckboxchild_<?php echo $aa; ?>_<?php echo $bb; ?>" type="checkbox" name="checkbox[<?php echo $rsmenu2['id_menu']; ?>]" <?php echo $checked; ?>>
									<b><?php echo $bb+1; ?>.</b>
								</td>
								<td nowrap>
									<b><?php echo $rsmenu2['caption']; ?></b>
								</td>
							</tr>
							
							<!--#########-->
							<tr>
								<td>
									&nbsp;
								</td>
								<td colspan="2">
									<table>
							<?php
								$sql="SELECT * FROM menu WHERE id_parent=$rsmenu2[id_menu] ORDER BY seqno";
								$hslmenu3=mysql_query($sql,$db);
								$cc=-1;
								while ($rsmenu3=mysql_fetch_array($hslmenu3)){
									$cc++;
									$sql="SELECT * FROM menu_group WHERE id_group='$_GET[id_group]' AND id_menu='$rsmenu3[id_menu]'";
									$hslpriv=mysql_query($sql,$db);
									$checked="";
									if(mysql_affected_rows($db)>0){
										$checked="checked";
									}
							?>
								<tr>
									<td nowrap>
										<input id="idcheckboxchild_<?php echo $aa; ?>_<?php echo $bb; ?>_<?php echo $cc; ?>" type="checkbox" name="checkbox[<?php echo $rsmenu3['id_menu']; ?>]" <?php echo $checked; ?>>
										<b><?php echo $cc+1; ?>.</b>
									</td>
									<td nowrap>
										<b><?php echo $rsmenu3['caption']; ?></b>
									</td>
								</tr>
							<?php
								}
							?>
									</table>
								</td>
							</tr>
							<!--#########-->
							
							
							
						<?php
							}
						?>
								</table>
							</td>
						</tr>						
					<?php
						}
					?>
				</table>
				<table>
					<tr>
						<td style="padding:5px 0 5px 90px;">
							<input class="xsubmit" type="submit" name="update" value="Update">
						</td>
					</tr>
				</table>
				</fieldset>
			</form>
		</td>
	</tr>
</table>
<?php include_once "footer.php"; ?>
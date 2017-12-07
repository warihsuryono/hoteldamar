<?php include_once "header.php";?>
<?php
	if(sanitasi($_GET['menubox'])){
		$menu_id=sanitasi($_GET['menubox']);
		$sql="UPDATE menu SET menubox = NOT menubox WHERE id_menu='$menu_id' AND status='1'";
		mysql_query($sql,$db);
		$sql="SELECT count(id_menu) FROM menu WHERE menubox='1' AND status='1'";
		$hsltemp=mysql_query($sql,$db);
		list($tempjum)=mysql_fetch_array($hsltemp);
		if($tempjum>10){
			$sql="UPDATE menu SET menubox = NOT menubox WHERE id_menu='$menu_id'";
			mysql_query($sql,$db);
			?>
				<script language="javascript">
					alert("Menu Box Maximum 10 Item, Silakan nonaktifkan Menu Box yang lain terlebih dahulu!");
				</script>
			<?php
		}
	}
	if($_POST['add']){
		//cari seqno
		$sql="SELECT seqno FROM menu WHERE id_parent='$_POST[id_parent]' ORDER BY seqno DESC LIMIT 0,1";
		$hsltemp=mysql_query($sql,$db);
		list($seqno)=mysql_fetch_array($hsltemp);
		$seqno++;
		$sql="INSERT INTO menu (seqno,caption,id_parent,url,status) VALUES ('$seqno','$_POST[caption]','$_POST[id_parent]','$_POST[url]','$_POST[status]')";
		mysql_query($sql,$db);
	}
	if($_POST['edit']){
		$sql="UPDATE menu SET caption='$_POST[caption]',id_parent=$_POST[id_parent],url='$_POST[url]',status='$_POST[status]' WHERE id_menu=$_POST[editid]";
		mysql_query($sql,$db);
	}


	if($_GET['deleteid']){
		$sql="DELETE FROM menu WHERE id_menu=$_GET[deleteid]";
		mysql_query($sql,$db);
	}
	if($_GET['up']){	
		$sql="SELECT id_parent FROM menu WHERE id_menu=$_GET[id]";
		$hsl=mysql_query($sql,$db);
		list($id_parent)=mysql_fetch_array($hsl);
		$seqno=$_GET['up']-1;
		$sql="UPDATE menu SET seqno=$_GET[up] WHERE id_parent=$id_parent AND seqno=$seqno";
		//echo "<br>$sql";
		mysql_query($sql,$db);
		$sql="UPDATE menu SET seqno=$seqno WHERE id_menu=$_GET[id]";
		//echo "<br>$sql";
		mysql_query($sql,$db);		
	}
	if($_GET['down']){
		$sql="SELECT id_parent FROM menu WHERE id_menu=$_GET[id]";
		$hsl=mysql_query($sql,$db);
		list($id_parent)=mysql_fetch_array($hsl);
		$seqno=$_GET['down']+1;
		$sql="UPDATE menu SET seqno=$_GET[down] WHERE id_parent=$id_parent AND seqno=$seqno";
		//echo "<br>$sql";
		mysql_query($sql,$db);
		$sql="UPDATE menu SET seqno=$seqno WHERE id_menu=$_GET[id]";
		//echo "<br>$sql";
		mysql_query($sql,$db);		
	}
	$sql="SELECT * FROM menu WHERE id_parent=0 ORDER BY seqno";
	$hslmenu=mysql_query($sql,$db);
	$_jum_baris=0;
?>
	<table width="100%" border="0">
		<tr>
			<td class="pad" width="50%">
				<fieldset><legend><b>MENU EDITOR</b></legend>
				<table class="table2">
					<tr>
						<td nowrap colspan="4">
							<b><a href="?addmenu=1&#captionadd">[Add Menu]</a></b>
						<td>
					</tr>
					<tr>
						<td nowrap colspan="4">
							<?php
								if(count($_GET)>0){
							?>
								<b><a href="?#"> [Cancel Action]</a></b>
							<?php
								}
							?>
						</td>
					</tr>
					<?php
						if($_GET['addmenu']){
							$_jum_baris++;
					?>
						<a name="captionadd">
						<tr>
							<td width=1%></td>
							<form method="post" action="<?php echo $PHP_SELF; ?>">
								<input type="hidden" name="addid" value="0">
								<input type="hidden" name="id_parent" value="0">
								<td nowrap>
									caption: <input type="text" name="caption" id="captionadd"> 
									url: <input type="text" name="url">
									status:
										<select name="status">
											<option value="1">Active</option>
											<option value="0">Not Active</option>
										</select>
									<input type="submit" class="xsubmit" name="add" value="Add">
								</td>
								
							</form>
						</tr>
						<script language="javascript">
							document.getElementById("captionadd").focus();
						</script>
					<?php
						}
					?>
					<?php
						while ($rsmenu=mysql_fetch_array($hslmenu)){
							$_jum_baris++;
							$palingatas=true;
							$sql="SELECT seqno FROM menu WHERE seqno<$rsmenu[seqno] AND id_parent=$rsmenu[id_parent] AND Status=1";
							$hsltemp=mysql_query($sql,$db);
							if(mysql_affected_rows($db)>0){$palingatas=false;}
							$palingbawah=true;
							$sql="SELECT seqno FROM menu WHERE seqno>$rsmenu[seqno] AND id_parent=$rsmenu[id_parent] AND Status=1";
							$hsltemp=mysql_query($sql,$db);
							if(mysql_affected_rows($db)>0){$palingbawah=false;}
					?>
							<tr>
								<td class="tdkepala"><b><?php echo $rsmenu['seqno']; ?>.</b></td>
								<?php
									if($_GET['editid']!=$rsmenu['id_menu']){
								?>
									<td nowrap class="tdkepala">
										<?php if($rsmenu['status']=="0"){echo "<i>";} ?>
										<b><?php echo $rsmenu['caption']; ?></b>
										<?php if($rsmenu['status']=="0"){echo "</i>";} ?>
										[url: <?php echo $rsmenu['url']; ?>]
										<?php 
											$sql="SELECT menubox FROM menu WHERE id_menu='".$rsmenu['id_menu']."'";
											$hslmenubox=mysql_query($sql,$db);
											list($_menubox)=mysql_fetch_array($hslmenubox);
											if($_menubox){$show_menu_box="<i>Show In Menu Box</i>";}else{$show_menu_box="";}
											echo $show_menu_box; 
										?>
									</td>
								<?php
									}
								?>
								<?php
									if($_GET['editid']==$rsmenu['id_menu']){
								?>
									<a name="captionedit">
									<td width=1% class="tdkepala"></td>
									<form method="post" action="<?php echo $PHP_SELF; ?>">
										<input type="hidden" name="editid" value="<?php echo $rsmenu['id_menu']; ?>">
										<input type="hidden" name="id_parent" value="<?php echo $rsmenu['id_parent']; ?>">
										<td nowrap class="tdkepala">
											caption: <input type="text" name="caption" value="<?php echo $rsmenu['caption']; ?>" id="captionedit"> 
											url: <input type="text" name="url" value="<?php echo $rsmenu['url']; ?>">
											status: 
												<select name="status">
													<option value="1" <?php if($rsmenu['status']=="1"){echo "selected";} ?>>Active</option>
													<option value="0" <?php if($rsmenu['status']=="0"){echo "selected";} ?>>Not Active</option>
												</select>
											<input class="xsubmit" type="submit" name="edit" value="Save">
										</td>
										
									</form>
									<script language="javascript">
										document.getElementById("captionedit").focus();
									</script>
								<?php
									}
								?>
								<td nowrap class="tdkepala">
									<a href="?menubox=<?php echo $rsmenu['id_menu']; ?>">
										[Menu Box Toggle]
									</a>
									<?php 
										//if($rsmenu['status']==1){
									?>
									<a href="?addid=<?php echo $rsmenu['id_menu']; ?>&#subcaptionadd">
										[Add Submenu]
									</a>
									<?php
										//}
									?>
									<a href="?editid=<?php echo $rsmenu['id_menu']; ?>&#captionedit">
										[Edit]
									</a>
									<a href="#" onclick="if(confirm('Anda yakin!!')){window.location='<?php echo $PHP_SELF; ?>?deleteid=<?php echo $rsmenu['id_menu']; ?>';}">
										[Delete]
									</a>
									<?php
										if(!$palingatas){
									?>
									<a href="?up=<?php echo $rsmenu['seqno']; ?>&id=<?php echo $rsmenu['id_menu']; ?>">
										[Up]
									</a>
									<?php
										}
									?>
									<?php
										if(!$palingbawah){
									?>
									<a href="?down=<?php echo $rsmenu['seqno']; ?>&id=<?php echo $rsmenu['id_menu']; ?>">
										[Down]
									</a>
									<?php
										}
									?>
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
								while ($rsmenu2=mysql_fetch_array($hslmenu2)){
									$_jum_baris++;
									$palingatas2=true;
									$sql="SELECT seqno FROM menu WHERE seqno<$rsmenu2[seqno] AND id_parent=$rsmenu2[id_parent] AND Status=1";
									$hsltemp=mysql_query($sql,$db);
									if(mysql_affected_rows($db)>0){$palingatas2=false;}
									$palingbawah2=true;
									$sql="SELECT seqno FROM menu WHERE seqno>$rsmenu2[seqno] AND id_parent=$rsmenu2[id_parent] AND Status=1";
									$hsltemp=mysql_query($sql,$db);
									if(mysql_affected_rows($db)>0){$palingbawah2=false;}
							?>
									<tr>
										<td><b><?php echo $rsmenu2['seqno']; ?>.</b></td>
										<?php
											if($_GET['editid']!=$rsmenu2['id_menu']){
										?>
										<td nowrap>											
											<?php if($rsmenu2['status']=="0"){echo "<i>";} ?>
											<b><?php echo $rsmenu2['caption']; ?></b>
											<?php if($rsmenu2['status']=="0"){echo "</i>";} ?>
											[url: <?php echo $rsmenu2['url']; ?>]
											<?php 
												$sql="SELECT menubox FROM menu WHERE id_menu='".$rsmenu2['id_menu']."'";
												$hslmenubox2=mysql_query($sql,$db);
												list($_menubox2)=mysql_fetch_array($hslmenubox2);
												if($_menubox2){$show_menu_box2="<i>Show In Menu Box</i>";}else{$show_menu_box2="";}
												echo $show_menu_box2; 
											?>
										</td>
										<?php
											}
										?>
										<?php
											if($_GET['editid']==$rsmenu2['id_menu']){
										?>
											<a name="subcaptionedit">
											<td width=1%></td>
											<form method="post" action="<?php echo $PHP_SELF; ?>">
												<input type="hidden" name="editid" value="<?php echo $rsmenu2['id_menu']; ?>">
												<td nowrap class="tdkepala">
													caption: <input type="text" name="caption" value="<?php echo $rsmenu2['caption']; ?>" id="subcaptionedit"> 
													parent: 
													<select name="id_parent">
														<option value="0">[0]MainMenu</option>
														<?php 
															$sql="SELECT id_menu,caption FROM menu WHERE id_parent=0 ORDER BY seqno";
															$hsltemp=mysql_query($sql,$db);
															while($rsparent=mysql_fetch_array($hsltemp)){
														?>
																<option value="<?php echo $rsparent['id_menu']; ?>" <?php if($rsmenu2['id_parent']==$rsparent['id_menu']){echo "selected";} ?>>[<?php echo $rsparent['id_menu']; ?>]<?php echo $rsparent['caption']; ?></option>
														<?php
															}
														?>
													</select>
													url: <input type="text" name="url" value="<?php echo $rsmenu2['url']; ?>">
													status:
														<select name="status">
															<option value="1" <?php if($rsmenu2['status']==1){echo "selected";} ?>>Active</option>
															<option value="0" <?php if($rsmenu2['status']==0){echo "selected";} ?>>Not Active</option>
														</select>
													<input class="xsubmit" type="submit" name="edit" value="save">
												</td>
												
											</form>
											<script language="javascript">
												document.getElementById("subcaptionedit").focus();
											</script>
										<?php
											}
										?>
										<td nowrap>											
											<a href="?menubox=<?php echo $rsmenu2['id_menu']; ?>">
												[Menu Box Toggle]
											</a>
											<a href="?addid=<?php echo $rsmenu2['id_menu']; ?>&#subcaptionadd">
												[Add Submenu]
											</a>
											<a href="?editid=<?php echo $rsmenu2['id_menu']; ?>&#subcaptionedit">
												[Edit]
											</a>
											<a href="#" onclick="if(confirm('Anda yakin!!')){window.location='<?php echo $PHP_SELF; ?>?deleteid=<?php echo $rsmenu2['id_menu']; ?>';}">
												[Delete]
											</a>
											<?php
												if(!$palingatas2){
											?>
											<a href="?up=<?php echo $rsmenu2['seqno']; ?>&id=<?php echo $rsmenu2['id_menu']; ?>">
												[Up]
											</a>
											<?php
												}
											?>
											<?php
												if(!$palingbawah2){
											?>
											<a href="?down=<?php echo $rsmenu2['seqno']; ?>&id=<?php echo $rsmenu2['id_menu']; ?>">
												[Down]
											</a>
											<?php
												}
											?>
										</td>
									</tr>
									
									
												<!--#######################-->
												<tr>
													<td>
														&nbsp;
													</td>
													<td colspan="2">
														<table>
												<?php
													$sql="SELECT * FROM menu WHERE id_parent=$rsmenu2[id_menu] ORDER BY seqno";
													$hslmenu3=mysql_query($sql,$db);
													while ($rsmenu3=mysql_fetch_array($hslmenu3)){
														$_jum_baris++;
														$palingatas3=true;
														$sql="SELECT seqno FROM menu WHERE seqno<$rsmenu3[seqno] AND id_parent=$rsmenu3[id_parent] AND Status=1";
														$hsltemp=mysql_query($sql,$db);
														if(mysql_affected_rows($db)>0){$palingatas3=false;}
														$palingbawah3=true;
														$sql="SELECT seqno FROM menu WHERE seqno>$rsmenu3[seqno] AND id_parent=$rsmenu3[id_parent] AND Status=1";
														$hsltemp=mysql_query($sql,$db);
														if(mysql_affected_rows($db)>0){$palingbawah3=false;}
												?>
														<tr>
															<td><b><?php echo $rsmenu3['seqno']; ?>.</b></td>
															<?php
																if($_GET['editid']!=$rsmenu3['id_menu']){
															?>
															<td nowrap>																
																<?php if($rsmenu3['status']=="0"){echo "<i>";} ?>
																<b><?php echo $rsmenu3['caption']; ?></b>
																<?php if($rsmenu3['status']=="0"){echo "</i>";} ?>
																[url: <?php echo $rsmenu3['url']; ?>]
																<?php 
																	$sql="SELECT menubox FROM menu WHERE id_menu='".$rsmenu3['id_menu']."'";
																	$hslmenubox3=mysql_query($sql,$db);
																	list($_menubox3)=mysql_fetch_array($hslmenubox3);
																	if($_menubox3){$show_menu_box3="<i>Show In Menu Box</i>";}else{$show_menu_box3="";}
																	echo $show_menu_box3; 
																?>
															</td>
															<?php
																}
															?>
															<?php
																if($_GET['editid']==$rsmenu3['id_menu']){
															?>
																<a name="subcaptionedit">
																<td width=1%></td>
																<form method="post" action="<?php echo $PHP_SELF; ?>">
																	<input type="hidden" name="editid" value="<?php echo $rsmenu3['id_menu']; ?>">
																	<td nowrap class="tdkepala">
																		caption: <input type="text" name="caption" value="<?php echo $rsmenu3['caption']; ?>" id="subcaptionedit"> 
																		parent: 
																		<select name="id_parent">
																			<option value="0">[0]MainMenu</option>
																			<?php 
																				$sql="SELECT id_menu,caption FROM menu ORDER BY seqno";
																				$hsltemp=mysql_query($sql,$db);
																				while($rsparent=mysql_fetch_array($hsltemp)){
																			?>
																					<option value="<?php echo $rsparent['id_menu']; ?>" <?php if($rsmenu3['id_parent']==$rsparent['id_menu']){echo "selected";} ?>>[<?php echo $rsparent['id_menu']; ?>]<?php echo $rsparent['caption']; ?></option>
																			<?php
																				}
																			?>
																		</select>
																		url: <input type="text" name="url" value="<?php echo $rsmenu3['url']; ?>">
																		status:
																			<select name="status">
																				<option value="1" <?php if($rsmenu3['status']==1){echo "selected";} ?>>Active</option>
																				<option value="0" <?php if($rsmenu3['status']==0){echo "selected";} ?>>Not Active</option>
																			</select>
																		<input class="xsubmit" type="submit" name="edit" value="save">
																	</td>
																	
																</form>
																<script language="javascript">
																	document.getElementById("subcaptionedit").focus();
																</script>
															<?php
																}
															?>
															<td nowrap>
																<a href="?menubox=<?php echo $rsmenu3['id_menu']; ?>">
																	[Menu Box Toggle]
																</a>
																<a href="?addid=<?php echo $rsmenu3['id_menu']; ?>&#subcaptionadd">
																	[Add Submenu]
																</a>
																<a href="?editid=<?php echo $rsmenu3['id_menu']; ?>&#subcaptionedit">
																	[Edit]
																</a>
																<a href="#" onclick="if(confirm('Anda yakin!!')){window.location='<?php echo $PHP_SELF; ?>?deleteid=<?php echo $rsmenu3['id_menu']; ?>';}">
																	[Delete]
																</a>
																<?php
																	if(!$palingatas3){
																?>
																<a href="?up=<?php echo $rsmenu2['seqno']; ?>&id=<?php echo $rsmenu2['id_menu']; ?>">
																	[Up]
																</a>
																<?php
																	}
																?>
																<?php
																	if(!$palingbawah3){
																?>
																<a href="?down=<?php echo $rsmenu3['seqno']; ?>&id=<?php echo $rsmenu3['id_menu']; ?>">
																	[Down]
																</a>
																<?php
																	}
																?>
															</td>
														</tr>
													
												<?php
													}
												?>
														</table>
													</td>
												</tr>
												<?php
													if($_GET['addid']==$rsmenu2['id_menu']){
														$_jum_baris++;
												?>
													<a name="subcaptionadd">
													<tr>
														<td width=1%></td>
														<form method="post" action="<?php echo $PHP_SELF; ?>">
															<input type="hidden" name="addid" value="<?php echo $rsmenu2['id_menu']; ?>">
															<input type="hidden" name="id_parent" value="<?php echo $rsmenu2['id_menu']; ?>">
															<td nowrap class="tdkepala">
																caption: <input type="text" name="caption" id="subcaptionadd"> 
																url: <input type="text" name="url">
																status:
																	<select name="status">
																		<option value="1">Active</option>
																		<option value="0">Not Active</option>
																	</select>
																<input class="xsubmit"type="submit" name="add" value="Add">
															</td>
															
														</form>
													</tr>
													<script language="javascript">
														document.getElementById("subcaptionadd").focus();
													</script>
												<?php
													}
												?>
												<!--#######################-->
														
									
								
							<?php
								}
							?>
									</table>
								</td>
							</tr>
							<?php
								if($_GET['addid']==$rsmenu['id_menu']){
									$_jum_baris++;
							?>
								<a name="subcaptionadd">
								<tr>
									<td width=1%></td>
									<form method="post" action="<?php echo $PHP_SELF; ?>">
										<input type="hidden" name="addid" value="<?php echo $rsmenu['id_menu']; ?>">
										<input type="hidden" name="id_parent" value="<?php echo $rsmenu['id_menu']; ?>">
										<td nowrap class="tdkepala">
											caption: <input type="text" name="caption" id="subcaptionadd"> 
											url: <input type="text" name="url">
											status:
												<select name="status">
													<option value="1">Active</option>
													<option value="0">Not Active</option>
												</select>
											<input class="xsubmit"type="submit" name="add" value="Add">
										</td>
										
									</form>
								</tr>
								<script language="javascript">
									document.getElementById("subcaptionadd").focus();
								</script>
							<?php
								}
							?>
					<?php
						}
					?>
				</table>
				</fieldset>
			</td>
		</tr>
	</table>
<?php include_once "footer.php";?>
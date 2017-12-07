<?php
	include_once "header.php";
	$_idmenuclick=$_GET["idmenuclick"];
	if($_idmenuclick!=""){$_SESSION["id_parent_menu"]=$_idmenuclick;}
	$id_parent=$_SESSION["id_parent_menu"];
	if(!$id_parent){$id_parent=0;}
	$sql="SELECT id_parent FROM menu WHERE id_menu='$id_parent'";
	$hsltemp=mysql_query($sql,$db);
	list($id_grandparent)=mysql_fetch_array($hsltemp);
	$id_menu_granted="";
	foreach($_SESSION["id_menu_granted"] as $id => $val){
		$id_menu_granted.="'$id',";
	}
	$id_menu_granted=substr($id_menu_granted,0,strlen($id_menu_granted)-1);
	
	if($_SESSION["id_group"]==1){
		$sql="SELECT id_menu,caption,url,icon FROM menu WHERE id_parent='$id_parent' AND status=1 ORDER BY seqno";
	}else{
		$sql="SELECT id_menu,caption,url,icon FROM menu WHERE id_parent='$id_parent' AND id_menu IN ($id_menu_granted) AND status=1 ORDER BY seqno";
	}
	$hslmenu=mysql_query($sql,$db);
	if(mysql_affected_rows($db)<=0 && $_SESSION["loggedin"]){
		if(!$_GET["urlmenuclick"]){$_GET["urlmenuclick"]="mainmenu.php?idmenuclick=0";}
		?><script language="javascript">window.location="<?php echo $_GET["urlmenuclick"]; ?>";</script><?php
		exit;
	}
	$seqno=-1;
	if($id_grandparent!=""){
		$seqno++;
		$arrmenu_id[0]=$id_grandparent;
		$arrmenu_caption[0]="..";
		$arrmenu_url[0]=$url;
		$arrmenu_icon[0]=$icon;
	}
	while(list($id_menu,$caption,$url,$icon)=mysql_fetch_array($hslmenu)){
		$seqno++;
		$arrmenu_id[$seqno]=$id_menu;
		$arrmenu_caption[$seqno]=$caption;
		$arrmenu_url[$seqno]=$url;
		$arrmenu_icon[$seqno]=$icon;
	}
	echo "<table width='700'>";
	$looping=true;
	$seqno=-1;
	while($looping){
		echo "<tr>";
		for($col=0;$col<4;$col++){
			$seqno++;
			if($seqno>=count($arrmenu_id)){$looping=false;break;}else{
				echo "<td align='center'>";
					$icon=$arrmenu_icon[$seqno];
					$id_menu=$arrmenu_id[$seqno];
					$url_menu=$arrmenu_url[$seqno];
					$icon2=$icon;
					if(!$icon){$icon="default.gif";$icon2="default2.gif";}
					?>
						<img src="menuicon/<?php echo $icon; ?>" width="50" height="50" alt="" onclick="window.location='<?php $_SERVER["PHP_SELF"]; ?>?idmenuclick=<?php echo $id_menu;?>&urlmenuclick=<?php echo $url_menu;?>';" onmouseover="this.src='menuicon/<?php echo $icon2; ?>';" onmouseout="this.src='menuicon/<?php echo $icon; ?>';">
						<br>
						<?php echo $arrmenu_caption[$seqno];?>
					<?php
				echo "</td>";
			}
		}
		echo "</tr>";
		echo "<tr><td height='30'></td></tr>";
	}
	echo "</table>";
?>
<?php
	include_once "footer.php";
?>
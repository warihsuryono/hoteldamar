<script src="./TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<?php 
include_once "connect.php";
echo "
<script language=\"javascript\" type=\"text/javascript\">
	objTreeMenu_1 = new TreeMenu(\"./images\", \"objTreeMenu_1\", \"main_frame\", \"treeMenuDefault\", true, false);
";
$_jum_baris=0;
$sql="SELECT * FROM menu WHERE id_parent=0 AND status=1 ORDER BY seqno";
$hslmain=mysql_query($sql,$db);
while($rsmain=mysql_fetch_array($hslmain)){
	$id_menu=$rsmain['id_menu'];
	$caption=str_ireplace("'","`",$rsmain['caption']);
	$sql="SELECT url FROM menu WHERE id_menu=$id_menu";
	$hsl=mysql_query($sql,$db);
	list($mainsrc)=mysql_fetch_array($hsl);
	$mainsrc.="?x_idmenu=$id_menu";
	if(($_SESSION['id_menu_granted'][$id_menu] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
		echo "\n\rnewNode$id_menu = objTreeMenu_1.addItem(new TreeNode('$caption', 'folder.gif', '$mainsrc', true, true, '', '', 'folder-expanded.gif'));";
		echo "\n\rnewNode$id_menu.setEvent('onclick', '');";
		echo "\n\rnewNode$id_menu.setEvent('onexpand', '');";
		$_jum_baris++;
		$id_parent=$rsmain['id_menu'];
		$sql="SELECT * FROM menu WHERE id_parent=$id_parent AND status=1 ORDER BY seqno";//echo $sql;	
		$hslsub=mysql_query($sql,$db);
		while($rssub=mysql_fetch_array($hslsub)){
			$id_submenu=$rssub['id_menu'];
			$subcaption=str_ireplace("'","`",$rssub['caption']);
			$sql="SELECT url FROM menu WHERE id_menu=$id_submenu";
			$hsl=mysql_query($sql,$db);
			list($mainsrc)=mysql_fetch_array($hsl);
			$mainsrc.="?x_idmenu=$id_submenu";
			if(($_SESSION['id_menu_granted'][$id_submenu] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
				echo "\n\rnewNode_$id_submenu = newNode$id_parent.addItem(new TreeNode('$subcaption', 'folder.gif', '$mainsrc', false, true, '', '', 'folder-expanded.gif'));";
				echo "\n\rnewNode_$id_submenu.setEvent('onclick', '');";
				echo "\n\rnewNode_$id_submenu.setEvent('onexpand', '');";
				$_jum_baris++;
				$id_parent2=$rssub['id_menu'];
				$sql="SELECT * FROM menu WHERE id_parent=$id_parent2 AND status=1 ORDER BY seqno";//echo $sql;	
				$hslsub2=mysql_query($sql,$db);
				while($rssub2=mysql_fetch_array($hslsub2)){
					$id_submenu2=$rssub2['id_menu'];
					$subcaption2=str_ireplace("'","`",$rssub2['caption']);
					$sql="SELECT url FROM menu WHERE id_menu=$id_submenu2";
					$hsl2=mysql_query($sql,$db);
					list($mainsrc2)=mysql_fetch_array($hsl2);
					$mainsrc2.="?x_idmenu=$id_submenu2";
					if(($_SESSION['id_menu_granted'][$id_submenu2] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
						echo "\n\rnewNode_$id_submenu2 = newNode_$id_parent2.addItem(new TreeNode('$subcaption2', 'folder.gif', '$mainsrc2', false, true, '', '', 'folder-expanded.gif'));";
						echo "\n\rnewNode_$id_submenu2.setEvent('onclick', '');";
						echo "\n\rnewNode_$id_submenu2.setEvent('onexpand', '');";
						$_jum_baris++;
					}
				}
			}
		}
	}
}
if($_SESSION['loggedin']!=""){
	echo "\n\rnewNode$id_menu = objTreeMenu_1.addItem(new TreeNode('LOGOUT', 'folder.gif', 'login.php?logout=1', false, false, '', '', 'folder-expanded.gif'));";
	echo "\n\rnewNode$id_menu.setEvent('onclick', '');";
	echo "\n\rnewNode$id_menu.setEvent('onexpand', '');";
}else{
	// echo "\n\rnewNode$id_menu = objTreeMenu_1.addItem(new TreeNode('LOGIN', 'folder.gif', 'login.php', false, false, '', '', 'folder-expanded.gif'));";
	// echo "\n\rnewNode$id_menu.setEvent('onclick', '');";
	// echo "\n\rnewNode$id_menu.setEvent('onexpand', '');";
}
echo "	
	
	objTreeMenu_1.drawMenu();
	objTreeMenu_1.writeOutput();
	objTreeMenu_1.resetBranches();
</script>";
?>
<script language="javascript">
	var currentmenu;
	var currentsubmenu;
	function showsubmenu(iddivmenu,idmainmenu,tambah_top_menu){
		// alert(document.getElementById("menu_table_id").style.borderCollapse);
		// document.getElementById("menu_table_id").style.borderCollapse="collapse";		
		if(currentmenu==iddivmenu){currentmenu=null;}
		if(currentmenu){
			document.getElementById(currentmenu).style.visibility='hidden';
		}
		if(currentsubmenu){
			document.getElementById(currentsubmenu).style.visibility='hidden';
			currentsubmenu='';
		}
		if(currentmenu!=iddivmenu){
			// postop=document.getElementById(idmainmenu).offsetTop+115;
			postop=document.getElementById(idmainmenu).offsetTop+15;
			posleft=document.getElementById(idmainmenu).offsetLeft-10;
			document.getElementById(iddivmenu).style.top=postop+'px';
			document.getElementById(iddivmenu).style.left=posleft+'px';	
			var myField = document.getElementById(iddivmenu);
			var myClass = myField.className;
			myClass = "menu_table";
			myField.className = myClass;
			document.getElementById(iddivmenu).style.visibility='visible';
			currentmenu=iddivmenu;
		}else{
			document.getElementById(iddivmenu).style.visibility='hidden';
			currentmenu='';			
		}
	}
	function showsubmenu2(iddivmenu,idmainmenu,idsubmenu,tambah_top_menu){		
		if(currentsubmenu==iddivmenu){currentsubmenu=null;}
		if(currentsubmenu){
			document.getElementById(currentsubmenu).style.visibility='hidden';
		}
		if(currentsubmenu!=iddivmenu){
			var postop=tambah_top_menu;
			// postop=document.getElementById(idsubmenu).offsetTop+125;
			postop=document.getElementById(idsubmenu).offsetTop+25;
			if(postop>399){postop=399;}
			posleft=document.getElementById(idmainmenu).offsetLeft+100;
			document.getElementById(iddivmenu).style.top=postop+'px';
			document.getElementById(iddivmenu).style.left=posleft+'px';
			var myField = document.getElementById(iddivmenu);
			var myClass = myField.className;
			myClass = "menu_table";
			myField.className = myClass;
			document.getElementById(iddivmenu).style.visibility='visible';
			currentsubmenu=iddivmenu;
		}else{
			document.getElementById(iddivmenu).style.visibility='hidden';
			currentsubmenu='';
		}
	}
</script>
<?php 
	include_once "connect.php";
	$__tambah_top_menu=370;
	$_jum_baris=0;
	$sql="SELECT * FROM menu WHERE id_parent=0 AND status=1 ORDER BY seqno";
	$hslmain=mysql_query($sql,$db);
	if($_SESSION['loggedin']!=""){
	echo "<b>&nbsp;&nbsp;&nbsp;&nbsp; | ";
	}
	while($rsmain=mysql_fetch_array($hslmain)){
		$id_menu=$rsmain['id_menu'];
		$caption="<font color='white'>".$rsmain['caption']."</font>";
		$sql="SELECT url FROM menu WHERE id_menu=$id_menu";
		$hsl=mysql_query($sql,$db);
		list($mainsrc)=mysql_fetch_array($hsl);
		$mainsrc.="?x_idmenu=$id_menu";
		// $mainsrc="index.php?x_idmenu=$id_menu";
		if(($_SESSION['id_menu_granted'][$id_menu] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
			echo "<a href='$mainsrc' onclick=\"showsubmenu('','','','0');\" target=\"main_frame\" onmouseover=\"showsubmenu('submenu$id_menu','menu$id_menu','$__tambah_top_menu');\" id=\"menu$id_menu\">$caption</a>";
			echo " | ";
			$_jum_baris++;
			$id_parent=$rsmain['id_menu'];
			$sql="SELECT * FROM menu WHERE id_parent=$id_parent AND status=1 ORDER BY seqno";//echo $sql;	
			$hslsub=mysql_query($sql,$db);
			echo "<div style='solid;position:absolute;visibility:hidden;' id='submenu$id_menu'>";
				echo "<table>";
					$arridsub1=array();
					while($rssub=mysql_fetch_array($hslsub)){
						$id_submenu=$rssub['id_menu'];
						$subcaption=$rssub['caption'];
						$sql="SELECT url FROM menu WHERE id_menu=$id_submenu";
						$hsl=mysql_query($sql,$db);
						list($mainsrc)=mysql_fetch_array($hsl);
						$mainsrc.="?x_idmenu=$id_submenu";
						// $mainsrc="index.php?x_idmenu=$id_submenu";
						if(($_SESSION['id_menu_granted'][$id_submenu] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
							$sql="SELECT * FROM menu WHERE id_parent=$id_submenu AND status=1 ORDER BY seqno";//echo $sql."<br>";
							mysql_query($sql,$db);
							if(mysql_affected_rows($db)>0){
								//$immage="<img src='images/add.png' style=\"border:0;\">";
								$expand_sub="<img src='images/next.gif' width='10' height='10' style=\"border:0;\">";
							}else{
								//$immage="";
								$expand_sub="";
							}
							echo "<tr><td width='15'>$menu_icon</td><td id=\"menu$id_submenu\"><a href='$mainsrc' onclick=\"showsubmenu('','','','0');\" target=\"main_frame\" onmouseover=\"showsubmenu2('submenu$id_submenu','menu$id_menu','menu$id_submenu','$__tambah_top_menu');\">$subcaption &nbsp;&nbsp;&nbsp;&nbsp;$expand_sub</a></td></tr>";
							$_jum_baris++;
							$id_parent2=$rssub['id_menu'];
							$arridsub1[$id_parent2]=1;
						}
					}
				echo "</table>";
			echo "</div>";
			
			foreach($arridsub1 as $id_parent2 => $value){
				$sql="SELECT * FROM menu WHERE id_parent=$id_parent2 AND status=1 ORDER BY seqno";//echo $sql."<br>";
				$hslsub2=mysql_query($sql,$db);
				echo "<div style='solid;position:absolute;visibility:hidden;' id='submenu$id_parent2'>";
					echo "<table>";
						while($rssub2=mysql_fetch_array($hslsub2)){
							$id_submenu2=$rssub2['id_menu'];
							$subcaption2=$rssub2['caption'];
							$sql="SELECT url FROM menu WHERE id_menu=$id_submenu2";//echo $sql."<br>";
							$hsl2=mysql_query($sql,$db);
							list($mainsrc2)=mysql_fetch_array($hsl2);
							$mainsrc2.="?x_idmenu=$id_submenu2";
							// $mainsrc2="index.php?x_idmenu=$id_submenu2";
							if(($_SESSION['id_menu_granted'][$id_submenu2] && $_SESSION['loggedin']!="") || $_SESSION['id_group']=="1"){
								echo "<tr><td width='15'>$menu_icon</td><td><a href='$mainsrc2' target=\"main_frame\" onclick=\"showsubmenu('','','','0');\">$subcaption2</a></td></tr>";
								$_jum_baris++;
							}
						}
					echo "</table>";
				echo "</div>";
			}
		}
	}
	if($_SESSION['loggedin']!=""){
		echo "<a href='login.php?logout=1' target=\"main_frame\" id=\"logbutton_id\" onmouseover=\"showsubmenu('','','','$__tambah_top_menu');\"><font color='white'>LOGOUT</font></a>";
		echo " | </b>";
	}else{
		echo "<b> | <a href='login.php' target=\"main_frame\" id=\"logbutton_id\" onmouseover=\"showsubmenu('','','','$__tambah_top_menu');\"><font color='white'>LOGIN</font></a>";
		echo " | </b>";
	}
?>

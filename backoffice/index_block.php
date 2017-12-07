<center><img src="http://www.jalurkerja.com/attachments/Web-under-construction.jpg" width="1000"></center><?php exit();?>
<?php
	include_once "frameheader.php";
		if(sanitasi($_GET['w_idmenu'])!=""){
			$_SESSION['x_idmenu']=sanitasi($_GET['w_idmenu']);
		}
		if($_SESSION['x_idmenu']!=""){
			$_idmenu=$_SESSION['x_idmenu'];
			$sql="SELECT url FROM menu WHERE id_menu = '$_idmenu'";
			$hsltemp=mysql_query($sql,$db);
			list($src_frame)=mysql_fetch_array($hsltemp);
			//if($src_frame=="#" || $src_frame==""){$src_frame="home.php";}
			$src_frame.="?x_idmenu=$_idmenu";
		}else{
			//$src_frame="home.php";
			$src_frame="mainmenu.php";
		}
?>
	<iframe scrolling="no" id="main_frame_id" name="main_frame" src="<?php echo $src_frame; ?>" xwidth="785" xheight="445" frameborder="0" marginwidth="0" marginheight="0" onmouseover="showsubmenu('','','','0');"></iframe>
<?php
	include_once "framefooter.php";
?>
<?php if($_SESSION["loggedin"]){ ?>
<script language="javascript">
	// alert("Jangan lakukan perubahan data dahulu, Sistem dalam proses maintenance!!! Terima Kasih [Warih Hadi Suryono]");
	//alert("Mohon maaf, sedang ada proses maintenance, kemungkinan akan selesai pada tanggal 09/03/2012 pukul 13:00, mohon jangan melakukan perubahan data  (Silakan jika hanya ingin melihat saja...)!!! Terima Kasih [Warih Hadi Suryono]");
	var iframe_location=window.parent.document.getElementById('main_frame_id').contentWindow.location+"#";
	//alert(iframe_location);
	//http://localhost/bluefish/index.php?w_idmenu=1#?x_idmenu=77#
	if(iframe_location.indexOf("#")>11){
		window.parent.document.getElementById('main_frame_id').src="mainmenu.php?idmenuclick=<?php echo $_GET['x_idmenu']; ?>";
	}
</script>
<?php } ?>
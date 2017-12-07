		<table id="table_footer_id"><tr><td></td></tr></table>
		<table cellspacing="0" cellpadding="0"><tr><td><div id="ewAddOptDialog" class="phpmaker"></div></td></tr></table>
		<script type="text/javascript">
		<!--
		ewDom.getElementsByClassName(EW_TABLE_CLASS, "TABLE", null, ew_SetupTable); // init the table
		ew_InitDialog(); // Init the dialog

		//-->
		</script>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</body>
</html>

<?php
	//UBAH CONTENT TITLE
	$_idmenu=sanitasi($_GET['x_idmenu']);
	$_fileurl=basename($_SERVER["PHP_SELF"]);
	//$_SESSION['x_idmenu']=$_idmenu;
	if(!$_idmenu){
		$sql="SELECT id_parent,caption FROM menu WHERE url LIKE '%$_fileurl%'";
		$hsltemp=mysql_query($sql,$db);
		list($_idparent,$_content_title)=mysql_fetch_array($hsltemp);
		if($_idparent){
			$sql="SELECT id_parent,caption FROM menu WHERE id_menu = '$_idparent'";
			$hsltemp=mysql_query($sql,$db);
			list($_idparent,$content_title1)=mysql_fetch_array($hsltemp);
			$_content_title=$content_title1." :: ".$_content_title;
			if($_idparent){
				$sql="SELECT id_parent,caption FROM menu WHERE id_menu = '$_idparent'";
				$hsltemp=mysql_query($sql,$db);
				list($_idparent,$content_title2)=mysql_fetch_array($hsltemp);
				$_content_title=$content_title2." :: ".$_content_title;
			}
		}
	}else{
		$_SESSION['x_idmenu']=$_idmenu;
		$sql="SELECT id_parent,caption FROM menu WHERE id_menu = '$_idmenu'";
		$hsltemp=mysql_query($sql,$db);
		list($_idparent,$_content_title)=mysql_fetch_array($hsltemp);
		if($_idparent){
			$sql="SELECT id_parent,caption FROM menu WHERE id_menu = '$_idparent'";
			$hsltemp=mysql_query($sql,$db);
			list($_idparent,$content_title1)=mysql_fetch_array($hsltemp);
			$_content_title=$content_title1." :: ".$_content_title;
			if($_idparent){
				$sql="SELECT id_parent,caption FROM menu WHERE id_menu = '$_idparent'";
				$hsltemp=mysql_query($sql,$db);
				list($_idparent,$content_title2)=mysql_fetch_array($hsltemp);
				$_content_title=$content_title2." :: ".$_content_title;
			}
		}
	}
	$_togglesearchname=substr(str_ireplace(".php","",basename($_SERVER["PHP_SELF"])),0,-4)."_list";
	if(basename($_SERVER["PHP_SELF"])=="home.php"){
		?> <script language="javascript"> window.parent.document.getElementById('closebutton_id').style.visibility="hidden"; </script> <?php
	}else{
		?> <script language="javascript"> window.parent.document.getElementById('closebutton_id').style.visibility="visible"; </script> <?php
	}
?>
<script language="javascript">
	window.parent.document.getElementById('main_frame_id').width="";
	window.parent.document.getElementById('main_frame_id').height="";
	var iframe_heightx=content_body_id.scrollHeight;
	var iframe_height=content_body_id.scrollHeight;
	var iframe_widthx=content_body_id.scrollWidth;
	var iframe_width=content_body_id.scrollWidth;
	iframe_height=iframe_height+20;
	iframe_width=iframe_width+20;
	if(iframe_height>560){
		//window.parent.document.getElementById('main_frame_id').height=560;
		window.parent.document.getElementById('main_frame_id').height=iframe_height;
	} else {
		window.parent.document.getElementById('main_frame_id').height=iframe_height;
	}
	if(iframe_width>1100){
		//window.parent.document.getElementById('main_frame_id').width=1100;
		window.parent.document.getElementById('main_frame_id').width=iframe_width;
	}else{
		window.parent.document.getElementById('main_frame_id').width=iframe_width;
	}
	
	window.parent.document.getElementById('content_title_id').innerHTML="<?php echo $_content_title; ?>";
	// window.parent.document.getElementById('content_title_id').innerHTML=iframe_widthx+"X"+iframe_heightx+"==>"+iframe_width+"X"+iframe_height;
	/* function cek_koordinat(){
		var screen_Y=event.screenY-247;
		var screen_X=event.screenX-231;
		var arrtemp = window.parent.document.getElementById('content_title_id').innerHTML.split(",");
		var koordinat = window.parent.document.getElementById('content_title_id').innerHTML+","+screen_X+","+screen_Y;
		if(arrtemp.length>3){
			koordinat="";
		}
		//window.parent.document.getElementById('content_title_id').innerHTML="<?php echo $_content_title; ?> ("+koordinat+")";
		window.parent.document.getElementById('content_title_id').innerHTML=koordinat;
	} */
	ew_ToggleSearchPanel(<?php echo $_togglesearchname; ?>);
	window.parent.document.getElementById('head_page').focus();
</script>

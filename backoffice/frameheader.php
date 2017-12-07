<?php include_once "connect.php"; ?>
<?php include("config.php"); ?>
<?php include("login_action.php"); ?>
<html>
	<head>
	<title><?php echo $___title; ?></title>
<!--link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/container/assets/skins/sam/container.css"-->
<link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon"> 
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="generator" content="warih_logic">
</head>
<body xclass="yui-skin-sam" id="parent_body_id">
	<input id="head_page" style="width:0px;height:0px;position:absolute">
<!--script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script-->
<!--script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script-->
<?php include_once "ajax.init.php"; ?>
<script type="text/javascript">
	function change_menu_left_menu(mode) {
		var xmlHttp;
		xmlHttp=initializexmlHttp();
		xmlHttp.onreadystatechange=function() {
			if(xmlHttp.readyState==4) {
				document.getElementById('change_menu_left_menu_id').value=xmlHttp.responseText;
			}
		}
		xmlHttp.open("GET","ajax.change_menu_left_menu.php?mode="+mode,true);
		xmlHttp.send(null);
	}
	function showLeftMenu(leftcolomid,idx_leftmenu){
		if(document.getElementById(leftcolomid+idx_leftmenu).style.visibility=='hidden'){
			document.getElementById('imgtoggleid'+idx_leftmenu).src='images/prev.gif';
			document.getElementById(leftcolomid+idx_leftmenu).style.position='';
			document.getElementById(leftcolomid+idx_leftmenu).style.visibility='visible';
			change_menu_left_menu(idx_leftmenu);
		}else{
			document.getElementById('imgtoggleid'+idx_leftmenu).src='images/next.gif';
			document.getElementById(leftcolomid+idx_leftmenu).style.position='absolute';
			document.getElementById(leftcolomid+idx_leftmenu).style.visibility='hidden';					
			change_menu_left_menu('0');
		}
		
		for(i=1;i<4;i++){
			if(i!=idx_leftmenu){
				try{
					document.getElementById(leftcolomid+i).style.visibility='hidden';
					document.getElementById('imgtoggleid'+i).src='images/next.gif';
					document.getElementById(leftcolomid+i).style.position='absolute';
				} catch (e) {
					i=5;
				}
			}
		}
	}
	
	function routine_read_message() {
		var xmlHttp;
		var total;
		var tr;
		xmlHttp=initializexmlHttp();
		xmlHttp.onreadystatechange=function() {
			if(xmlHttp.readyState==4) {
				txtmessage=xmlHttp.responseText;
				if(txtmessage!=""){
					//alert(txtmessage);
					document.getElementById('popupmessagecontentid').innerHTML=txtmessage;
					document.getElementById('popupmessageid').style.visibility="visible";
				}
			}
		}
		xmlHttp.open("GET","routine_read_message.php",true);
		xmlHttp.send(null);			
	}
	function sendmessage() {
		//alert(messageto.value);
		var xmlHttp;
		xmlHttp=initializexmlHttp();
		xmlHttp.onreadystatechange=function() {
			if(xmlHttp.readyState==4) {
				returnval=xmlHttp.responseText;
				if(returnval>0){messagecontent.value="";messagecontent.focus();}
				//alert(returnval);
			}
		}
		xmlHttp.open("GET","ajax.sendmessage.php?to="+messageto.value+"&message="+messagecontent.value,true);
		xmlHttp.send(null);			
	}
	
	// window.setTimeout("refresh()",1000);    
	// function refresh() {     
		// var tanggal = new Date();    
		// setTimeout("refresh()",1000);   
		// routine_read_message();
	// }
</script>
<script type="text/javascript">
<!--
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup6.php"; // lookup file name

//var EW_ADD_OPTION_FILE_NAME = ""; // add option file name
var EW_BUTTON_SUBMIT_TEXT = "    Add    ";
var EW_BUTTON_CANCEL_TEXT = "  Cancel  ";

//-->
</script>
<script type="text/javascript" src="js/ewp6.js"></script>
<script type="text/javascript" src="js/userfn6.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js");
//-->

</script>

<div id="popupmessageid" style="border:1px;left:200px;top:200px; solid; color:#FF0000; height:20px; margin-top:0px; padding-left:7px; position:absolute;visibility:hidden;">
	<table class="content_table">
		<tr class="content_header">
			<td>
				<fieldset>
					<legend><b>Message</b></legend>
					<table width="100%">
						<tr>
							<td colspan="2"><span id="popupmessagecontentid"></span></td>
						</tr>
						<tr>
							<td>To</td>
							<td> : 
								<select id="messageto" onkeyup="if(event.keyCode=='13' && this.value!=''){messagecontent.focus();}">
									<option value="">-To-</option>
									<?php
										$sql="SELECT username,nama FROM user_account ORDER BY nama";
										$hsltemp=mysql_query($sql,$db);
										while(list($username,$nama)=mysql_fetch_array($hsltemp)){
									?>
										<option value="<?php echo $username; ?>"><?php echo $nama; ?></option>
									<?php
										}
									?>
									<option value="__ALL__">SEMUA</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Message</td>
							<td> : <input type="text" id="messagecontent" size="100" onkeyup="if(event.keyCode=='13' && this.value!=''){sendmessage();}"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="button" value="Send" onclick="sendmessage();">
								<input type="button" value="Close" onclick="popupmessageid.style.visibility='hidden';">
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
	</table>
</div>

	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#6353FA">
		<input style="solid;position:absolute;visibility:hidden;" type="text" name="change_menu_left_menu_id" id="change_menu_left_menu_id">
		<tr>
			<td bgcolor="#eff3ff" background="images/menubg.png" height="20">
				<?php include_once "menu_explorer_h.php"; ?>
			</td>
		</tr>
		<!-- content (begin) -->
		<tr>
			<td height="100%" valign="top">
				<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" onmouseover="showsubmenu('','','','0');">
					<tr>
						<!-- left column (begin) -->
						<!-- log info (begin) -->
						<?php
							if($_SESSION["change_menu_left_menu"]!="1"){
						?>
						<td valign="top" class="ewMenuColumn" style="solid;visibility:hidden;" id="leftcolomid1">
						<?php
							}else{
						?>
						<td valign="top" class="ewMenuColumn" style="solid;visibility:visible;" id="leftcolomid1">
						<?php
							}
						?>
							<table height="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="ewMenuColumn">									
										<?php
											if($_SESSION["loggedin"]){
											$menu_title=".:Log Info:.";
											$sql="SELECT nama,area FROM user_account WHERE username='".$_SESSION["username"]."'";
											$hsltemp=mysql_query($sql,$db);
											list($namauser,$kodearea)=mysql_fetch_array($hsltemp);
											$sql="SELECT description FROM mst_raw WHERE id='$kodearea'";
											$hsltemp=mysql_query($sql,$db);
											list($area)=mysql_fetch_array($hsltemp);
											
											$sql="SELECT `group` FROM `group` WHERE id_group='".$_SESSION['id_group']."'";
											$hsltemp=mysql_query($sql,$db);
											list($_group)=mysql_fetch_array($hsltemp);
											$_log_departement=$_SESSION['departement'];
											$_log_branch=$_SESSION['branch'];
											$sql="SELECT count(seqno) FROM log_record WHERE mode='login' AND username='".$_SESSION["username"]."'";
											$hsltemp=mysql_query($sql,$db);
											list($_log_count)=mysql_fetch_array($hsltemp);
											$sql="SELECT tanggal,ip FROM log_record WHERE mode='login' AND username='".$_SESSION["username"]."' ORDER BY seqno DESC LIMIT 1";
											$hsltemp=mysql_query($sql,$db);
											list($_log_time,$_ip_address)=mysql_fetch_array($hsltemp);
											$sql="SELECT tanggal FROM log_record WHERE mode='login' AND username='".$_SESSION["username"]."' ORDER BY seqno DESC LIMIT 2";
											$hsltemp=mysql_query($sql,$db);
											while(list($_last_login_temp)=mysql_fetch_array($hsltemp)){
												$_last_login=$_last_login_temp;
											}
											$sql="SELECT tanggal FROM log_record WHERE mode='logout' AND username='".$_SESSION["username"]."' ORDER BY seqno DESC LIMIT 1";
											$hsltemp=mysql_query($sql,$db);
											list($_last_logout)=mysql_fetch_array($hsltemp);
										?>
										<?php include "header_window_menu.php"; ?>
										<table>
											<tr>
												<td nowrap><b>Username</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_SESSION["username"]; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>Name</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_SESSION["nama"]; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>Group</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_group; ?></b></td>
											</tr>
											<!--tr>
												<td nowrap><b>Branch</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_SESSION["namagudang"]." - ".$_SESSION["alamatgudang"]; ?></b></td>
											</tr-->
											<tr>
												<td nowrap><b>Log Count</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_log_count; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>Log Time</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_log_time; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>Last Login </b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_last_login; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>Last Logout </b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_last_logout; ?></b></td>
											</tr>
											<tr>
												<td nowrap><b>IP Address</b></td>
												<td nowrap><b>:</b></td>
												<td nowrap><b><?php echo $_ip_address; ?></b></td>
											</tr> 
											<tr>
												<td colspan="3"><img src='images/logo.jpg' width='161' height='137'></td>
											</tr>
										</table>
										<?php include "footer_window_menu.php"; ?>
										<?php 
											} else{
										?>
											<?php
											$menu_title=".:Log Info:.";
											?>
											<?php include "header_window_menu.php"; ?>
											<?php include "menu_explorer.php"; ?>
											<?php include "footer_window_menu.php"; ?>
										<?php
											}
										?>
									</td>
								</tr>
							</table> 
						</td>
						<!-- log info  (end) -->
						
						<td class="ewMenuColumn" style="solid;width:10px;"></td>
						
						
						<td class="ewMenuColumn" style="solid;width:10px;">
							<?php
								if($_SESSION["change_menu_left_menu"]!="1"){
							?>
							<img src="images/next.gif" width="10" height="30" style="border:0;" id='imgtoggleid1' onClick="showLeftMenu('leftcolomid','1');" title="Log Info">
							<?php
								}else{
							?>
							<img src="images/prev.gif" width="10" height="30" style="border:0;" id='imgtoggleid1' onClick="showLeftMenu('leftcolomid','1');" title="Log Info">
							<?php
								}
							?>
						</td>		
						
						<!-- left column (end) -->
						<!-- right column (begin) -->
						<td>&nbsp;</td>
						<td valign="top">
							<table width="100%" border="0" cellspacing="1" cellpadding="0"><tr><td></td></tr></table>
							<?php include_once "header_window_content.php"; ?>
							<?php
								if(!cek_file_priv(sanitasi(basename($_SERVER[PHP_SELF]))) && $_SESSION['loggedin']){
								?>
									FORBIDDEN PAGE!
								<?php
								include_once "framefooter.php";
								exit;
								}
							?>
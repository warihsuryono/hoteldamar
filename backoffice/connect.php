<?php
    //echo "<img src='../images/under_maintenance.jpg'>";exit();
?>
<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	#added by suro 2009-05-06
	error_reporting(0);
	#########################
	//if (!isset($_SESSION)) session_start();
	#replace by suro 2009-05-08 session_start();
	ini_set ("display_errors","off");
	include_once "connect_config.php";	
	
	$__phpself=basename($_SERVER["PHP_SELF"]);
	$__username=$_SESSION["username"];
	$__namauser=$_SESSION["nama"];
	$__nik=$_SESSION["nik"];
	//$__gudangid=$_SESSION["gudangid"];
	//$__namagudang=$_SESSION["namagudang"];
	//$__alamatgudang=$_SESSION["alamatgudang"];
	$__groupid=$_SESSION["id_group"];
	$__namagroup=$_SESSION["namagroup"];
	$__now=date("Y-m-d H:i:s");
	foreach($_POST as $var_id => $postvalue){
		if(is_array($postvalue)){
			eval("\$$var_id = array();");
			foreach($postvalue as $seqno => $postvalue1){
				eval("\$$var_id"."[".$seqno."]"." = sanitasi(\"$postvalue1\");");
			}
		}else{
			eval("\$$var_id = sanitasi(\"$postvalue\");");
		}
	}
	$__urlgets="";
	$__urlgetshidden="";
	foreach($_GET as $var_id => $getvalue){
		if(!is_array($getvalue)){
			//eval("\$$var_id = sanitasi(\"$getvalue\");");
			if(stripos(" ".$__urlgets." ",$var_id."=")===false){
				$__urlgets=$var_id."=".$getvalue."&".$__urlgets;
			}
			$__urlgetshidden.="<input type='hidden' id='$var_id' name='$var_id' value='$getvalue'>";
		}
	}
	$__urlgets=substr($__urlgets,0,strlen($__urlgets)-1);
	
	
	if($__username == "" && ($__phpself != "login.php" && $__phpself != "index.php" && $__phpself != "")){
		?><script> window.location = "login.php"; </script><?php
		exit();
	}
	
	if(!$db=mysql_connect($host,$user,$pass)){echo "DB Not Connect!";}
	mysql_select_db($dbname,$db);
	
	$sql="SELECT title,hotelname,urlwebhosting,bookpicname,bookemail,frommailname,hotelreporttitle,addressforheader FROM mst_profile";
	$hsltemp=mysql_query($sql,$db);
	list($___title,$___hotelname,$___urlwebhosting,$___bookpicname,$___bookemail,$___frommailname,$___hotelreporttitle,$___addressforheader)=mysql_fetch_array($hsltemp);
	
	//[hoteldamar_mst_jabatan_orderby] => `id` ASC
	$_tablename=str_ireplace("list.php","",basename($_SERVER["PHP_SELF"]));
	$sql="SHOW COLUMNS FROM $_tablename";
	$hsltemp=mysql_query($sql,$db);
	list($_field_order)=mysql_fetch_array($hsltemp);
	if($_field_order){
		$_tablename_order="hoteldamar_".$_tablename."_orderby";
		if(!$_SESSION[$_tablename_order]){$_SESSION[$_tablename_order]="`$_field_order` ASC";}
	}
	
	$rowperpage=50;
	function cek_file_priv($filename){
		global $db,$_SESSION;
		if($_SESSION['id_group']=="1"){
			return true;
		}else{
			$sql="SELECT id_menu FROM menu WHERE url LIKE '$filename'";
			$hsl=mysql_query($sql,$db);
			if(mysql_affected_rows($db)>0){
				$return_val=false;
				while(list($id_menu)=mysql_fetch_array($hsl)){
					if($_SESSION['id_menu_granted'][$id_menu]){
						$return_val=true;
					}
				}
				return $return_val;
			}else{
				return true;
			}
		}
	}
	function format_tanggal($tanggal){
		$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		return $temp;
	}
	function format_tanggal2($tanggal){
		//$temp=substr($tanggal,8,2)."-".substr($tanggal,5,2)."-".substr($tanggal,0,4);
		$temp=date("F Y",mktime(0,0,0,substr($tanggal,5,2),substr($tanggal,8,2),substr($tanggal,0,4)));
		return $temp;
	}
	function realname($username){
		global $db,$_SESSION;
		$sql="SELECT nama FROM user_account WHERE username='$username'";
		$hsl=mysql_query($sql,$db);
		list($name)=mysql_fetch_array($hsl);
		if($name!=""){return $name;}
		if($name==""){return $username;}
	}
	function unformated($number){
		$tempnum="";
		for ($xx=0;$xx<=strlen($number);$xx++){
			if(is_numeric(substr($number,$xx,1)) || substr($number,$xx,1)=="." || substr($number,$xx,1)=="-"){//hanya angka dan titik
				$tempnum.=substr($number,$xx,1);
			}
		}
		return $tempnum;
	}
	$stylenoborder="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;";
?>
<script language="javascript">
	function printthisform() {
		btnprint.style.visibility="hidden";
		try{approvebtn.style.visibility="hidden";}catch(e){}
		try{buttonrowdiv.style.visibility="hidden";}catch(e){}
		try{btnkembali.style.visibility="hidden";}catch(e){}
		try{btnrecvqrlist.style.visibility="hidden";}catch(e){}
		try{btnrecvqr.style.visibility="hidden";}catch(e){}
		try{btn1.style.visibility="hidden";}catch(e){}
		try{btn2.style.visibility="hidden";}catch(e){}
		window.print();
		window.location="<?php echo $_SERVER["REQUEST_URI"];?>";
	}
</script>
<style>
	/* GENERAL */
	a{
		text-decoration:none;
		font-family:verdana;
		color:black;
		}
	a:hover{
		text-decoration:none;
		font-family:verdana;
		}
	td{
		font-size:10px;
		font-family:verdana;
	}
	body{
		font-size:10px;
		font-family:verdana;
	}
	input{
		height:18px;
		font-size:10px;
		padding-top:0px;
		font-family:verdana;
	}
	.print_mode legend{	
		font-size:10px;
		font-family:verdana;
	}
	.print_mode td{	
		font-size:10px;
		font-family:verdana;
	}
	
	
	/* CONTENT TABLE */
	.content_table {
		background-image: url(images/tabel2.gif); /* header bg image */
		border: 2;
		border-spacing: 2;
		border-collapse: collapse;
		
		empty-cells: show;
		font-family: Verdana; /* font name */
		font-size: xx-small; /* font size */
	}
	.content_table td{
		padding: 3px; /* cell padding */
		border-bottom: 1px solid; /* border width, horizontal grid line */
		border-top: 1px solid;
		border-left: 1px solid;
		border-right: 1px solid; /* border width, vertical grid line */
		/*border-color: #7EACB1;  /* border color */
		border-color: #000000;  /* border color */
		white-space:nowrap;
	}
	
	.content_table .content_header td {
		/*background-color: #B7D8DC;	/* header bgcolor */
		color: #000000; /* header font color */
		border-bottom: 1px solid; /* header border width */
		border-right: 1px solid; /* header border width */
		/*border-color: #7EACB1; /* header border color */	
		border-color: #000000; /* header border color */	
		/*background-image: url(images/glass.png); /* header bg image */
		background-repeat: repeat-x;
		font-weight:bold;
		/*text-align:center;*/
		vertical-align:middle;
		white-space:nowrap;
	}
	
	.content_table .content_ganjil td {
		background-color: #fbf8f1; /* header border color */
		/*border-color: #7EACB1;*/
		border-color: #000000; /* header border color */	
	}
	.content_table .content_genap td {
		background-color: #f3f8ff; /* header border color */	
		/*border-color: #7EACB1;*/
		border-color: #000000; /* header border color */	
	}
	
	/* MENU TABLE */
	.menu_table table {
		border: 1;
		border-spacing: 1;
		border-collapse: collapse;
		empty-cells: show;
		font-family: Verdana; /* font name */
		font-size: xx-small; /* font size */
	}
	.menu_table td{
		spacing: 5px; /* cell padding */
		padding: 5px; /* cell padding */
		background-color: #B7D8DC;	/* header bgcolor */
		color: #000000; /* header font color */
		border-bottom: 1px solid; /* header border width */
		border-right: 1px solid; /* header border width */
		border-color: #7EACB1; /* header border color */	
		background-image: url(images/glass.png); /* header bg image */
		background-repeat: repeat-x;
		font-weight:bold;
		vertical-align:middle;
	}
</style>

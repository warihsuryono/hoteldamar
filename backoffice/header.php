<?php include_once "connect.php"; ?>
<html>
	<head>
	<title></title>
<!--link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/container/assets/skins/sam/container.css"-->
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="generator" content="warih_logic">
</head>
<body class="yui-skin-sam" id="content_body_id" width="100%" height="100%" xonmouseup="cek_koordinat();">
<!--script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script-->
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
<?php include "ewmenu.php" ?>
	<?php
		if(!cek_file_priv(sanitasi(basename($_SERVER[PHP_SELF]))) && $_SESSION['loggedin']){
		?>
			FORBIDDEN PAGE!
		<?php
		include_once "footer.php";
		exit;
		}
	?>
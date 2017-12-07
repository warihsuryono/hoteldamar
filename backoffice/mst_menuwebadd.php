<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_menuwebinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$mst_menuweb_add = new cmst_menuweb_add();
$Page =& $mst_menuweb_add;

// Page init processing
$mst_menuweb_add->Page_Init();

// Page main processing
$mst_menuweb_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_menuweb_add = new ew_Page("mst_menuweb_add");

// page properties
mst_menuweb_add.PageID = "add"; // page ID
var EW_PAGE_ID = mst_menuweb_add.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_menuweb_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_seqno"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - No Urut");
		elm = fobj.elements["x" + infix + "_lang"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Bahasa");
		elm = fobj.elements["x" + infix + "_caption"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Caption");
		elm = fobj.elements["x" + infix + "_target"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Target");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_menuweb_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_menuweb_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_menuweb_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><!-- Add to --><h3><b>Web Menu</b></h3><br><br>
<!--a href="<?php echo $mst_menuweb->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_menuweb->getReturnUrl() ?>';">
</span></p>
<?php $mst_menuweb_add->ShowMessage() ?>
<form name="fmst_menuwebadd" id="fmst_menuwebadd" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_menuweb">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_menuweb->seqno->Visible) { // seqno ?>
	<tr<?php echo $mst_menuweb->seqno->RowAttributes ?>>
		<td class="ewTableHeader">No Urut<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->seqno->CellAttributes() ?>><span id="el_seqno">
<input type="text" name="x_seqno" id="x_seqno" size="2" value="<?php echo $mst_menuweb->seqno->EditValue ?>"<?php echo $mst_menuweb->seqno->EditAttributes() ?>>
</span><?php echo $mst_menuweb->seqno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->lang->Visible) { // lang ?>
	<tr<?php echo $mst_menuweb->lang->RowAttributes ?>>
		<td class="ewTableHeader">Bahasa<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->lang->CellAttributes() ?>><span id="el_lang">
<select id="x_lang" name="x_lang"<?php echo $mst_menuweb->lang->EditAttributes() ?>>
<?php
if (is_array($mst_menuweb->lang->EditValue)) {
	$arwrk = $mst_menuweb->lang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_menuweb->lang->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $mst_menuweb->lang->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->caption->Visible) { // caption ?>
	<tr<?php echo $mst_menuweb->caption->RowAttributes ?>>
		<td class="ewTableHeader">Caption<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->caption->CellAttributes() ?>><span id="el_caption">
<input type="text" name="x_caption" id="x_caption" size="30" maxlength="50" value="<?php echo $mst_menuweb->caption->EditValue ?>"<?php echo $mst_menuweb->caption->EditAttributes() ?>>
</span><?php echo $mst_menuweb->caption->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->url->Visible) { // url ?>
	<tr<?php echo $mst_menuweb->url->RowAttributes ?>>
		<td class="ewTableHeader">Url<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->url->CellAttributes() ?>><span id="el_url">
<input type="text" name="x_url" id="x_url" size="100" maxlength="255" value="<?php echo $mst_menuweb->url->EditValue ?>"<?php echo $mst_menuweb->url->EditAttributes() ?>>
</span><?php echo $mst_menuweb->url->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->target->Visible) { // target ?>
	<tr<?php echo $mst_menuweb->target->RowAttributes ?>>
		<td class="ewTableHeader">Target<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->target->CellAttributes() ?>><span id="el_target">
<select id="x_target" name="x_target"<?php echo $mst_menuweb->target->EditAttributes() ?>>
<?php
if (is_array($mst_menuweb->target->EditValue)) {
	$arwrk = $mst_menuweb->target->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_menuweb->target->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $mst_menuweb->target->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->content->Visible) { // content ?>
	<tr<?php echo $mst_menuweb->content->RowAttributes ?>>
		<td class="ewTableHeader">Content<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_menuweb->content->CellAttributes() ?>><span id="el_content">
<textarea name="x_content" id="x_content" cols="80" rows="10"<?php echo $mst_menuweb->content->EditAttributes() ?>><?php echo $mst_menuweb->content->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_content", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_content', 80*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $mst_menuweb->content->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<!--input type="button" name="btnAction" id="btnAction" value="    Add    " onclick="ew_SubmitForm(mst_menuweb_add, this.form);" /-->
<input type="button" name="btnAction" id="btnAction" value="    Simpan    " onclick="ew_SubmitForm(mst_menuweb_add, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$mst_menuweb_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_menuweb_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'mst_menuweb';

	// Page Object Name
	var $PageObjName = 'mst_menuweb_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) $PageUrl .= "t=" . $mst_menuweb->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_menuweb->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_menuweb->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_menuweb_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_menuweb"] = new cmst_menuweb();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_menuweb', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_menuweb;

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $mst_menuweb;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["kode"] != "") {
		  $mst_menuweb->kode->setQueryStringValue($_GET["kode"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $mst_menuweb->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$mst_menuweb->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $mst_menuweb->CurrentAction = "C"; // Copy Record
		  } else {
		    $mst_menuweb->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($mst_menuweb->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("mst_menuweblist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$mst_menuweb->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $mst_menuweb->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$mst_menuweb->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_menuweb;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_menuweb;
		$mst_menuweb->createby->CurrentValue = $_SESSION["username"];
		$mst_menuweb->createdate->CurrentValue = ew_CurrentDateTime();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_menuweb;
		$mst_menuweb->seqno->setFormValue($objForm->GetValue("x_seqno"));
		$mst_menuweb->lang->setFormValue($objForm->GetValue("x_lang"));
		$mst_menuweb->caption->setFormValue($objForm->GetValue("x_caption"));
		$mst_menuweb->url->setFormValue($objForm->GetValue("x_url"));
		$mst_menuweb->target->setFormValue($objForm->GetValue("x_target"));
		$mst_menuweb->content->setFormValue($objForm->GetValue("x_content"));
		$mst_menuweb->createby->setFormValue($objForm->GetValue("x_createby"));
		$mst_menuweb->createdate->setFormValue($objForm->GetValue("x_createdate"));
		$mst_menuweb->createdate->CurrentValue = ew_UnFormatDateTime($mst_menuweb->createdate->CurrentValue, 11);
		$mst_menuweb->kode->setFormValue($objForm->GetValue("x_kode"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_menuweb;
		$mst_menuweb->kode->CurrentValue = $mst_menuweb->kode->FormValue;
		$mst_menuweb->seqno->CurrentValue = $mst_menuweb->seqno->FormValue;
		$mst_menuweb->lang->CurrentValue = $mst_menuweb->lang->FormValue;
		$mst_menuweb->caption->CurrentValue = $mst_menuweb->caption->FormValue;
		$mst_menuweb->url->CurrentValue = $mst_menuweb->url->FormValue;
		$mst_menuweb->target->CurrentValue = $mst_menuweb->target->FormValue;
		$mst_menuweb->content->CurrentValue = $mst_menuweb->content->FormValue;
		$mst_menuweb->createby->CurrentValue = $mst_menuweb->createby->FormValue;
		$mst_menuweb->createdate->CurrentValue = $mst_menuweb->createdate->FormValue;
		$mst_menuweb->createdate->CurrentValue = ew_UnFormatDateTime($mst_menuweb->createdate->CurrentValue, 11);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_menuweb;
		$sFilter = $mst_menuweb->KeyFilter();

		// Call Row Selecting event
		$mst_menuweb->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_menuweb->CurrentFilter = $sFilter;
		$sSql = $mst_menuweb->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_menuweb->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_menuweb;
		$mst_menuweb->kode->setDbValue($rs->fields('kode'));
		$mst_menuweb->seqno->setDbValue($rs->fields('seqno'));
		$mst_menuweb->lang->setDbValue($rs->fields('lang'));
		$mst_menuweb->caption->setDbValue($rs->fields('caption'));
		$mst_menuweb->url->setDbValue($rs->fields('url'));
		$mst_menuweb->target->setDbValue($rs->fields('target'));
		$mst_menuweb->content->setDbValue($rs->fields('content'));
		$mst_menuweb->createby->setDbValue($rs->fields('createby'));
		$mst_menuweb->createdate->setDbValue($rs->fields('createdate'));
		$mst_menuweb->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_menuweb;

		// Call Row_Rendering event
		$mst_menuweb->Row_Rendering();

		// Common render codes for all row types
		// seqno

		$mst_menuweb->seqno->CellCssStyle = "";
		$mst_menuweb->seqno->CellCssClass = "";

		// lang
		$mst_menuweb->lang->CellCssStyle = "";
		$mst_menuweb->lang->CellCssClass = "";

		// caption
		$mst_menuweb->caption->CellCssStyle = "";
		$mst_menuweb->caption->CellCssClass = "";

		// url
		$mst_menuweb->url->CellCssStyle = "";
		$mst_menuweb->url->CellCssClass = "";

		// target
		$mst_menuweb->target->CellCssStyle = "";
		$mst_menuweb->target->CellCssClass = "";

		// content
		$mst_menuweb->content->CellCssStyle = "";
		$mst_menuweb->content->CellCssClass = "";

		// createby
		$mst_menuweb->createby->CellCssStyle = "";
		$mst_menuweb->createby->CellCssClass = "";

		// createdate
		$mst_menuweb->createdate->CellCssStyle = "";
		$mst_menuweb->createdate->CellCssClass = "";
		if ($mst_menuweb->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_menuweb->kode->ViewValue = $mst_menuweb->kode->CurrentValue;
			$mst_menuweb->kode->CssStyle = "";
			$mst_menuweb->kode->CssClass = "";
			$mst_menuweb->kode->ViewCustomAttributes = "";

			// seqno
			$mst_menuweb->seqno->ViewValue = $mst_menuweb->seqno->CurrentValue;
			$mst_menuweb->seqno->CssStyle = "";
			$mst_menuweb->seqno->CssClass = "";
			$mst_menuweb->seqno->ViewCustomAttributes = "";

			// lang
			if (strval($mst_menuweb->lang->CurrentValue) <> "") {
				switch ($mst_menuweb->lang->CurrentValue) {
					case "ind":
						$mst_menuweb->lang->ViewValue = "Indonesia";
						break;
					case "eng":
						$mst_menuweb->lang->ViewValue = "English";
						break;
					default:
						$mst_menuweb->lang->ViewValue = $mst_menuweb->lang->CurrentValue;
				}
			} else {
				$mst_menuweb->lang->ViewValue = NULL;
			}
			$mst_menuweb->lang->CssStyle = "";
			$mst_menuweb->lang->CssClass = "";
			$mst_menuweb->lang->ViewCustomAttributes = "";

			// caption
			$mst_menuweb->caption->ViewValue = $mst_menuweb->caption->CurrentValue;
			$mst_menuweb->caption->CssStyle = "";
			$mst_menuweb->caption->CssClass = "";
			$mst_menuweb->caption->ViewCustomAttributes = "";

			// url
			$mst_menuweb->url->ViewValue = $mst_menuweb->url->CurrentValue;
			$mst_menuweb->url->CssStyle = "";
			$mst_menuweb->url->CssClass = "";
			$mst_menuweb->url->ViewCustomAttributes = "";

			// target
			if (strval($mst_menuweb->target->CurrentValue) <> "") {
				switch ($mst_menuweb->target->CurrentValue) {
					case "main_frame":
						$mst_menuweb->target->ViewValue = "Same Window";
						break;
					case "_blank":
						$mst_menuweb->target->ViewValue = "New Window";
						break;
					default:
						$mst_menuweb->target->ViewValue = $mst_menuweb->target->CurrentValue;
				}
			} else {
				$mst_menuweb->target->ViewValue = NULL;
			}
			$mst_menuweb->target->CssStyle = "";
			$mst_menuweb->target->CssClass = "";
			$mst_menuweb->target->ViewCustomAttributes = "";

			// content
			$mst_menuweb->content->ViewValue = $mst_menuweb->content->CurrentValue;
			$mst_menuweb->content->CssStyle = "";
			$mst_menuweb->content->CssClass = "";
			$mst_menuweb->content->ViewCustomAttributes = "";

			// createby
			if (strval($mst_menuweb->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_menuweb->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_menuweb->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_menuweb->createby->ViewValue = $mst_menuweb->createby->CurrentValue;
				}
			} else {
				$mst_menuweb->createby->ViewValue = NULL;
			}
			$mst_menuweb->createby->CssStyle = "";
			$mst_menuweb->createby->CssClass = "";
			$mst_menuweb->createby->ViewCustomAttributes = "";

			// createdate
			$mst_menuweb->createdate->ViewValue = $mst_menuweb->createdate->CurrentValue;
			$mst_menuweb->createdate->ViewValue = ew_FormatDateTime($mst_menuweb->createdate->ViewValue, 11);
			$mst_menuweb->createdate->CssStyle = "";
			$mst_menuweb->createdate->CssClass = "";
			$mst_menuweb->createdate->ViewCustomAttributes = "";

			// seqno
			$mst_menuweb->seqno->HrefValue = "";

			// lang
			$mst_menuweb->lang->HrefValue = "";

			// caption
			$mst_menuweb->caption->HrefValue = "";

			// url
			$mst_menuweb->url->HrefValue = "";

			// target
			$mst_menuweb->target->HrefValue = "";

			// content
			$mst_menuweb->content->HrefValue = "";

			// createby
			$mst_menuweb->createby->HrefValue = "";

			// createdate
			$mst_menuweb->createdate->HrefValue = "";
		} elseif ($mst_menuweb->RowType == EW_ROWTYPE_ADD) { // Add row

			// seqno
			$mst_menuweb->seqno->EditCustomAttributes = "";
			$mst_menuweb->seqno->EditValue = ew_HtmlEncode($mst_menuweb->seqno->CurrentValue);

			// lang
			$mst_menuweb->lang->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("ind", "Indonesia");
			$arwrk[] = array("eng", "English");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_menuweb->lang->EditValue = $arwrk;

			// caption
			$mst_menuweb->caption->EditCustomAttributes = "";
			$mst_menuweb->caption->EditValue = ew_HtmlEncode($mst_menuweb->caption->CurrentValue);

			// url
			$mst_menuweb->url->EditCustomAttributes = "";
			$mst_menuweb->url->EditValue = ew_HtmlEncode($mst_menuweb->url->CurrentValue);

			// target
			$mst_menuweb->target->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("main_frame", "Same Window");
			$arwrk[] = array("_blank", "New Window");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_menuweb->target->EditValue = $arwrk;

			// content
			$mst_menuweb->content->EditCustomAttributes = "";
			$mst_menuweb->content->EditValue = ew_HtmlEncode($mst_menuweb->content->CurrentValue);

			// createby
			// createdate

		}

		// Call Row Rendered event
		$mst_menuweb->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_menuweb;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($mst_menuweb->seqno->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - No Urut";
		}
		if ($mst_menuweb->lang->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Bahasa";
		}
		if ($mst_menuweb->caption->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Caption";
		}
		if ($mst_menuweb->target->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Target";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_menuweb;
		$rsnew = array();

		// Field seqno
		$mst_menuweb->seqno->SetDbValueDef($mst_menuweb->seqno->CurrentValue, 0);
		$rsnew['seqno'] =& $mst_menuweb->seqno->DbValue;

		// Field lang
		$mst_menuweb->lang->SetDbValueDef($mst_menuweb->lang->CurrentValue, "");
		$rsnew['lang'] =& $mst_menuweb->lang->DbValue;

		// Field caption
		$mst_menuweb->caption->SetDbValueDef($mst_menuweb->caption->CurrentValue, "");
		$rsnew['caption'] =& $mst_menuweb->caption->DbValue;

		// Field url
		$mst_menuweb->url->SetDbValueDef($mst_menuweb->url->CurrentValue, "");
		$rsnew['url'] =& $mst_menuweb->url->DbValue;

		// Field target
		$mst_menuweb->target->SetDbValueDef($mst_menuweb->target->CurrentValue, "");
		$rsnew['target'] =& $mst_menuweb->target->DbValue;

		// Field content
		$mst_menuweb->content->SetDbValueDef($mst_menuweb->content->CurrentValue, "");
		$rsnew['content'] =& $mst_menuweb->content->DbValue;

		// Field createby
		$mst_menuweb->createby->SetDbValueDef($_SESSION["username"], "");
		$rsnew['createby'] =& $mst_menuweb->createby->DbValue;

		// Field createdate
		$mst_menuweb->createdate->SetDbValueDef(ew_CurrentDateTime(), ew_CurrentDate());
		$rsnew['createdate'] =& $mst_menuweb->createdate->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_menuweb->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_menuweb->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_menuweb->CancelMessage <> "") {
				$this->setMessage($mst_menuweb->CancelMessage);
				$mst_menuweb->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$mst_menuweb->kode->setDbValue($conn->Insert_ID());
			$rsnew['kode'] =& $mst_menuweb->kode->DbValue;

			// Call Row Inserted event
			$mst_menuweb->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>

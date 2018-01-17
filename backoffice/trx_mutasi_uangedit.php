<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_mutasi_uanginfo.php" ?>
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
$trx_mutasi_uang_edit = new ctrx_mutasi_uang_edit();
$Page =& $trx_mutasi_uang_edit;

// Page init processing
$trx_mutasi_uang_edit->Page_Init();

// Page main processing
$trx_mutasi_uang_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var trx_mutasi_uang_edit = new ew_Page("trx_mutasi_uang_edit");

// page properties
trx_mutasi_uang_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = trx_mutasi_uang_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
trx_mutasi_uang_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_kode"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Kode");
		elm = fobj.elements["x" + infix + "_tanggal"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
		elm = fobj.elements["x" + infix + "_cardno"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Card No");
		elm = fobj.elements["x" + infix + "_debit"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Debit");
		elm = fobj.elements["x" + infix + "_kredit"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Kredit");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
trx_mutasi_uang_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_mutasi_uang_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_mutasi_uang_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

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
<p><span class="phpmaker"><!-- <img src="images/edit.gif" title="Edit" width="16" height="16" border="0"> --> <h3><b>Pembiayaan dengan Kas/Bank</b></h3><br><br>
<!--a href="<?php echo $trx_mutasi_uang->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $trx_mutasi_uang->getReturnUrl() ?>';">
</span></p>
<?php $trx_mutasi_uang_edit->ShowMessage() ?>
<form name="ftrx_mutasi_uangedit" id="ftrx_mutasi_uangedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return trx_mutasi_uang_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="trx_mutasi_uang">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($trx_mutasi_uang->kode->Visible) { // kode ?>
	<tr<?php echo $trx_mutasi_uang->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->kode->CellAttributes() ?>><span id="el_kode">
<div<?php echo $trx_mutasi_uang->kode->ViewAttributes() ?>><?php echo $trx_mutasi_uang->kode->EditValue ?></div><input type="hidden" name="x_kode" id="x_kode" value="<?php echo ew_HtmlEncode($trx_mutasi_uang->kode->CurrentValue) ?>">
</span><?php echo $trx_mutasi_uang->kode->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_idseqno" id="x_idseqno" value="<?php echo ew_HtmlEncode($trx_mutasi_uang->idseqno->CurrentValue) ?>">
<?php if ($trx_mutasi_uang->tanggal->Visible) { // tanggal ?>
	<tr<?php echo $trx_mutasi_uang->tanggal->RowAttributes ?>>
		<td class="ewTableHeader">Tanggal<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->tanggal->CellAttributes() ?>><span id="el_tanggal">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_mutasi_uang->tanggal->EditValue ?>"<?php echo $trx_mutasi_uang->tanggal->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal" // ID of the button
});
</script>
</span><?php echo $trx_mutasi_uang->tanggal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->mode->Visible) { // mode ?>
	<tr<?php echo $trx_mutasi_uang->mode->RowAttributes ?>>
		<td class="ewTableHeader">Mode<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->mode->CellAttributes() ?>><span id="el_mode">
<select id="x_mode" name="x_mode"<?php echo $trx_mutasi_uang->mode->EditAttributes() ?>>
<?php
if (is_array($trx_mutasi_uang->mode->EditValue)) {
	$arwrk = $trx_mutasi_uang->mode->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_mutasi_uang->mode->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $trx_mutasi_uang->mode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->coabank->Visible) { // coabank ?>
	<tr<?php echo $trx_mutasi_uang->coabank->RowAttributes ?>>
		<td class="ewTableHeader">Bank<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->coabank->CellAttributes() ?>><span id="el_coabank">
<select id="x_coabank" name="x_coabank"<?php echo $trx_mutasi_uang->coabank->EditAttributes() ?>>
<?php
if (is_array($trx_mutasi_uang->coabank->EditValue)) {
	$arwrk = $trx_mutasi_uang->coabank->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_mutasi_uang->coabank->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $trx_mutasi_uang->coabank->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->cardno->Visible) { // cardno ?>
	<tr<?php echo $trx_mutasi_uang->cardno->RowAttributes ?>>
		<td class="ewTableHeader">Card No<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->cardno->CellAttributes() ?>><span id="el_cardno">
<input type="text" name="x_cardno" id="x_cardno" size="30" maxlength="50" value="<?php echo $trx_mutasi_uang->cardno->EditValue ?>"<?php echo $trx_mutasi_uang->cardno->EditAttributes() ?>>
</span><?php echo $trx_mutasi_uang->cardno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->notes->Visible) { // notes ?>
	<tr<?php echo $trx_mutasi_uang->notes->RowAttributes ?>>
		<td class="ewTableHeader">Keterangan<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->notes->CellAttributes() ?>><span id="el_notes">
<input type="text" name="x_notes" id="x_notes" size="100" maxlength="255" value="<?php echo $trx_mutasi_uang->notes->EditValue ?>"<?php echo $trx_mutasi_uang->notes->EditAttributes() ?>>
</span><?php echo $trx_mutasi_uang->notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->debit->Visible) { // debit ?>
	<tr<?php echo $trx_mutasi_uang->debit->RowAttributes ?>>
		<td class="ewTableHeader">Debit<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->debit->CellAttributes() ?>><span id="el_debit">
<input type="text" name="x_debit" id="x_debit" size="30" value="<?php echo $trx_mutasi_uang->debit->EditValue ?>"<?php echo $trx_mutasi_uang->debit->EditAttributes() ?>>
</span><?php echo $trx_mutasi_uang->debit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trx_mutasi_uang->kredit->Visible) { // kredit ?>
	<tr<?php echo $trx_mutasi_uang->kredit->RowAttributes ?>>
		<td class="ewTableHeader">Kredit<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $trx_mutasi_uang->kredit->CellAttributes() ?>><span id="el_kredit">
<input type="text" name="x_kredit" id="x_kredit" size="30" value="<?php echo $trx_mutasi_uang->kredit->EditValue ?>"<?php echo $trx_mutasi_uang->kredit->EditAttributes() ?>>
</span><?php echo $trx_mutasi_uang->kredit->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<!--input type="submit" name="btnAction" id="btnAction" value="   Edit   " /-->
<input type="submit" name="btnAction" id="btnAction" value="    Simpan    ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$trx_mutasi_uang_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_mutasi_uang_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'trx_mutasi_uang';

	// Page Object Name
	var $PageObjName = 'trx_mutasi_uang_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) $PageUrl .= "t=" . $trx_mutasi_uang->TableVar . "&"; // add page token
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
		global $objForm, $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_mutasi_uang->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_mutasi_uang->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_mutasi_uang_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_mutasi_uang"] = new ctrx_mutasi_uang();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_mutasi_uang', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_mutasi_uang;

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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $trx_mutasi_uang;

		// Load key from QueryString
		if (@$_GET["kode"] <> "")
			$trx_mutasi_uang->kode->setQueryStringValue($_GET["kode"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$trx_mutasi_uang->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$trx_mutasi_uang->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$trx_mutasi_uang->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($trx_mutasi_uang->kode->CurrentValue == "")
			$this->Page_Terminate("trx_mutasi_uanglist.php"); // Invalid key, return to list
		switch ($trx_mutasi_uang->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("trx_mutasi_uanglist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$trx_mutasi_uang->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $trx_mutasi_uang->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$trx_mutasi_uang->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $trx_mutasi_uang;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $trx_mutasi_uang;
		$trx_mutasi_uang->kode->setFormValue($objForm->GetValue("x_kode"));
		$trx_mutasi_uang->idseqno->setFormValue($objForm->GetValue("x_idseqno"));
		$trx_mutasi_uang->tanggal->setFormValue($objForm->GetValue("x_tanggal"));
		$trx_mutasi_uang->tanggal->CurrentValue = ew_UnFormatDateTime($trx_mutasi_uang->tanggal->CurrentValue, 7);
		$trx_mutasi_uang->mode->setFormValue($objForm->GetValue("x_mode"));
		$trx_mutasi_uang->coabank->setFormValue($objForm->GetValue("x_coabank"));
		$trx_mutasi_uang->cardno->setFormValue($objForm->GetValue("x_cardno"));
		$trx_mutasi_uang->notes->setFormValue($objForm->GetValue("x_notes"));
		$trx_mutasi_uang->debit->setFormValue($objForm->GetValue("x_debit"));
		$trx_mutasi_uang->kredit->setFormValue($objForm->GetValue("x_kredit"));
		$trx_mutasi_uang->createby->setFormValue($objForm->GetValue("x_createby"));
		$trx_mutasi_uang->createdate->setFormValue($objForm->GetValue("x_createdate"));
		$trx_mutasi_uang->createdate->CurrentValue = ew_UnFormatDateTime($trx_mutasi_uang->createdate->CurrentValue, 7);
	}

	// Restore form values
	function RestoreFormValues() {
		global $trx_mutasi_uang;
		$this->LoadRow();
		$trx_mutasi_uang->kode->CurrentValue = $trx_mutasi_uang->kode->FormValue;
		$trx_mutasi_uang->idseqno->CurrentValue = $trx_mutasi_uang->idseqno->FormValue;
		$trx_mutasi_uang->tanggal->CurrentValue = $trx_mutasi_uang->tanggal->FormValue;
		$trx_mutasi_uang->tanggal->CurrentValue = ew_UnFormatDateTime($trx_mutasi_uang->tanggal->CurrentValue, 7);
		$trx_mutasi_uang->mode->CurrentValue = $trx_mutasi_uang->mode->FormValue;
		$trx_mutasi_uang->coabank->CurrentValue = $trx_mutasi_uang->coabank->FormValue;
		$trx_mutasi_uang->cardno->CurrentValue = $trx_mutasi_uang->cardno->FormValue;
		$trx_mutasi_uang->notes->CurrentValue = $trx_mutasi_uang->notes->FormValue;
		$trx_mutasi_uang->debit->CurrentValue = $trx_mutasi_uang->debit->FormValue;
		$trx_mutasi_uang->kredit->CurrentValue = $trx_mutasi_uang->kredit->FormValue;
		$trx_mutasi_uang->createby->CurrentValue = $trx_mutasi_uang->createby->FormValue;
		$trx_mutasi_uang->createdate->CurrentValue = $trx_mutasi_uang->createdate->FormValue;
		$trx_mutasi_uang->createdate->CurrentValue = ew_UnFormatDateTime($trx_mutasi_uang->createdate->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_mutasi_uang;
		$sFilter = $trx_mutasi_uang->KeyFilter();

		// Call Row Selecting event
		$trx_mutasi_uang->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_mutasi_uang->CurrentFilter = $sFilter;
		$sSql = $trx_mutasi_uang->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_mutasi_uang->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_mutasi_uang;
		$trx_mutasi_uang->kode->setDbValue($rs->fields('kode'));
		$trx_mutasi_uang->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_mutasi_uang->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_mutasi_uang->mode->setDbValue($rs->fields('mode'));
		$trx_mutasi_uang->coabank->setDbValue($rs->fields('coabank'));
		$trx_mutasi_uang->cardno->setDbValue($rs->fields('cardno'));
		$trx_mutasi_uang->modul->setDbValue($rs->fields('modul'));
		$trx_mutasi_uang->kode_trx->setDbValue($rs->fields('kode_trx'));
		$trx_mutasi_uang->kodejurnal->setDbValue($rs->fields('kodejurnal'));
		$trx_mutasi_uang->coa->setDbValue($rs->fields('coa'));
		$trx_mutasi_uang->notes->setDbValue($rs->fields('notes'));
		$trx_mutasi_uang->debit->setDbValue($rs->fields('debit'));
		$trx_mutasi_uang->kredit->setDbValue($rs->fields('kredit'));
		$trx_mutasi_uang->createby->setDbValue($rs->fields('createby'));
		$trx_mutasi_uang->createdate->setDbValue($rs->fields('createdate'));
		$trx_mutasi_uang->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_mutasi_uang;

		// Call Row_Rendering event
		$trx_mutasi_uang->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_mutasi_uang->kode->CellCssStyle = "";
		$trx_mutasi_uang->kode->CellCssClass = "";

		// idseqno
		$trx_mutasi_uang->idseqno->CellCssStyle = "";
		$trx_mutasi_uang->idseqno->CellCssClass = "";

		// tanggal
		$trx_mutasi_uang->tanggal->CellCssStyle = "";
		$trx_mutasi_uang->tanggal->CellCssClass = "";

		// mode
		$trx_mutasi_uang->mode->CellCssStyle = "";
		$trx_mutasi_uang->mode->CellCssClass = "";

		// coabank
		$trx_mutasi_uang->coabank->CellCssStyle = "";
		$trx_mutasi_uang->coabank->CellCssClass = "";

		// cardno
		$trx_mutasi_uang->cardno->CellCssStyle = "";
		$trx_mutasi_uang->cardno->CellCssClass = "";

		// notes
		$trx_mutasi_uang->notes->CellCssStyle = "";
		$trx_mutasi_uang->notes->CellCssClass = "";

		// debit
		$trx_mutasi_uang->debit->CellCssStyle = "";
		$trx_mutasi_uang->debit->CellCssClass = "";

		// kredit
		$trx_mutasi_uang->kredit->CellCssStyle = "";
		$trx_mutasi_uang->kredit->CellCssClass = "";

		// createby
		$trx_mutasi_uang->createby->CellCssStyle = "";
		$trx_mutasi_uang->createby->CellCssClass = "";

		// createdate
		$trx_mutasi_uang->createdate->CellCssStyle = "";
		$trx_mutasi_uang->createdate->CellCssClass = "";
		if ($trx_mutasi_uang->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_mutasi_uang->kode->ViewValue = $trx_mutasi_uang->kode->CurrentValue;
			$trx_mutasi_uang->kode->CssStyle = "";
			$trx_mutasi_uang->kode->CssClass = "";
			$trx_mutasi_uang->kode->ViewCustomAttributes = "";

			// idseqno
			$trx_mutasi_uang->idseqno->ViewValue = $trx_mutasi_uang->idseqno->CurrentValue;
			$trx_mutasi_uang->idseqno->CssStyle = "";
			$trx_mutasi_uang->idseqno->CssClass = "";
			$trx_mutasi_uang->idseqno->ViewCustomAttributes = "";

			// tanggal
			$trx_mutasi_uang->tanggal->ViewValue = $trx_mutasi_uang->tanggal->CurrentValue;
			$trx_mutasi_uang->tanggal->ViewValue = ew_FormatDateTime($trx_mutasi_uang->tanggal->ViewValue, 7);
			$trx_mutasi_uang->tanggal->CssStyle = "";
			$trx_mutasi_uang->tanggal->CssClass = "";
			$trx_mutasi_uang->tanggal->ViewCustomAttributes = "";

			// mode
			if (strval($trx_mutasi_uang->mode->CurrentValue) <> "") {
				switch ($trx_mutasi_uang->mode->CurrentValue) {
					case "kas":
						$trx_mutasi_uang->mode->ViewValue = "Kas";
						break;
					case "edc":
						$trx_mutasi_uang->mode->ViewValue = "EDC";
						break;
					case "bank":
						$trx_mutasi_uang->mode->ViewValue = "Bank";
						break;
					default:
						$trx_mutasi_uang->mode->ViewValue = $trx_mutasi_uang->mode->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->mode->ViewValue = NULL;
			}
			$trx_mutasi_uang->mode->CssStyle = "";
			$trx_mutasi_uang->mode->CssClass = "";
			$trx_mutasi_uang->mode->ViewCustomAttributes = "";

			// coabank
			if (strval($trx_mutasi_uang->coabank->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($trx_mutasi_uang->coabank->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description` LIKE '%bank%'" . ")";
				$sSqlWrk .= " ORDER BY `description` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->coabank->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->coabank->ViewValue = $trx_mutasi_uang->coabank->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->coabank->ViewValue = NULL;
			}
			$trx_mutasi_uang->coabank->CssStyle = "";
			$trx_mutasi_uang->coabank->CssClass = "";
			$trx_mutasi_uang->coabank->ViewCustomAttributes = "";

			// cardno
			$trx_mutasi_uang->cardno->ViewValue = $trx_mutasi_uang->cardno->CurrentValue;
			$trx_mutasi_uang->cardno->CssStyle = "";
			$trx_mutasi_uang->cardno->CssClass = "";
			$trx_mutasi_uang->cardno->ViewCustomAttributes = "";

			// notes
			$trx_mutasi_uang->notes->ViewValue = $trx_mutasi_uang->notes->CurrentValue;
			$trx_mutasi_uang->notes->CssStyle = "";
			$trx_mutasi_uang->notes->CssClass = "";
			$trx_mutasi_uang->notes->ViewCustomAttributes = "";

			// debit
			$trx_mutasi_uang->debit->ViewValue = $trx_mutasi_uang->debit->CurrentValue;
			$trx_mutasi_uang->debit->ViewValue = ew_FormatNumber($trx_mutasi_uang->debit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->debit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->debit->CssClass = "";
			$trx_mutasi_uang->debit->ViewCustomAttributes = "";

			// kredit
			$trx_mutasi_uang->kredit->ViewValue = $trx_mutasi_uang->kredit->CurrentValue;
			$trx_mutasi_uang->kredit->ViewValue = ew_FormatNumber($trx_mutasi_uang->kredit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->kredit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->kredit->CssClass = "";
			$trx_mutasi_uang->kredit->ViewCustomAttributes = "";

			// createby
			if (strval($trx_mutasi_uang->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($trx_mutasi_uang->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->createby->ViewValue = $trx_mutasi_uang->createby->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->createby->ViewValue = NULL;
			}
			$trx_mutasi_uang->createby->CssStyle = "";
			$trx_mutasi_uang->createby->CssClass = "";
			$trx_mutasi_uang->createby->ViewCustomAttributes = "";

			// createdate
			$trx_mutasi_uang->createdate->ViewValue = $trx_mutasi_uang->createdate->CurrentValue;
			$trx_mutasi_uang->createdate->ViewValue = ew_FormatDateTime($trx_mutasi_uang->createdate->ViewValue, 7);
			$trx_mutasi_uang->createdate->CssStyle = "";
			$trx_mutasi_uang->createdate->CssClass = "";
			$trx_mutasi_uang->createdate->ViewCustomAttributes = "";

			// kode
			$trx_mutasi_uang->kode->HrefValue = "";

			// idseqno
			$trx_mutasi_uang->idseqno->HrefValue = "";

			// tanggal
			$trx_mutasi_uang->tanggal->HrefValue = "";

			// mode
			$trx_mutasi_uang->mode->HrefValue = "";

			// coabank
			$trx_mutasi_uang->coabank->HrefValue = "";

			// cardno
			$trx_mutasi_uang->cardno->HrefValue = "";

			// notes
			$trx_mutasi_uang->notes->HrefValue = "";

			// debit
			$trx_mutasi_uang->debit->HrefValue = "";

			// kredit
			$trx_mutasi_uang->kredit->HrefValue = "";

			// createby
			$trx_mutasi_uang->createby->HrefValue = "";

			// createdate
			$trx_mutasi_uang->createdate->HrefValue = "";
		} elseif ($trx_mutasi_uang->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$trx_mutasi_uang->kode->EditCustomAttributes = "";
			$trx_mutasi_uang->kode->EditValue = $trx_mutasi_uang->kode->CurrentValue;
			$trx_mutasi_uang->kode->CssStyle = "";
			$trx_mutasi_uang->kode->CssClass = "";
			$trx_mutasi_uang->kode->ViewCustomAttributes = "";

			// idseqno
			$trx_mutasi_uang->idseqno->EditCustomAttributes = "";

			// tanggal
			$trx_mutasi_uang->tanggal->EditCustomAttributes = "";
			$trx_mutasi_uang->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($trx_mutasi_uang->tanggal->CurrentValue, 7));

			// mode
			$trx_mutasi_uang->mode->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("kas", "Kas");
			$arwrk[] = array("edc", "EDC");
			$arwrk[] = array("bank", "Bank");
			array_unshift($arwrk, array("", "Please Select"));
			$trx_mutasi_uang->mode->EditValue = $arwrk;

			// coabank
			$trx_mutasi_uang->coabank->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk = "($sWhereWrk) AND ";
			$sWhereWrk .= "(" . "`description` LIKE '%bank%'" . ")";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `description` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_mutasi_uang->coabank->EditValue = $arwrk;

			// cardno
			$trx_mutasi_uang->cardno->EditCustomAttributes = "";
			$trx_mutasi_uang->cardno->EditValue = ew_HtmlEncode($trx_mutasi_uang->cardno->CurrentValue);

			// notes
			$trx_mutasi_uang->notes->EditCustomAttributes = "";
			$trx_mutasi_uang->notes->EditValue = ew_HtmlEncode($trx_mutasi_uang->notes->CurrentValue);

			// debit
			$trx_mutasi_uang->debit->EditCustomAttributes = "";
			$trx_mutasi_uang->debit->EditValue = ew_HtmlEncode($trx_mutasi_uang->debit->CurrentValue);

			// kredit
			$trx_mutasi_uang->kredit->EditCustomAttributes = "";
			$trx_mutasi_uang->kredit->EditValue = ew_HtmlEncode($trx_mutasi_uang->kredit->CurrentValue);

			// createby
			// createdate
			// Edit refer script
			// kode

			$trx_mutasi_uang->kode->HrefValue = "";

			// idseqno
			$trx_mutasi_uang->idseqno->HrefValue = "";

			// tanggal
			$trx_mutasi_uang->tanggal->HrefValue = "";

			// mode
			$trx_mutasi_uang->mode->HrefValue = "";

			// coabank
			$trx_mutasi_uang->coabank->HrefValue = "";

			// cardno
			$trx_mutasi_uang->cardno->HrefValue = "";

			// notes
			$trx_mutasi_uang->notes->HrefValue = "";

			// debit
			$trx_mutasi_uang->debit->HrefValue = "";

			// kredit
			$trx_mutasi_uang->kredit->HrefValue = "";

			// createby
			$trx_mutasi_uang->createby->HrefValue = "";

			// createdate
			$trx_mutasi_uang->createdate->HrefValue = "";
		}

		// Call Row Rendered event
		$trx_mutasi_uang->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $trx_mutasi_uang;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($trx_mutasi_uang->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if (!ew_CheckEuroDate($trx_mutasi_uang->tanggal->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if ($trx_mutasi_uang->cardno->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Card No";
		}
		if (!ew_CheckNumber($trx_mutasi_uang->debit->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Debit";
		}
		if (!ew_CheckNumber($trx_mutasi_uang->kredit->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Kredit";
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $trx_mutasi_uang;
		$sFilter = $trx_mutasi_uang->KeyFilter();
		$trx_mutasi_uang->CurrentFilter = $sFilter;
		$sSql = $trx_mutasi_uang->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field kode
			// Field idseqno

			$trx_mutasi_uang->idseqno->SetDbValueDef($trx_mutasi_uang->idseqno->CurrentValue, 0);
			$rsnew['idseqno'] =& $trx_mutasi_uang->idseqno->DbValue;

			// Field tanggal
			$trx_mutasi_uang->tanggal->SetDbValueDef(ew_UnFormatDateTime($trx_mutasi_uang->tanggal->CurrentValue, 7), ew_CurrentDate());
			$rsnew['tanggal'] =& $trx_mutasi_uang->tanggal->DbValue;

			// Field mode
			$trx_mutasi_uang->mode->SetDbValueDef($trx_mutasi_uang->mode->CurrentValue, "");
			$rsnew['mode'] =& $trx_mutasi_uang->mode->DbValue;

			// Field coabank
			$trx_mutasi_uang->coabank->SetDbValueDef($trx_mutasi_uang->coabank->CurrentValue, "");
			$rsnew['coabank'] =& $trx_mutasi_uang->coabank->DbValue;

			// Field cardno
			$trx_mutasi_uang->cardno->SetDbValueDef($trx_mutasi_uang->cardno->CurrentValue, "");
			$rsnew['cardno'] =& $trx_mutasi_uang->cardno->DbValue;

			// Field notes
			$trx_mutasi_uang->notes->SetDbValueDef($trx_mutasi_uang->notes->CurrentValue, "");
			$rsnew['notes'] =& $trx_mutasi_uang->notes->DbValue;

			// Field debit
			$trx_mutasi_uang->debit->SetDbValueDef($trx_mutasi_uang->debit->CurrentValue, 0);
			$rsnew['debit'] =& $trx_mutasi_uang->debit->DbValue;

			// Field kredit
			$trx_mutasi_uang->kredit->SetDbValueDef($trx_mutasi_uang->kredit->CurrentValue, 0);
			$rsnew['kredit'] =& $trx_mutasi_uang->kredit->DbValue;

			// Field createby
			$trx_mutasi_uang->createby->SetDbValueDef($_SESSION["username"], "");
			$rsnew['createby'] =& $trx_mutasi_uang->createby->DbValue;

			// Field createdate
			$trx_mutasi_uang->createdate->SetDbValueDef(ew_CurrentDateTime(), ew_CurrentDate());
			$rsnew['createdate'] =& $trx_mutasi_uang->createdate->DbValue;

			// Call Row Updating event
			$bUpdateRow = $trx_mutasi_uang->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($trx_mutasi_uang->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($trx_mutasi_uang->CancelMessage <> "") {
					$this->setMessage($trx_mutasi_uang->CancelMessage);
					$trx_mutasi_uang->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$trx_mutasi_uang->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

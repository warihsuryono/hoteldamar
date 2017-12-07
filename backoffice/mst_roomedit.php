<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_roominfo.php" ?>
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
$mst_room_edit = new cmst_room_edit();
$Page =& $mst_room_edit;

// Page init processing
$mst_room_edit->Page_Init();

// Page main processing
$mst_room_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_edit = new ew_Page("mst_room_edit");

// page properties
mst_room_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = mst_room_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_room_edit.ValidateForm = function(fobj) {
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

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_room_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><!-- Edit --> <h3><b>Master Room</b></h3><br><br>
<!--a href="<?php echo $mst_room->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_room->getReturnUrl() ?>';">
</span></p>
<?php $mst_room_edit->ShowMessage() ?>
<form name="fmst_roomedit" id="fmst_roomedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_room_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="mst_room">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_room->kode->Visible) { // kode ?>
	<tr<?php echo $mst_room->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room->kode->CellAttributes() ?>><span id="el_kode">
<div<?php echo $mst_room->kode->ViewAttributes() ?>><?php echo $mst_room->kode->EditValue ?></div><input type="hidden" name="x_kode" id="x_kode" value="<?php echo ew_HtmlEncode($mst_room->kode->CurrentValue) ?>">
</span><?php echo $mst_room->kode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room->nama->Visible) { // nama ?>
	<tr<?php echo $mst_room->nama->RowAttributes ?>>
		<td class="ewTableHeader">Nama<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_room->nama->EditValue ?>"<?php echo $mst_room->nama->EditAttributes() ?>>
</span><?php echo $mst_room->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room->tipe->Visible) { // tipe ?>
	<tr<?php echo $mst_room->tipe->RowAttributes ?>>
		<td class="ewTableHeader">Tipe<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room->tipe->CellAttributes() ?>><span id="el_tipe">
<select id="x_tipe" name="x_tipe"<?php echo $mst_room->tipe->EditAttributes() ?>>
<?php
if (is_array($mst_room->tipe->EditValue)) {
	$arwrk = $mst_room->tipe->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->tipe->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_room->tipe->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room->connecting1->Visible) { // connecting1 ?>
	<tr<?php echo $mst_room->connecting1->RowAttributes ?>>
		<td class="ewTableHeader">Connecting To (1)<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room->connecting1->CellAttributes() ?>><span id="el_connecting1">
<select id="x_connecting1" name="x_connecting1"<?php echo $mst_room->connecting1->EditAttributes() ?>>
<?php
if (is_array($mst_room->connecting1->EditValue)) {
	$arwrk = $mst_room->connecting1->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->connecting1->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_room->connecting1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room->connecting2->Visible) { // connecting2 ?>
	<tr<?php echo $mst_room->connecting2->RowAttributes ?>>
		<td class="ewTableHeader">Connecting To (2)<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room->connecting2->CellAttributes() ?>><span id="el_connecting2">
<select id="x_connecting2" name="x_connecting2"<?php echo $mst_room->connecting2->EditAttributes() ?>>
<?php
if (is_array($mst_room->connecting2->EditValue)) {
	$arwrk = $mst_room->connecting2->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->connecting2->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_room->connecting2->CustomMsg ?></td>
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
$mst_room_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'mst_room';

	// Page Object Name
	var $PageObjName = 'mst_room_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room;
		if ($mst_room->UseTokenInUrl) $PageUrl .= "t=" . $mst_room->TableVar . "&"; // add page token
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
		global $objForm, $mst_room;
		if ($mst_room->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room"] = new cmst_room();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room;

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
		global $objForm, $gsFormError, $mst_room;

		// Load key from QueryString
		if (@$_GET["kode"] <> "")
			$mst_room->kode->setQueryStringValue($_GET["kode"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$mst_room->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$mst_room->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$mst_room->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($mst_room->kode->CurrentValue == "")
			$this->Page_Terminate("mst_roomlist.php"); // Invalid key, return to list
		switch ($mst_room->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("mst_roomlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$mst_room->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $mst_room->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$mst_room->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_room;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_room;
		$mst_room->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_room->nama->setFormValue($objForm->GetValue("x_nama"));
		$mst_room->tipe->setFormValue($objForm->GetValue("x_tipe"));
		$mst_room->connecting1->setFormValue($objForm->GetValue("x_connecting1"));
		$mst_room->connecting2->setFormValue($objForm->GetValue("x_connecting2"));
		$mst_room->changeby->setFormValue($objForm->GetValue("x_changeby"));
		$mst_room->changedate->setFormValue($objForm->GetValue("x_changedate"));
		$mst_room->changedate->CurrentValue = ew_UnFormatDateTime($mst_room->changedate->CurrentValue, 7);
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_room;
		$this->LoadRow();
		$mst_room->kode->CurrentValue = $mst_room->kode->FormValue;
		$mst_room->nama->CurrentValue = $mst_room->nama->FormValue;
		$mst_room->tipe->CurrentValue = $mst_room->tipe->FormValue;
		$mst_room->connecting1->CurrentValue = $mst_room->connecting1->FormValue;
		$mst_room->connecting2->CurrentValue = $mst_room->connecting2->FormValue;
		$mst_room->changeby->CurrentValue = $mst_room->changeby->FormValue;
		$mst_room->changedate->CurrentValue = $mst_room->changedate->FormValue;
		$mst_room->changedate->CurrentValue = ew_UnFormatDateTime($mst_room->changedate->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room;
		$sFilter = $mst_room->KeyFilter();

		// Call Row Selecting event
		$mst_room->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room->CurrentFilter = $sFilter;
		$sSql = $mst_room->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room;
		$mst_room->kode->setDbValue($rs->fields('kode'));
		$mst_room->nama->setDbValue($rs->fields('nama'));
		$mst_room->price->setDbValue($rs->fields('price'));
		$mst_room->price2->setDbValue($rs->fields('price2'));
		$mst_room->tipe->setDbValue($rs->fields('tipe'));
		$mst_room->connecting1->setDbValue($rs->fields('connecting1'));
		$mst_room->connecting2->setDbValue($rs->fields('connecting2'));
		$mst_room->available->setDbValue($rs->fields('available'));
		$mst_room->booked->setDbValue($rs->fields('booked'));
		$mst_room->changeby->setDbValue($rs->fields('changeby'));
		$mst_room->changedate->setDbValue($rs->fields('changedate'));
		$mst_room->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room;

		// Call Row_Rendering event
		$mst_room->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_room->kode->CellCssStyle = "";
		$mst_room->kode->CellCssClass = "";

		// nama
		$mst_room->nama->CellCssStyle = "";
		$mst_room->nama->CellCssClass = "";

		// tipe
		$mst_room->tipe->CellCssStyle = "";
		$mst_room->tipe->CellCssClass = "";

		// connecting1
		$mst_room->connecting1->CellCssStyle = "";
		$mst_room->connecting1->CellCssClass = "";

		// connecting2
		$mst_room->connecting2->CellCssStyle = "";
		$mst_room->connecting2->CellCssClass = "";

		// changeby
		$mst_room->changeby->CellCssStyle = "";
		$mst_room->changeby->CellCssClass = "";

		// changedate
		$mst_room->changedate->CellCssStyle = "";
		$mst_room->changedate->CellCssClass = "";
		if ($mst_room->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_room->kode->ViewValue = $mst_room->kode->CurrentValue;
			$mst_room->kode->CssStyle = "";
			$mst_room->kode->CssClass = "";
			$mst_room->kode->ViewCustomAttributes = "";

			// nama
			$mst_room->nama->ViewValue = $mst_room->nama->CurrentValue;
			$mst_room->nama->CssStyle = "";
			$mst_room->nama->CssClass = "";
			$mst_room->nama->ViewCustomAttributes = "";

			// tipe
			if (strval($mst_room->tipe->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room->tipe->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->tipe->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room->tipe->ViewValue = $mst_room->tipe->CurrentValue;
				}
			} else {
				$mst_room->tipe->ViewValue = NULL;
			}
			$mst_room->tipe->CssStyle = "";
			$mst_room->tipe->CssClass = "";
			$mst_room->tipe->ViewCustomAttributes = "";

			// connecting1
			if (strval($mst_room->connecting1->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting1->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting1->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting1->ViewValue = $mst_room->connecting1->CurrentValue;
				}
			} else {
				$mst_room->connecting1->ViewValue = NULL;
			}
			$mst_room->connecting1->CssStyle = "";
			$mst_room->connecting1->CssClass = "";
			$mst_room->connecting1->ViewCustomAttributes = "";

			// connecting2
			if (strval($mst_room->connecting2->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting2->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting2->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting2->ViewValue = $mst_room->connecting2->CurrentValue;
				}
			} else {
				$mst_room->connecting2->ViewValue = NULL;
			}
			$mst_room->connecting2->CssStyle = "";
			$mst_room->connecting2->CssClass = "";
			$mst_room->connecting2->ViewCustomAttributes = "";

			// changeby
			if (strval($mst_room->changeby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room->changeby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->changeby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->changeby->ViewValue = $mst_room->changeby->CurrentValue;
				}
			} else {
				$mst_room->changeby->ViewValue = NULL;
			}
			$mst_room->changeby->CssStyle = "";
			$mst_room->changeby->CssClass = "";
			$mst_room->changeby->ViewCustomAttributes = "";

			// changedate
			$mst_room->changedate->ViewValue = $mst_room->changedate->CurrentValue;
			$mst_room->changedate->ViewValue = ew_FormatDateTime($mst_room->changedate->ViewValue, 7);
			$mst_room->changedate->CssStyle = "";
			$mst_room->changedate->CssClass = "";
			$mst_room->changedate->ViewCustomAttributes = "";

			// kode
			$mst_room->kode->HrefValue = "";

			// nama
			$mst_room->nama->HrefValue = "";

			// tipe
			$mst_room->tipe->HrefValue = "";

			// connecting1
			$mst_room->connecting1->HrefValue = "";

			// connecting2
			$mst_room->connecting2->HrefValue = "";

			// changeby
			$mst_room->changeby->HrefValue = "";

			// changedate
			$mst_room->changedate->HrefValue = "";
		} elseif ($mst_room->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_room->kode->EditCustomAttributes = "";
			$mst_room->kode->EditValue = $mst_room->kode->CurrentValue;
			$mst_room->kode->CssStyle = "";
			$mst_room->kode->CssClass = "";
			$mst_room->kode->ViewCustomAttributes = "";

			// nama
			$mst_room->nama->EditCustomAttributes = "";
			$mst_room->nama->EditValue = ew_HtmlEncode($mst_room->nama->CurrentValue);

			// tipe
			$mst_room->tipe->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room_type`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->tipe->EditValue = $arwrk;

			// connecting1
			$mst_room->connecting1->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->connecting1->EditValue = $arwrk;

			// connecting2
			$mst_room->connecting2->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->connecting2->EditValue = $arwrk;

			// changeby
			// changedate
			// Edit refer script
			// kode

			$mst_room->kode->HrefValue = "";

			// nama
			$mst_room->nama->HrefValue = "";

			// tipe
			$mst_room->tipe->HrefValue = "";

			// connecting1
			$mst_room->connecting1->HrefValue = "";

			// connecting2
			$mst_room->connecting2->HrefValue = "";

			// changeby
			$mst_room->changeby->HrefValue = "";

			// changedate
			$mst_room->changedate->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_room;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_room->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
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
		global $conn, $Security, $mst_room;
		$sFilter = $mst_room->KeyFilter();
		$mst_room->CurrentFilter = $sFilter;
		$sSql = $mst_room->SQL();
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
			// Field nama

			$mst_room->nama->SetDbValueDef($mst_room->nama->CurrentValue, "");
			$rsnew['nama'] =& $mst_room->nama->DbValue;

			// Field tipe
			$mst_room->tipe->SetDbValueDef($mst_room->tipe->CurrentValue, "");
			$rsnew['tipe'] =& $mst_room->tipe->DbValue;

			// Field connecting1
			$mst_room->connecting1->SetDbValueDef($mst_room->connecting1->CurrentValue, "");
			$rsnew['connecting1'] =& $mst_room->connecting1->DbValue;

			// Field connecting2
			$mst_room->connecting2->SetDbValueDef($mst_room->connecting2->CurrentValue, "");
			$rsnew['connecting2'] =& $mst_room->connecting2->DbValue;

			// Field changeby
			$mst_room->changeby->SetDbValueDef($_SESSION["username"], "");
			$rsnew['changeby'] =& $mst_room->changeby->DbValue;

			// Field changedate
			$mst_room->changedate->SetDbValueDef(ew_CurrentDateTime(), ew_CurrentDate());
			$rsnew['changedate'] =& $mst_room->changedate->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_room->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_room->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_room->CancelMessage <> "") {
					$this->setMessage($mst_room->CancelMessage);
					$mst_room->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_room->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_room';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $mst_room;
		$table = 'mst_room';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "U";
		foreach (array_keys($rsnew) as $fldname) {
			if ($mst_room->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_room->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_room->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
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

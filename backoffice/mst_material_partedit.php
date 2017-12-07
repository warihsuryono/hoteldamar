<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_material_partinfo.php" ?>
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
$mst_material_part_edit = new cmst_material_part_edit();
$Page =& $mst_material_part_edit;

// Page init processing
$mst_material_part_edit->Page_Init();

// Page main processing
$mst_material_part_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_edit = new ew_Page("mst_material_part_edit");

// page properties
mst_material_part_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = mst_material_part_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_material_part_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_pn"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Serial Number");
		elm = fobj.elements["x" + infix + "_category"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Category");
		elm = fobj.elements["x" + infix + "_nama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Nama");
		elm = fobj.elements["x" + infix + "_satuan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Satuan");
		elm = fobj.elements["x" + infix + "_keterangan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Keterangan");
		elm = fobj.elements["x" + infix + "_coa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - COA");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_material_part_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><!-- <img src="images/edit.gif" title="Edit" width="16" height="16" border="0"> --> <h3><b>Master Barang</b></h3><br><br>
<!--a href="<?php echo $mst_material_part->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_material_part->getReturnUrl() ?>';">
</span></p>
<?php $mst_material_part_edit->ShowMessage() ?>
<form name="fmst_material_partedit" id="fmst_material_partedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_material_part_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="mst_material_part">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_material_part->kode->Visible) { // kode ?>
	<tr<?php echo $mst_material_part->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->kode->CellAttributes() ?>><span id="el_kode">
<div<?php echo $mst_material_part->kode->ViewAttributes() ?>><?php echo $mst_material_part->kode->EditValue ?></div><input type="hidden" name="x_kode" id="x_kode" value="<?php echo ew_HtmlEncode($mst_material_part->kode->CurrentValue) ?>">
</span><?php echo $mst_material_part->kode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->pn->Visible) { // pn ?>
	<tr<?php echo $mst_material_part->pn->RowAttributes ?>>
		<td class="ewTableHeader">Serial Number<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>><span id="el_pn">
<input type="text" name="x_pn" id="x_pn" size="30" maxlength="50" value="<?php echo $mst_material_part->pn->EditValue ?>"<?php echo $mst_material_part->pn->EditAttributes() ?>>
</span><?php echo $mst_material_part->pn->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->category->Visible) { // category ?>
	<tr<?php echo $mst_material_part->category->RowAttributes ?>>
		<td class="ewTableHeader">Category<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>><span id="el_category">
<select id="x_category" name="x_category"<?php echo $mst_material_part->category->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->category->EditValue)) {
	$arwrk = $mst_material_part->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_material_part->category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->modelunit->Visible) { // modelunit ?>
	<tr<?php echo $mst_material_part->modelunit->RowAttributes ?>>
		<td class="ewTableHeader">Tipe Barang<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>><span id="el_modelunit">
<select id="x_modelunit" name="x_modelunit"<?php echo $mst_material_part->modelunit->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->modelunit->EditValue)) {
	$arwrk = $mst_material_part->modelunit->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->modelunit->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_material_part->modelunit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->nama->Visible) { // nama ?>
	<tr<?php echo $mst_material_part->nama->RowAttributes ?>>
		<td class="ewTableHeader">Nama<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_material_part->nama->EditValue ?>"<?php echo $mst_material_part->nama->EditAttributes() ?>>
</span><?php echo $mst_material_part->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->satuan->Visible) { // satuan ?>
	<tr<?php echo $mst_material_part->satuan->RowAttributes ?>>
		<td class="ewTableHeader">Satuan<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>><span id="el_satuan">
<select id="x_satuan" name="x_satuan"<?php echo $mst_material_part->satuan->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->satuan->EditValue)) {
	$arwrk = $mst_material_part->satuan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->satuan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_material_part->satuan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->keterangan->Visible) { // keterangan ?>
	<tr<?php echo $mst_material_part->keterangan->RowAttributes ?>>
		<td class="ewTableHeader">Keterangan<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>><span id="el_keterangan">
<input type="text" name="x_keterangan" id="x_keterangan" size="100" maxlength="255" value="<?php echo $mst_material_part->keterangan->EditValue ?>"<?php echo $mst_material_part->keterangan->EditAttributes() ?>>
</span><?php echo $mst_material_part->keterangan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->coa->Visible) { // coa ?>
	<tr<?php echo $mst_material_part->coa->RowAttributes ?>>
		<td class="ewTableHeader">COA<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_material_part->coa->CellAttributes() ?>><span id="el_coa">
<select id="x_coa" name="x_coa"<?php echo $mst_material_part->coa->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->coa->EditValue)) {
	$arwrk = $mst_material_part->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->coa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $mst_material_part->coa->CustomMsg ?></td>
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
$mst_material_part_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) $PageUrl .= "t=" . $mst_material_part->TableVar . "&"; // add page token
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
		global $objForm, $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_material_part->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_material_part->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_material_part_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_material_part', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_material_part;

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
		global $objForm, $gsFormError, $mst_material_part;

		// Load key from QueryString
		if (@$_GET["kode"] <> "")
			$mst_material_part->kode->setQueryStringValue($_GET["kode"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$mst_material_part->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$mst_material_part->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$mst_material_part->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($mst_material_part->kode->CurrentValue == "")
			$this->Page_Terminate("mst_material_partlist.php"); // Invalid key, return to list
		switch ($mst_material_part->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("mst_material_partlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$mst_material_part->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $mst_material_part->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$mst_material_part->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_material_part;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_material_part;
		$mst_material_part->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_material_part->pn->setFormValue($objForm->GetValue("x_pn"));
		$mst_material_part->category->setFormValue($objForm->GetValue("x_category"));
		$mst_material_part->modelunit->setFormValue($objForm->GetValue("x_modelunit"));
		$mst_material_part->nama->setFormValue($objForm->GetValue("x_nama"));
		$mst_material_part->satuan->setFormValue($objForm->GetValue("x_satuan"));
		$mst_material_part->keterangan->setFormValue($objForm->GetValue("x_keterangan"));
		$mst_material_part->coa->setFormValue($objForm->GetValue("x_coa"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_material_part;
		$this->LoadRow();
		$mst_material_part->kode->CurrentValue = $mst_material_part->kode->FormValue;
		$mst_material_part->pn->CurrentValue = $mst_material_part->pn->FormValue;
		$mst_material_part->category->CurrentValue = $mst_material_part->category->FormValue;
		$mst_material_part->modelunit->CurrentValue = $mst_material_part->modelunit->FormValue;
		$mst_material_part->nama->CurrentValue = $mst_material_part->nama->FormValue;
		$mst_material_part->satuan->CurrentValue = $mst_material_part->satuan->FormValue;
		$mst_material_part->keterangan->CurrentValue = $mst_material_part->keterangan->FormValue;
		$mst_material_part->coa->CurrentValue = $mst_material_part->coa->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_material_part;
		$sFilter = $mst_material_part->KeyFilter();

		// Call Row Selecting event
		$mst_material_part->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_material_part->CurrentFilter = $sFilter;
		$sSql = $mst_material_part->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_material_part->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_material_part;
		$mst_material_part->kode->setDbValue($rs->fields('kode'));
		$mst_material_part->modepart->setDbValue($rs->fields('modepart'));
		$mst_material_part->pn->setDbValue($rs->fields('pn'));
		$mst_material_part->category->setDbValue($rs->fields('category'));
		$mst_material_part->modelunit->setDbValue($rs->fields('modelunit'));
		$mst_material_part->nama->setDbValue($rs->fields('nama'));
		$mst_material_part->satuan->setDbValue($rs->fields('satuan'));
		$mst_material_part->keterangan->setDbValue($rs->fields('keterangan'));
		$mst_material_part->coa->setDbValue($rs->fields('coa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_material_part;

		// Call Row_Rendering event
		$mst_material_part->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_material_part->kode->CellCssStyle = "";
		$mst_material_part->kode->CellCssClass = "";

		// pn
		$mst_material_part->pn->CellCssStyle = "";
		$mst_material_part->pn->CellCssClass = "";

		// category
		$mst_material_part->category->CellCssStyle = "";
		$mst_material_part->category->CellCssClass = "";

		// modelunit
		$mst_material_part->modelunit->CellCssStyle = "";
		$mst_material_part->modelunit->CellCssClass = "";

		// nama
		$mst_material_part->nama->CellCssStyle = "";
		$mst_material_part->nama->CellCssClass = "";

		// satuan
		$mst_material_part->satuan->CellCssStyle = "";
		$mst_material_part->satuan->CellCssClass = "";

		// keterangan
		$mst_material_part->keterangan->CellCssStyle = "";
		$mst_material_part->keterangan->CellCssClass = "";

		// coa
		$mst_material_part->coa->CellCssStyle = "";
		$mst_material_part->coa->CellCssClass = "";
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->ViewValue = $mst_material_part->pn->CurrentValue;
			$mst_material_part->pn->CssStyle = "";
			$mst_material_part->pn->CssClass = "";
			$mst_material_part->pn->ViewCustomAttributes = "";

			// category
			if (strval($mst_material_part->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_material_cat` WHERE `id` = '" . ew_AdjustSql($mst_material_part->category->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->category->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->category->ViewValue = $mst_material_part->category->CurrentValue;
				}
			} else {
				$mst_material_part->category->ViewValue = NULL;
			}
			$mst_material_part->category->CssStyle = "";
			$mst_material_part->category->CssClass = "";
			$mst_material_part->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($mst_material_part->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->modelunit->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->modelunit->ViewValue = $rswrk->fields('model');
					$rswrk->Close();
				} else {
					$mst_material_part->modelunit->ViewValue = $mst_material_part->modelunit->CurrentValue;
				}
			} else {
				$mst_material_part->modelunit->ViewValue = NULL;
			}
			$mst_material_part->modelunit->CssStyle = "";
			$mst_material_part->modelunit->CssClass = "";
			$mst_material_part->modelunit->ViewCustomAttributes = "";

			// nama
			$mst_material_part->nama->ViewValue = $mst_material_part->nama->CurrentValue;
			$mst_material_part->nama->CssStyle = "";
			$mst_material_part->nama->CssClass = "";
			$mst_material_part->nama->ViewCustomAttributes = "";

			// satuan
			if (strval($mst_material_part->satuan->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `singkatan` FROM `mst_satuan` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->satuan->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->satuan->ViewValue = $rswrk->fields('singkatan');
					$rswrk->Close();
				} else {
					$mst_material_part->satuan->ViewValue = $mst_material_part->satuan->CurrentValue;
				}
			} else {
				$mst_material_part->satuan->ViewValue = NULL;
			}
			$mst_material_part->satuan->CssStyle = "";
			$mst_material_part->satuan->CssClass = "";
			$mst_material_part->satuan->ViewCustomAttributes = "";

			// keterangan
			$mst_material_part->keterangan->ViewValue = $mst_material_part->keterangan->CurrentValue;
			$mst_material_part->keterangan->CssStyle = "";
			$mst_material_part->keterangan->CssClass = "";
			$mst_material_part->keterangan->ViewCustomAttributes = "";

			// coa
			if (strval($mst_material_part->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($mst_material_part->coa->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description`<>''" . ")";
				$sSqlWrk .= " ORDER BY `coa` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->coa->ViewValue = $rswrk->fields('coa');
					$mst_material_part->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->coa->ViewValue = $mst_material_part->coa->CurrentValue;
				}
			} else {
				$mst_material_part->coa->ViewValue = NULL;
			}
			$mst_material_part->coa->CssStyle = "";
			$mst_material_part->coa->CssClass = "";
			$mst_material_part->coa->ViewCustomAttributes = "";

			// kode
			$mst_material_part->kode->HrefValue = "";

			// pn
			$mst_material_part->pn->HrefValue = "";

			// category
			$mst_material_part->category->HrefValue = "";

			// modelunit
			$mst_material_part->modelunit->HrefValue = "";

			// nama
			$mst_material_part->nama->HrefValue = "";

			// satuan
			$mst_material_part->satuan->HrefValue = "";

			// keterangan
			$mst_material_part->keterangan->HrefValue = "";

			// coa
			$mst_material_part->coa->HrefValue = "";
		} elseif ($mst_material_part->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_material_part->kode->EditCustomAttributes = "";
			$mst_material_part->kode->EditValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->EditCustomAttributes = "";
			$mst_material_part->pn->EditValue = ew_HtmlEncode($mst_material_part->pn->CurrentValue);

			// category
			$mst_material_part->category->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_material_cat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->category->EditValue = $arwrk;

			// modelunit
			$mst_material_part->modelunit->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `model`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_modelunit`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->modelunit->EditValue = $arwrk;

			// nama
			$mst_material_part->nama->EditCustomAttributes = "";
			$mst_material_part->nama->EditValue = ew_HtmlEncode($mst_material_part->nama->CurrentValue);

			// satuan
			$mst_material_part->satuan->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `singkatan`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_satuan`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->satuan->EditValue = $arwrk;

			// keterangan
			$mst_material_part->keterangan->EditCustomAttributes = "";
			$mst_material_part->keterangan->EditValue = ew_HtmlEncode($mst_material_part->keterangan->CurrentValue);

			// coa
			$mst_material_part->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk = "($sWhereWrk) AND ";
			$sWhereWrk .= "(" . "`description`<>''" . ")";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `coa` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$mst_material_part->coa->EditValue = $arwrk;

			// Edit refer script
			// kode

			$mst_material_part->kode->HrefValue = "";

			// pn
			$mst_material_part->pn->HrefValue = "";

			// category
			$mst_material_part->category->HrefValue = "";

			// modelunit
			$mst_material_part->modelunit->HrefValue = "";

			// nama
			$mst_material_part->nama->HrefValue = "";

			// satuan
			$mst_material_part->satuan->HrefValue = "";

			// keterangan
			$mst_material_part->keterangan->HrefValue = "";

			// coa
			$mst_material_part->coa->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_material_part->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_material_part;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_material_part->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if ($mst_material_part->pn->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Serial Number";
		}
		if ($mst_material_part->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Category";
		}
		if ($mst_material_part->nama->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nama";
		}
		if ($mst_material_part->satuan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Satuan";
		}
		if ($mst_material_part->keterangan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Keterangan";
		}
		if ($mst_material_part->coa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - COA";
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
		global $conn, $Security, $mst_material_part;
		$sFilter = $mst_material_part->KeyFilter();
		$mst_material_part->CurrentFilter = $sFilter;
		$sSql = $mst_material_part->SQL();
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
			// Field pn

			$mst_material_part->pn->SetDbValueDef($mst_material_part->pn->CurrentValue, "");
			$rsnew['pn'] =& $mst_material_part->pn->DbValue;

			// Field category
			$mst_material_part->category->SetDbValueDef($mst_material_part->category->CurrentValue, "");
			$rsnew['category'] =& $mst_material_part->category->DbValue;

			// Field modelunit
			$mst_material_part->modelunit->SetDbValueDef($mst_material_part->modelunit->CurrentValue, "");
			$rsnew['modelunit'] =& $mst_material_part->modelunit->DbValue;

			// Field nama
			$mst_material_part->nama->SetDbValueDef($mst_material_part->nama->CurrentValue, "");
			$rsnew['nama'] =& $mst_material_part->nama->DbValue;

			// Field satuan
			$mst_material_part->satuan->SetDbValueDef($mst_material_part->satuan->CurrentValue, "");
			$rsnew['satuan'] =& $mst_material_part->satuan->DbValue;

			// Field keterangan
			$mst_material_part->keterangan->SetDbValueDef($mst_material_part->keterangan->CurrentValue, "");
			$rsnew['keterangan'] =& $mst_material_part->keterangan->DbValue;

			// Field coa
			$mst_material_part->coa->SetDbValueDef($mst_material_part->coa->CurrentValue, "");
			$rsnew['coa'] =& $mst_material_part->coa->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_material_part->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_material_part->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_material_part->CancelMessage <> "") {
					$this->setMessage($mst_material_part->CancelMessage);
					$mst_material_part->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_material_part->Row_Updated($rsold, $rsnew);
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

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
$mst_material_part_update = new cmst_material_part_update();
$Page =& $mst_material_part_update;

// Page init processing
$mst_material_part_update->Page_Init();

// Page main processing
$mst_material_part_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_update = new ew_Page("mst_material_part_update");

// page properties
mst_material_part_update.PageID = "update"; // page ID
var EW_PAGE_ID = mst_material_part_update.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_material_part_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No field selected for update');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_modepart"];
		uelm = fobj.elements["u" + infix + "_modepart"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Mode");
		}
		elm = fobj.elements["x" + infix + "_pn"];
		uelm = fobj.elements["u" + infix + "_pn"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Serial No");
		}
		elm = fobj.elements["x" + infix + "_category"];
		uelm = fobj.elements["u" + infix + "_category"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Category");
		}
		elm = fobj.elements["x" + infix + "_modelunit"];
		uelm = fobj.elements["u" + infix + "_modelunit"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Tipe Barang");
		}
		elm = fobj.elements["x" + infix + "_nama"];
		uelm = fobj.elements["u" + infix + "_nama"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Nama");
		}
		elm = fobj.elements["x" + infix + "_satuan"];
		uelm = fobj.elements["u" + infix + "_satuan"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Satuan");
		}
		elm = fobj.elements["x" + infix + "_keterangan"];
		uelm = fobj.elements["u" + infix + "_keterangan"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Keterangan");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_material_part_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_material_part_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_material_part_update.ShowHighlightText = "Show highlight"; 
mst_material_part_update.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Update <h3><b>Master Barang</b></h3><br><br>
<!--a href="<?php echo $mst_material_part->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_material_part->getReturnUrl() ?>';">
</span></p>
<?php $mst_material_part_update->ShowMessage() ?>
<form name="fmst_material_partupdate" id="fmst_material_partupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_material_part_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_material_part">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $mst_material_part_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($mst_material_part_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($mst_material_part->pn->Visible) { // pn ?>
	<tr<?php echo $mst_material_part->pn->RowAttributes ?>>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>>
<input type="checkbox" name="u_pn" id="u_pn" value="1"<?php echo ($mst_material_part->pn->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>>Serial No</td>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>><span id="el_pn">
<input type="text" name="x_pn" id="x_pn" size="30" maxlength="50" value="<?php echo $mst_material_part->pn->EditValue ?>"<?php echo $mst_material_part->pn->EditAttributes() ?>>
</span><?php echo $mst_material_part->pn->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->category->Visible) { // category ?>
	<tr<?php echo $mst_material_part->category->RowAttributes ?>>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>>
<input type="checkbox" name="u_category" id="u_category" value="1"<?php echo ($mst_material_part->category->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>>Category</td>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>><span id="el_category">
<input type="text" name="x_category" id="x_category" size="30" maxlength="50" value="<?php echo $mst_material_part->category->EditValue ?>"<?php echo $mst_material_part->category->EditAttributes() ?>>
</span><?php echo $mst_material_part->category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->modelunit->Visible) { // modelunit ?>
	<tr<?php echo $mst_material_part->modelunit->RowAttributes ?>>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>>
<input type="checkbox" name="u_modelunit" id="u_modelunit" value="1"<?php echo ($mst_material_part->modelunit->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>>Tipe Barang</td>
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
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>>
<input type="checkbox" name="u_nama" id="u_nama" value="1"<?php echo ($mst_material_part->nama->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>>Nama</td>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="50" maxlength="100" value="<?php echo $mst_material_part->nama->EditValue ?>"<?php echo $mst_material_part->nama->EditAttributes() ?>>
</span><?php echo $mst_material_part->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->satuan->Visible) { // satuan ?>
	<tr<?php echo $mst_material_part->satuan->RowAttributes ?>>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>>
<input type="checkbox" name="u_satuan" id="u_satuan" value="1"<?php echo ($mst_material_part->satuan->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>>Satuan</td>
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
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>>
<input type="checkbox" name="u_keterangan" id="u_keterangan" value="1"<?php echo ($mst_material_part->keterangan->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>>Keterangan</td>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>><span id="el_keterangan">
<input type="text" name="x_keterangan" id="x_keterangan" size="100" maxlength="255" value="<?php echo $mst_material_part->keterangan->EditValue ?>"<?php echo $mst_material_part->keterangan->EditAttributes() ?>>
</span><?php echo $mst_material_part->keterangan->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Update  ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$mst_material_part_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_update';

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
	function cmst_material_part_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

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
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $mst_material_part;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$mst_material_part->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$mst_material_part->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("mst_material_partlist.php"); // No records selected, return to list
		switch ($mst_material_part->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($mst_material_part->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$mst_material_part->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $mst_material_part;
		$mst_material_part->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$mst_material_part->kode->setDbValue($rs->fields('kode'));
				$mst_material_part->modepart->setDbValue($rs->fields('modepart'));
				$mst_material_part->pn->setDbValue($rs->fields('pn'));
				$mst_material_part->category->setDbValue($rs->fields('category'));
				$mst_material_part->modelunit->setDbValue($rs->fields('modelunit'));
				$mst_material_part->nama->setDbValue($rs->fields('nama'));
				$mst_material_part->satuan->setDbValue($rs->fields('satuan'));
				$mst_material_part->keterangan->setDbValue($rs->fields('keterangan'));
			} else {
				if (!ew_CompareValue($mst_material_part->kode->DbValue, $rs->fields('kode')))
					$mst_material_part->kode->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->modepart->DbValue, $rs->fields('modepart')))
					$mst_material_part->modepart->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->pn->DbValue, $rs->fields('pn')))
					$mst_material_part->pn->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->category->DbValue, $rs->fields('category')))
					$mst_material_part->category->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->modelunit->DbValue, $rs->fields('modelunit')))
					$mst_material_part->modelunit->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->nama->DbValue, $rs->fields('nama')))
					$mst_material_part->nama->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->satuan->DbValue, $rs->fields('satuan')))
					$mst_material_part->satuan->CurrentValue = NULL;
				if (!ew_CompareValue($mst_material_part->keterangan->DbValue, $rs->fields('keterangan')))
					$mst_material_part->keterangan->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $mst_material_part;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $mst_material_part->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $mst_material_part;
		$sKeyFld = $key;
		$mst_material_part->kode->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $mst_material_part;
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy("*** Batch update begin ***"); // Batch update begin

		// Get old recordset
		$mst_material_part->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $mst_material_part->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$mst_material_part->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
			$this->WriteAuditTrailDummy("*** Batch update successful ***"); // Batch update success
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			$this->WriteAuditTrailDummy("*** Batch update rollback ***"); // Batch update rollback
		}
		return $UpdateRows;
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
		$mst_material_part->kode->MultiUpdate = $objForm->GetValue("u_kode");
		$mst_material_part->modepart->setFormValue($objForm->GetValue("x_modepart"));
		$mst_material_part->modepart->MultiUpdate = $objForm->GetValue("u_modepart");
		$mst_material_part->pn->setFormValue($objForm->GetValue("x_pn"));
		$mst_material_part->pn->MultiUpdate = $objForm->GetValue("u_pn");
		$mst_material_part->category->setFormValue($objForm->GetValue("x_category"));
		$mst_material_part->category->MultiUpdate = $objForm->GetValue("u_category");
		$mst_material_part->modelunit->setFormValue($objForm->GetValue("x_modelunit"));
		$mst_material_part->modelunit->MultiUpdate = $objForm->GetValue("u_modelunit");
		$mst_material_part->nama->setFormValue($objForm->GetValue("x_nama"));
		$mst_material_part->nama->MultiUpdate = $objForm->GetValue("u_nama");
		$mst_material_part->satuan->setFormValue($objForm->GetValue("x_satuan"));
		$mst_material_part->satuan->MultiUpdate = $objForm->GetValue("u_satuan");
		$mst_material_part->keterangan->setFormValue($objForm->GetValue("x_keterangan"));
		$mst_material_part->keterangan->MultiUpdate = $objForm->GetValue("u_keterangan");
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_material_part;
		$mst_material_part->kode->CurrentValue = $mst_material_part->kode->FormValue;
		$mst_material_part->modepart->CurrentValue = $mst_material_part->modepart->FormValue;
		$mst_material_part->pn->CurrentValue = $mst_material_part->pn->FormValue;
		$mst_material_part->category->CurrentValue = $mst_material_part->category->FormValue;
		$mst_material_part->modelunit->CurrentValue = $mst_material_part->modelunit->FormValue;
		$mst_material_part->nama->CurrentValue = $mst_material_part->nama->FormValue;
		$mst_material_part->satuan->CurrentValue = $mst_material_part->satuan->FormValue;
		$mst_material_part->keterangan->CurrentValue = $mst_material_part->keterangan->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_material_part;

		// Call Recordset Selecting event
		$mst_material_part->Recordset_Selecting($mst_material_part->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_material_part->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_material_part->Recordset_Selected($rs);
		return $rs;
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

		// modepart
		$mst_material_part->modepart->CellCssStyle = "";
		$mst_material_part->modepart->CellCssClass = "";

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
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// modepart
			if (strval($mst_material_part->modepart->CurrentValue) <> "") {
				switch ($mst_material_part->modepart->CurrentValue) {
					case "unit":
						$mst_material_part->modepart->ViewValue = "Unit";
						break;
					case "part":
						$mst_material_part->modepart->ViewValue = "Part";
						break;
					case "material":
						$mst_material_part->modepart->ViewValue = "Material";
						break;
					default:
						$mst_material_part->modepart->ViewValue = $mst_material_part->modepart->CurrentValue;
				}
			} else {
				$mst_material_part->modepart->ViewValue = NULL;
			}
			$mst_material_part->modepart->CssStyle = "";
			$mst_material_part->modepart->CssClass = "";
			$mst_material_part->modepart->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->ViewValue = $mst_material_part->pn->CurrentValue;
			$mst_material_part->pn->CssStyle = "";
			$mst_material_part->pn->CssClass = "";
			$mst_material_part->pn->ViewCustomAttributes = "";

			// category
			$mst_material_part->category->ViewValue = $mst_material_part->category->CurrentValue;
			$mst_material_part->category->CssStyle = "";
			$mst_material_part->category->CssClass = "";
			$mst_material_part->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($mst_material_part->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->modelunit->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `model` ";
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
				$sSqlWrk .= " ORDER BY `singkatan` ";
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

			// kode
			$mst_material_part->kode->HrefValue = "";

			// modepart
			$mst_material_part->modepart->HrefValue = "";

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
		} elseif ($mst_material_part->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_material_part->kode->EditCustomAttributes = "";
			$mst_material_part->kode->EditValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// modepart
			$mst_material_part->modepart->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("unit", "Unit");
			$arwrk[] = array("part", "Part");
			$arwrk[] = array("material", "Material");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->modepart->EditValue = $arwrk;

			// pn
			$mst_material_part->pn->EditCustomAttributes = "";
			$mst_material_part->pn->EditValue = ew_HtmlEncode($mst_material_part->pn->CurrentValue);

			// category
			$mst_material_part->category->EditCustomAttributes = "";
			$mst_material_part->category->EditValue = ew_HtmlEncode($mst_material_part->category->CurrentValue);

			// modelunit
			$mst_material_part->modelunit->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `model`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_modelunit`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `model` ";
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
			$sSqlWrk .= " ORDER BY `singkatan` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->satuan->EditValue = $arwrk;

			// keterangan
			$mst_material_part->keterangan->EditCustomAttributes = "";
			$mst_material_part->keterangan->EditValue = ew_HtmlEncode($mst_material_part->keterangan->CurrentValue);

			// Edit refer script
			// kode

			$mst_material_part->kode->HrefValue = "";

			// modepart
			$mst_material_part->modepart->HrefValue = "";

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
		}

		// Call Row Rendered event
		$mst_material_part->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_material_part;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($mst_material_part->kode->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->modepart->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->pn->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->category->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->modelunit->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->nama->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->satuan->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_material_part->keterangan->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_material_part->modepart->MultiUpdate <> "" && $mst_material_part->modepart->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Mode";
		}
		if ($mst_material_part->pn->MultiUpdate <> "" && $mst_material_part->pn->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Serial No";
		}
		if ($mst_material_part->category->MultiUpdate <> "" && $mst_material_part->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Category";
		}
		if ($mst_material_part->modelunit->MultiUpdate <> "" && $mst_material_part->modelunit->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Tipe Barang";
		}
		if ($mst_material_part->nama->MultiUpdate <> "" && $mst_material_part->nama->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nama";
		}
		if ($mst_material_part->satuan->MultiUpdate <> "" && $mst_material_part->satuan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Satuan";
		}
		if ($mst_material_part->keterangan->MultiUpdate <> "" && $mst_material_part->keterangan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Keterangan";
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
						if ($mst_material_part->kode->MultiUpdate == "1") {
}

			// Field modepart
						if ($mst_material_part->modepart->MultiUpdate == "1") {
			$mst_material_part->modepart->SetDbValueDef($mst_material_part->modepart->CurrentValue, "");
			$rsnew['modepart'] =& $mst_material_part->modepart->DbValue;
			}

			// Field pn
						if ($mst_material_part->pn->MultiUpdate == "1") {
			$mst_material_part->pn->SetDbValueDef($mst_material_part->pn->CurrentValue, "");
			$rsnew['pn'] =& $mst_material_part->pn->DbValue;
			}

			// Field category
						if ($mst_material_part->category->MultiUpdate == "1") {
			$mst_material_part->category->SetDbValueDef($mst_material_part->category->CurrentValue, "");
			$rsnew['category'] =& $mst_material_part->category->DbValue;
			}

			// Field modelunit
						if ($mst_material_part->modelunit->MultiUpdate == "1") {
			$mst_material_part->modelunit->SetDbValueDef($mst_material_part->modelunit->CurrentValue, "");
			$rsnew['modelunit'] =& $mst_material_part->modelunit->DbValue;
			}

			// Field nama
						if ($mst_material_part->nama->MultiUpdate == "1") {
			$mst_material_part->nama->SetDbValueDef($mst_material_part->nama->CurrentValue, "");
			$rsnew['nama'] =& $mst_material_part->nama->DbValue;
			}

			// Field satuan
						if ($mst_material_part->satuan->MultiUpdate == "1") {
			$mst_material_part->satuan->SetDbValueDef($mst_material_part->satuan->CurrentValue, "");
			$rsnew['satuan'] =& $mst_material_part->satuan->DbValue;
			}

			// Field keterangan
						if ($mst_material_part->keterangan->MultiUpdate == "1") {
			$mst_material_part->keterangan->SetDbValueDef($mst_material_part->keterangan->CurrentValue, "");
			$rsnew['keterangan'] =& $mst_material_part->keterangan->DbValue;
			}

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
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_material_part';

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
		global $mst_material_part;
		$table = 'mst_material_part';

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
			if ($mst_material_part->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_material_part->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_material_part->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
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

<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_setting_coainfo.php" ?>
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
$acc_setting_coa_update = new cacc_setting_coa_update();
$Page =& $acc_setting_coa_update;

// Page init processing
$acc_setting_coa_update->Page_Init();

// Page main processing
$acc_setting_coa_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var acc_setting_coa_update = new ew_Page("acc_setting_coa_update");

// page properties
acc_setting_coa_update.PageID = "update"; // page ID
var EW_PAGE_ID = acc_setting_coa_update.PageID; // for backward compatibility

// extend page with ValidateForm function
acc_setting_coa_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_description"];
		uelm = fobj.elements["u" + infix + "_description"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Description");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
acc_setting_coa_update.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
acc_setting_coa_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_setting_coa_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_setting_coa_update.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">Update <h3><b>Setting COA</b></h3><br><br>
<!--a href="<?php echo $acc_setting_coa->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $acc_setting_coa->getReturnUrl() ?>';">
</span></p>
<?php $acc_setting_coa_update->ShowMessage() ?>
<form name="facc_setting_coaupdate" id="facc_setting_coaupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return acc_setting_coa_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="acc_setting_coa">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $acc_setting_coa_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($acc_setting_coa_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($acc_setting_coa->description->Visible) { // description ?>
	<tr<?php echo $acc_setting_coa->description->RowAttributes ?>>
		<td<?php echo $acc_setting_coa->description->CellAttributes() ?>>
<input type="checkbox" name="u_description" id="u_description" value="1"<?php echo ($acc_setting_coa->description->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $acc_setting_coa->description->CellAttributes() ?>>Description</td>
		<td<?php echo $acc_setting_coa->description->CellAttributes() ?>><span id="el_description">
<input type="text" name="x_description" id="x_description" size="30" maxlength="200" value="<?php echo $acc_setting_coa->description->EditValue ?>"<?php echo $acc_setting_coa->description->EditAttributes() ?>>
</span><?php echo $acc_setting_coa->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($acc_setting_coa->coa->Visible) { // coa ?>
	<tr<?php echo $acc_setting_coa->coa->RowAttributes ?>>
		<td<?php echo $acc_setting_coa->coa->CellAttributes() ?>>
<input type="checkbox" name="u_coa" id="u_coa" value="1"<?php echo ($acc_setting_coa->coa->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $acc_setting_coa->coa->CellAttributes() ?>>Coa</td>
		<td<?php echo $acc_setting_coa->coa->CellAttributes() ?>><span id="el_coa">
<select id="x_coa" name="x_coa"<?php echo $acc_setting_coa->coa->EditAttributes() ?>>
<?php
if (is_array($acc_setting_coa->coa->EditValue)) {
	$arwrk = $acc_setting_coa->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_setting_coa->coa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $acc_setting_coa->coa->CustomMsg ?></td>
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
$acc_setting_coa_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_setting_coa_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'acc_setting_coa';

	// Page Object Name
	var $PageObjName = 'acc_setting_coa_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_setting_coa;
		if ($acc_setting_coa->UseTokenInUrl) $PageUrl .= "t=" . $acc_setting_coa->TableVar . "&"; // add page token
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
		global $objForm, $acc_setting_coa;
		if ($acc_setting_coa->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_setting_coa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_setting_coa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_setting_coa_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_setting_coa"] = new cacc_setting_coa();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_setting_coa', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_setting_coa;

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
		global $objForm, $gsFormError, $acc_setting_coa;

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
				$acc_setting_coa->CurrentAction = $_POST["a_update"];

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
					$acc_setting_coa->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("acc_setting_coalist.php"); // No records selected, return to list
		switch ($acc_setting_coa->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($acc_setting_coa->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$acc_setting_coa->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $acc_setting_coa;
		$acc_setting_coa->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$acc_setting_coa->description->setDbValue($rs->fields('description'));
				$acc_setting_coa->coa->setDbValue($rs->fields('coa'));
			} else {
				if (!ew_CompareValue($acc_setting_coa->description->DbValue, $rs->fields('description')))
					$acc_setting_coa->description->CurrentValue = NULL;
				if (!ew_CompareValue($acc_setting_coa->coa->DbValue, $rs->fields('coa')))
					$acc_setting_coa->coa->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $acc_setting_coa;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $acc_setting_coa->KeyFilter();
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
		global $acc_setting_coa;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$acc_setting_coa->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $acc_setting_coa;
		$conn->BeginTrans();

		// Get old recordset
		$acc_setting_coa->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $acc_setting_coa->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$acc_setting_coa->SendEmail = FALSE; // Do not send email on update success
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
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $acc_setting_coa;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $acc_setting_coa;
		$acc_setting_coa->description->setFormValue($objForm->GetValue("x_description"));
		$acc_setting_coa->description->MultiUpdate = $objForm->GetValue("u_description");
		$acc_setting_coa->coa->setFormValue($objForm->GetValue("x_coa"));
		$acc_setting_coa->coa->MultiUpdate = $objForm->GetValue("u_coa");
		$acc_setting_coa->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $acc_setting_coa;
		$acc_setting_coa->id->CurrentValue = $acc_setting_coa->id->FormValue;
		$acc_setting_coa->description->CurrentValue = $acc_setting_coa->description->FormValue;
		$acc_setting_coa->coa->CurrentValue = $acc_setting_coa->coa->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_setting_coa;

		// Call Recordset Selecting event
		$acc_setting_coa->Recordset_Selecting($acc_setting_coa->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_setting_coa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_setting_coa->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_setting_coa;

		// Call Row_Rendering event
		$acc_setting_coa->Row_Rendering();

		// Common render codes for all row types
		// description

		$acc_setting_coa->description->CellCssStyle = "";
		$acc_setting_coa->description->CellCssClass = "";

		// coa
		$acc_setting_coa->coa->CellCssStyle = "";
		$acc_setting_coa->coa->CellCssClass = "";
		if ($acc_setting_coa->RowType == EW_ROWTYPE_VIEW) { // View row

			// description
			$acc_setting_coa->description->ViewValue = $acc_setting_coa->description->CurrentValue;
			$acc_setting_coa->description->CssStyle = "";
			$acc_setting_coa->description->CssClass = "";
			$acc_setting_coa->description->ViewCustomAttributes = "readonly";

			// coa
			if (strval($acc_setting_coa->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($acc_setting_coa->coa->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_setting_coa->coa->ViewValue = $rswrk->fields('coa');
					$acc_setting_coa->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$acc_setting_coa->coa->ViewValue = $acc_setting_coa->coa->CurrentValue;
				}
			} else {
				$acc_setting_coa->coa->ViewValue = NULL;
			}
			$acc_setting_coa->coa->CssStyle = "";
			$acc_setting_coa->coa->CssClass = "";
			$acc_setting_coa->coa->ViewCustomAttributes = "";

			// description
			$acc_setting_coa->description->HrefValue = "";

			// coa
			$acc_setting_coa->coa->HrefValue = "";
		} elseif ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// description
			$acc_setting_coa->description->EditCustomAttributes = "";
			$acc_setting_coa->description->EditValue = ew_HtmlEncode($acc_setting_coa->description->CurrentValue);

			// coa
			$acc_setting_coa->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$acc_setting_coa->coa->EditValue = $arwrk;

			// Edit refer script
			// description

			$acc_setting_coa->description->HrefValue = "";

			// coa
			$acc_setting_coa->coa->HrefValue = "";
		}

		// Call Row Rendered event
		$acc_setting_coa->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $acc_setting_coa;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($acc_setting_coa->description->MultiUpdate == "1") $lUpdateCnt++;
		if ($acc_setting_coa->coa->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($acc_setting_coa->description->MultiUpdate <> "" && $acc_setting_coa->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
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
		global $conn, $Security, $acc_setting_coa;
		$sFilter = $acc_setting_coa->KeyFilter();
		$acc_setting_coa->CurrentFilter = $sFilter;
		$sSql = $acc_setting_coa->SQL();
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

			// Field description
			if ($acc_setting_coa->description->MultiUpdate == "1") {
			$acc_setting_coa->description->SetDbValueDef($acc_setting_coa->description->CurrentValue, "");
			$rsnew['description'] =& $acc_setting_coa->description->DbValue;
			}

			// Field coa
			if ($acc_setting_coa->coa->MultiUpdate == "1") {
			$acc_setting_coa->coa->SetDbValueDef($acc_setting_coa->coa->CurrentValue, "");
			$rsnew['coa'] =& $acc_setting_coa->coa->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $acc_setting_coa->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($acc_setting_coa->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($acc_setting_coa->CancelMessage <> "") {
					$this->setMessage($acc_setting_coa->CancelMessage);
					$acc_setting_coa->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$acc_setting_coa->Row_Updated($rsold, $rsnew);
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

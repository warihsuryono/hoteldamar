<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_modelunitinfo.php" ?>
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
$mst_modelunit_update = new cmst_modelunit_update();
$Page =& $mst_modelunit_update;

// Page init processing
$mst_modelunit_update->Page_Init();

// Page main processing
$mst_modelunit_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_modelunit_update = new ew_Page("mst_modelunit_update");

// page properties
mst_modelunit_update.PageID = "update"; // page ID
var EW_PAGE_ID = mst_modelunit_update.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_modelunit_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_model"];
		uelm = fobj.elements["u" + infix + "_model"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Model");
		}
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
mst_modelunit_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_modelunit_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_modelunit_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_modelunit_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_modelunit_update.ShowHighlightText = "Show highlight"; 
mst_modelunit_update.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Update <h3><b>Master Tipe Barang</b></h3><br><br>
<!--a href="<?php echo $mst_modelunit->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_modelunit->getReturnUrl() ?>';">
</span></p>
<?php $mst_modelunit_update->ShowMessage() ?>
<form name="fmst_modelunitupdate" id="fmst_modelunitupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_modelunit_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_modelunit">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $mst_modelunit_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($mst_modelunit_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($mst_modelunit->model->Visible) { // model ?>
	<tr<?php echo $mst_modelunit->model->RowAttributes ?>>
		<td<?php echo $mst_modelunit->model->CellAttributes() ?>>
<input type="checkbox" name="u_model" id="u_model" value="1"<?php echo ($mst_modelunit->model->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_modelunit->model->CellAttributes() ?>>Model</td>
		<td<?php echo $mst_modelunit->model->CellAttributes() ?>><span id="el_model">
<input type="text" name="x_model" id="x_model" size="50" maxlength="50" value="<?php echo $mst_modelunit->model->EditValue ?>"<?php echo $mst_modelunit->model->EditAttributes() ?>>
</span><?php echo $mst_modelunit->model->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_modelunit->description->Visible) { // description ?>
	<tr<?php echo $mst_modelunit->description->RowAttributes ?>>
		<td<?php echo $mst_modelunit->description->CellAttributes() ?>>
<input type="checkbox" name="u_description" id="u_description" value="1"<?php echo ($mst_modelunit->description->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_modelunit->description->CellAttributes() ?>>Description</td>
		<td<?php echo $mst_modelunit->description->CellAttributes() ?>><span id="el_description">
<input type="text" name="x_description" id="x_description" size="100" maxlength="255" value="<?php echo $mst_modelunit->description->EditValue ?>"<?php echo $mst_modelunit->description->EditAttributes() ?>>
</span><?php echo $mst_modelunit->description->CustomMsg ?></td>
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
$mst_modelunit_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_modelunit_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'mst_modelunit';

	// Page Object Name
	var $PageObjName = 'mst_modelunit_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_modelunit;
		if ($mst_modelunit->UseTokenInUrl) $PageUrl .= "t=" . $mst_modelunit->TableVar . "&"; // add page token
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
		global $objForm, $mst_modelunit;
		if ($mst_modelunit->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_modelunit->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_modelunit->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_modelunit_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_modelunit"] = new cmst_modelunit();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_modelunit', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_modelunit;

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
		global $objForm, $gsFormError, $mst_modelunit;

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
				$mst_modelunit->CurrentAction = $_POST["a_update"];

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
					$mst_modelunit->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("mst_modelunitlist.php"); // No records selected, return to list
		switch ($mst_modelunit->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($mst_modelunit->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$mst_modelunit->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $mst_modelunit;
		$mst_modelunit->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$mst_modelunit->kode->setDbValue($rs->fields('kode'));
				$mst_modelunit->model->setDbValue($rs->fields('model'));
				$mst_modelunit->description->setDbValue($rs->fields('description'));
			} else {
				if (!ew_CompareValue($mst_modelunit->kode->DbValue, $rs->fields('kode')))
					$mst_modelunit->kode->CurrentValue = NULL;
				if (!ew_CompareValue($mst_modelunit->model->DbValue, $rs->fields('model')))
					$mst_modelunit->model->CurrentValue = NULL;
				if (!ew_CompareValue($mst_modelunit->description->DbValue, $rs->fields('description')))
					$mst_modelunit->description->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $mst_modelunit;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $mst_modelunit->KeyFilter();
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
		global $mst_modelunit;
		$sKeyFld = $key;
		$mst_modelunit->kode->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $mst_modelunit;
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy("*** Batch update begin ***"); // Batch update begin

		// Get old recordset
		$mst_modelunit->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $mst_modelunit->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$mst_modelunit->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $mst_modelunit;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_modelunit;
		$mst_modelunit->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_modelunit->kode->MultiUpdate = $objForm->GetValue("u_kode");
		$mst_modelunit->model->setFormValue($objForm->GetValue("x_model"));
		$mst_modelunit->model->MultiUpdate = $objForm->GetValue("u_model");
		$mst_modelunit->description->setFormValue($objForm->GetValue("x_description"));
		$mst_modelunit->description->MultiUpdate = $objForm->GetValue("u_description");
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_modelunit;
		$mst_modelunit->kode->CurrentValue = $mst_modelunit->kode->FormValue;
		$mst_modelunit->model->CurrentValue = $mst_modelunit->model->FormValue;
		$mst_modelunit->description->CurrentValue = $mst_modelunit->description->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_modelunit;

		// Call Recordset Selecting event
		$mst_modelunit->Recordset_Selecting($mst_modelunit->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_modelunit->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_modelunit->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_modelunit;

		// Call Row_Rendering event
		$mst_modelunit->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_modelunit->kode->CellCssStyle = "";
		$mst_modelunit->kode->CellCssClass = "";

		// model
		$mst_modelunit->model->CellCssStyle = "";
		$mst_modelunit->model->CellCssClass = "";

		// description
		$mst_modelunit->description->CellCssStyle = "";
		$mst_modelunit->description->CellCssClass = "";
		if ($mst_modelunit->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_modelunit->kode->ViewValue = $mst_modelunit->kode->CurrentValue;
			$mst_modelunit->kode->CssStyle = "";
			$mst_modelunit->kode->CssClass = "";
			$mst_modelunit->kode->ViewCustomAttributes = "";

			// model
			$mst_modelunit->model->ViewValue = $mst_modelunit->model->CurrentValue;
			$mst_modelunit->model->CssStyle = "";
			$mst_modelunit->model->CssClass = "";
			$mst_modelunit->model->ViewCustomAttributes = "";

			// description
			$mst_modelunit->description->ViewValue = $mst_modelunit->description->CurrentValue;
			$mst_modelunit->description->CssStyle = "";
			$mst_modelunit->description->CssClass = "";
			$mst_modelunit->description->ViewCustomAttributes = "";

			// kode
			$mst_modelunit->kode->HrefValue = "";

			// model
			$mst_modelunit->model->HrefValue = "";

			// description
			$mst_modelunit->description->HrefValue = "";
		} elseif ($mst_modelunit->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_modelunit->kode->EditCustomAttributes = "";
			$mst_modelunit->kode->EditValue = $mst_modelunit->kode->CurrentValue;
			$mst_modelunit->kode->CssStyle = "";
			$mst_modelunit->kode->CssClass = "";
			$mst_modelunit->kode->ViewCustomAttributes = "";

			// model
			$mst_modelunit->model->EditCustomAttributes = "";
			$mst_modelunit->model->EditValue = ew_HtmlEncode($mst_modelunit->model->CurrentValue);

			// description
			$mst_modelunit->description->EditCustomAttributes = "";
			$mst_modelunit->description->EditValue = ew_HtmlEncode($mst_modelunit->description->CurrentValue);

			// Edit refer script
			// kode

			$mst_modelunit->kode->HrefValue = "";

			// model
			$mst_modelunit->model->HrefValue = "";

			// description
			$mst_modelunit->description->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_modelunit->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_modelunit;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($mst_modelunit->kode->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_modelunit->model->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_modelunit->description->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_modelunit->model->MultiUpdate <> "" && $mst_modelunit->model->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Model";
		}
		if ($mst_modelunit->description->MultiUpdate <> "" && $mst_modelunit->description->FormValue == "") {
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
		global $conn, $Security, $mst_modelunit;
		$sFilter = $mst_modelunit->KeyFilter();
		$mst_modelunit->CurrentFilter = $sFilter;
		$sSql = $mst_modelunit->SQL();
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
						if ($mst_modelunit->kode->MultiUpdate == "1") {
}

			// Field model
						if ($mst_modelunit->model->MultiUpdate == "1") {
			$mst_modelunit->model->SetDbValueDef($mst_modelunit->model->CurrentValue, "");
			$rsnew['model'] =& $mst_modelunit->model->DbValue;
			}

			// Field description
						if ($mst_modelunit->description->MultiUpdate == "1") {
			$mst_modelunit->description->SetDbValueDef($mst_modelunit->description->CurrentValue, "");
			$rsnew['description'] =& $mst_modelunit->description->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $mst_modelunit->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_modelunit->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_modelunit->CancelMessage <> "") {
					$this->setMessage($mst_modelunit->CancelMessage);
					$mst_modelunit->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_modelunit->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_modelunit';

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
		global $mst_modelunit;
		$table = 'mst_modelunit';

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
			if ($mst_modelunit->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_modelunit->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_modelunit->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
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

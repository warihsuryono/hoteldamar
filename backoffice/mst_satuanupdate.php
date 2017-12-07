<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_satuaninfo.php" ?>
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
$mst_satuan_update = new cmst_satuan_update();
$Page =& $mst_satuan_update;

// Page init processing
$mst_satuan_update->Page_Init();

// Page main processing
$mst_satuan_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_satuan_update = new ew_Page("mst_satuan_update");

// page properties
mst_satuan_update.PageID = "update"; // page ID
var EW_PAGE_ID = mst_satuan_update.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_satuan_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_satuan"];
		uelm = fobj.elements["u" + infix + "_satuan"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Satuan");
		}
		elm = fobj.elements["x" + infix + "_singkatan"];
		uelm = fobj.elements["u" + infix + "_singkatan"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Singkatan");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_satuan_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_satuan_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_satuan_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_satuan_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_satuan_update.ShowHighlightText = "Show highlight"; 
mst_satuan_update.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Update <h3><b>Master Satuan</b></h3><br><br>
<!--a href="<?php echo $mst_satuan->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_satuan->getReturnUrl() ?>';">
</span></p>
<?php $mst_satuan_update->ShowMessage() ?>
<form name="fmst_satuanupdate" id="fmst_satuanupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_satuan_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_satuan">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $mst_satuan_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($mst_satuan_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($mst_satuan->satuan->Visible) { // satuan ?>
	<tr<?php echo $mst_satuan->satuan->RowAttributes ?>>
		<td<?php echo $mst_satuan->satuan->CellAttributes() ?>>
<input type="checkbox" name="u_satuan" id="u_satuan" value="1"<?php echo ($mst_satuan->satuan->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_satuan->satuan->CellAttributes() ?>>Satuan</td>
		<td<?php echo $mst_satuan->satuan->CellAttributes() ?>><span id="el_satuan">
<input type="text" name="x_satuan" id="x_satuan" size="50" maxlength="50" value="<?php echo $mst_satuan->satuan->EditValue ?>"<?php echo $mst_satuan->satuan->EditAttributes() ?>>
</span><?php echo $mst_satuan->satuan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_satuan->singkatan->Visible) { // singkatan ?>
	<tr<?php echo $mst_satuan->singkatan->RowAttributes ?>>
		<td<?php echo $mst_satuan->singkatan->CellAttributes() ?>>
<input type="checkbox" name="u_singkatan" id="u_singkatan" value="1"<?php echo ($mst_satuan->singkatan->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_satuan->singkatan->CellAttributes() ?>>Singkatan</td>
		<td<?php echo $mst_satuan->singkatan->CellAttributes() ?>><span id="el_singkatan">
<input type="text" name="x_singkatan" id="x_singkatan" size="10" maxlength="10" value="<?php echo $mst_satuan->singkatan->EditValue ?>"<?php echo $mst_satuan->singkatan->EditAttributes() ?>>
</span><?php echo $mst_satuan->singkatan->CustomMsg ?></td>
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
$mst_satuan_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_satuan_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'mst_satuan';

	// Page Object Name
	var $PageObjName = 'mst_satuan_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_satuan;
		if ($mst_satuan->UseTokenInUrl) $PageUrl .= "t=" . $mst_satuan->TableVar . "&"; // add page token
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
		global $objForm, $mst_satuan;
		if ($mst_satuan->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_satuan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_satuan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_satuan_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_satuan"] = new cmst_satuan();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_satuan', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_satuan;

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
		global $objForm, $gsFormError, $mst_satuan;

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
				$mst_satuan->CurrentAction = $_POST["a_update"];

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
					$mst_satuan->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("mst_satuanlist.php"); // No records selected, return to list
		switch ($mst_satuan->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($mst_satuan->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$mst_satuan->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $mst_satuan;
		$mst_satuan->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$mst_satuan->kode->setDbValue($rs->fields('kode'));
				$mst_satuan->satuan->setDbValue($rs->fields('satuan'));
				$mst_satuan->singkatan->setDbValue($rs->fields('singkatan'));
			} else {
				if (!ew_CompareValue($mst_satuan->kode->DbValue, $rs->fields('kode')))
					$mst_satuan->kode->CurrentValue = NULL;
				if (!ew_CompareValue($mst_satuan->satuan->DbValue, $rs->fields('satuan')))
					$mst_satuan->satuan->CurrentValue = NULL;
				if (!ew_CompareValue($mst_satuan->singkatan->DbValue, $rs->fields('singkatan')))
					$mst_satuan->singkatan->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $mst_satuan;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $mst_satuan->KeyFilter();
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
		global $mst_satuan;
		$sKeyFld = $key;
		$mst_satuan->kode->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $mst_satuan;
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy("*** Batch update begin ***"); // Batch update begin

		// Get old recordset
		$mst_satuan->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $mst_satuan->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$mst_satuan->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $mst_satuan;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_satuan;
		$mst_satuan->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_satuan->kode->MultiUpdate = $objForm->GetValue("u_kode");
		$mst_satuan->satuan->setFormValue($objForm->GetValue("x_satuan"));
		$mst_satuan->satuan->MultiUpdate = $objForm->GetValue("u_satuan");
		$mst_satuan->singkatan->setFormValue($objForm->GetValue("x_singkatan"));
		$mst_satuan->singkatan->MultiUpdate = $objForm->GetValue("u_singkatan");
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_satuan;
		$mst_satuan->kode->CurrentValue = $mst_satuan->kode->FormValue;
		$mst_satuan->satuan->CurrentValue = $mst_satuan->satuan->FormValue;
		$mst_satuan->singkatan->CurrentValue = $mst_satuan->singkatan->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_satuan;

		// Call Recordset Selecting event
		$mst_satuan->Recordset_Selecting($mst_satuan->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_satuan->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_satuan->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_satuan;

		// Call Row_Rendering event
		$mst_satuan->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_satuan->kode->CellCssStyle = "";
		$mst_satuan->kode->CellCssClass = "";

		// satuan
		$mst_satuan->satuan->CellCssStyle = "";
		$mst_satuan->satuan->CellCssClass = "";

		// singkatan
		$mst_satuan->singkatan->CellCssStyle = "";
		$mst_satuan->singkatan->CellCssClass = "";
		if ($mst_satuan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_satuan->kode->ViewValue = $mst_satuan->kode->CurrentValue;
			$mst_satuan->kode->CssStyle = "";
			$mst_satuan->kode->CssClass = "";
			$mst_satuan->kode->ViewCustomAttributes = "";

			// satuan
			$mst_satuan->satuan->ViewValue = $mst_satuan->satuan->CurrentValue;
			$mst_satuan->satuan->CssStyle = "";
			$mst_satuan->satuan->CssClass = "";
			$mst_satuan->satuan->ViewCustomAttributes = "";

			// singkatan
			$mst_satuan->singkatan->ViewValue = $mst_satuan->singkatan->CurrentValue;
			$mst_satuan->singkatan->CssStyle = "";
			$mst_satuan->singkatan->CssClass = "";
			$mst_satuan->singkatan->ViewCustomAttributes = "";

			// kode
			$mst_satuan->kode->HrefValue = "";

			// satuan
			$mst_satuan->satuan->HrefValue = "";

			// singkatan
			$mst_satuan->singkatan->HrefValue = "";
		} elseif ($mst_satuan->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_satuan->kode->EditCustomAttributes = "";
			$mst_satuan->kode->EditValue = $mst_satuan->kode->CurrentValue;
			$mst_satuan->kode->CssStyle = "";
			$mst_satuan->kode->CssClass = "";
			$mst_satuan->kode->ViewCustomAttributes = "";

			// satuan
			$mst_satuan->satuan->EditCustomAttributes = "";
			$mst_satuan->satuan->EditValue = ew_HtmlEncode($mst_satuan->satuan->CurrentValue);

			// singkatan
			$mst_satuan->singkatan->EditCustomAttributes = "";
			$mst_satuan->singkatan->EditValue = ew_HtmlEncode($mst_satuan->singkatan->CurrentValue);

			// Edit refer script
			// kode

			$mst_satuan->kode->HrefValue = "";

			// satuan
			$mst_satuan->satuan->HrefValue = "";

			// singkatan
			$mst_satuan->singkatan->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_satuan->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_satuan;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($mst_satuan->kode->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_satuan->satuan->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_satuan->singkatan->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_satuan->satuan->MultiUpdate <> "" && $mst_satuan->satuan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Satuan";
		}
		if ($mst_satuan->singkatan->MultiUpdate <> "" && $mst_satuan->singkatan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Singkatan";
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
		global $conn, $Security, $mst_satuan;
		$sFilter = $mst_satuan->KeyFilter();
		$mst_satuan->CurrentFilter = $sFilter;
		$sSql = $mst_satuan->SQL();
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
						if ($mst_satuan->kode->MultiUpdate == "1") {
}

			// Field satuan
						if ($mst_satuan->satuan->MultiUpdate == "1") {
			$mst_satuan->satuan->SetDbValueDef($mst_satuan->satuan->CurrentValue, "");
			$rsnew['satuan'] =& $mst_satuan->satuan->DbValue;
			}

			// Field singkatan
						if ($mst_satuan->singkatan->MultiUpdate == "1") {
			$mst_satuan->singkatan->SetDbValueDef($mst_satuan->singkatan->CurrentValue, "");
			$rsnew['singkatan'] =& $mst_satuan->singkatan->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $mst_satuan->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_satuan->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_satuan->CancelMessage <> "") {
					$this->setMessage($mst_satuan->CancelMessage);
					$mst_satuan->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_satuan->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_satuan';

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
		global $mst_satuan;
		$table = 'mst_satuan';

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
			if ($mst_satuan->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_satuan->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_satuan->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
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
